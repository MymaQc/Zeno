<?php

namespace Zeno\Entity;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\entity\EffectInstance;
use pocketmine\entity\Living;
use pocketmine\entity\projectile\Throwable;
use pocketmine\event\entity\ProjectileHitBlockEvent;
use pocketmine\event\entity\ProjectileHitEntityEvent;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\item\Potion;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\Player;
use pocketmine\utils\Color;
use function count;
use function round;
use function sqrt;

class SplashPotion extends Throwable {

    public const NETWORK_ID = self::SPLASH_POTION;

    protected $gravity = 0.05;
    protected $drag = 0.01;

    protected function initEntity() : void {
        parent::initEntity();

        $this->setPotionId($this->namedtag->getShort("PotionId", 0));
    }

    public function saveNBT() : void {
        parent::saveNBT();
        $this->namedtag->setShort("PotionId", $this->getPotionId());
    }

    public function getResultDamage() : int {
        return -1;
    }

    protected function onHit(ProjectileHitEvent $event) : void {
        $effects = $this->getPotionEffects();
        $hasEffects = true;
        $owningentity = $event->getEntity()->getOwningEntity();
        if ($owningentity instanceof Player and $owningentity->isAlive()) {
            if ($owningentity->getLevel()->getBlockIdAt(round($owningentity->getX()), round($owningentity->getY())-1, round($owningentity->getZ())) === 0){
                $event->getEntity()->teleport($owningentity);
            }
        }

        if (count($effects) === 0){
            $colors = [
                new Color(0x38, 0x5d, 0xc6)
            ];
            $hasEffects = false;
        } else {
            $colors = [];
            foreach ($effects as $effect) {
                $level = $effect->getEffectLevel();
                for ($j = 0; $j < $level; ++$j) {
                    $colors[] = $effect->getColor();
                }
            }
        }

        $this->level->broadcastLevelEvent($this, LevelEventPacket::EVENT_PARTICLE_SPLASH, Color::mix(...$colors)->toARGB());
        $this->level->broadcastLevelSoundEvent($this, LevelSoundEventPacket::SOUND_GLASS);

        if ($hasEffects) {
            if (!$this->willLinger()) {
                foreach ($this->level->getNearbyEntities($this->boundingBox->expandedCopy(4.125, 2.125, 4.125), $this) as $entity) {
                    if ($entity instanceof Living and $entity->isAlive()) {
                        $distanceSquared = $entity->add(0, $entity->getEyeHeight(), 0)->distanceSquared($this);
                        if ($distanceSquared > 16) {
                            continue;
                        }
                        $distanceMultiplier = 1.45 - (sqrt($distanceSquared) / 4);
                        if ($event instanceof ProjectileHitEntityEvent and $entity === $event->getEntityHit()) {
                            $distanceMultiplier = 1.0;
                        }

                        foreach ($this->getPotionEffects() as $effect) {
                            if (!$effect->getType()->isInstantEffect()) {
                                $newDuration = (int) round($effect->getDuration() * 0.75 * $distanceMultiplier);
                                if ($newDuration < 20) {
                                    continue;
                                }
                                $effect->setDuration($newDuration);
                                $entity->addEffect($effect);
                            } else {
                                $effect->getType()->applyEffect($entity, $effect, $distanceMultiplier, $this, $this->getOwningEntity());
                            }
                        }
                    }
                }
            }
        } else if ($event instanceof ProjectileHitBlockEvent and $this->getPotionId() === Potion::WATER) {
            $blockIn = $event->getBlockHit()->getSide($event->getRayTraceResult()->getHitFace());

            if ($blockIn->getId() === Block::FIRE) {
                $this->level->setBlock($blockIn, BlockFactory::get(Block::AIR));
            }
            foreach($blockIn->getHorizontalSides() as $horizontalSide) {
                if ($horizontalSide->getId() === Block::FIRE) {
                    $this->level->setBlock($horizontalSide, BlockFactory::get(Block::AIR));
                }
            }
        }
    }

    public function getPotionId() : int {
        return $this->propertyManager->getShort(self::DATA_POTION_AUX_VALUE) ?? 0;
    }

    public function setPotionId(int $id) : void {
        $this->propertyManager->setShort(self::DATA_POTION_AUX_VALUE, $id);
    }

    public function willLinger() : bool {
        return $this->getDataFlag(self::DATA_FLAGS, self::DATA_FLAG_LINGER);
    }

    public function setLinger(bool $value = true) : void {
        $this->setDataFlag(self::DATA_FLAGS, self::DATA_FLAG_LINGER, $value);
    }

    /**
     * @return EffectInstance[]
     */
    public function getPotionEffects() : array {
        return Potion::getPotionEffectsById($this->getPotionId());
    }

}