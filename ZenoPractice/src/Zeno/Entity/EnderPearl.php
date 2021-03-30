<?php

namespace Zeno\Entity;

use pocketmine\Player;
use pocketmine\entity\projectile\EnderPearl as CustomEnderPearl;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\network\mcpe\protocol\LevelEventPacket;

class EnderPearl extends CustomEnderPearl {

    protected function onHit(ProjectileHitEvent $event) : void {
        $owner = $this->getOwningEntity();
        if ($owner !== null) {
            if ($owner instanceof Player) {
                $this->level->broadcastLevelEvent($owner, LevelEventPacket::EVENT_PARTICLE_ENDERMAN_TELEPORT);
                $this->level->addSound(new EndermanTeleportSound($owner));
                $owner->teleport($event->getRayTraceResult()->getHitVector());
                $this->level->addSound(new EndermanTeleportSound($owner));
                $owner->attack(new EntityDamageEvent($owner, EntityDamageEvent::CAUSE_FALL, 5));
            }
        }
    }

}