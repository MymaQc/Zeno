<?php

namespace Zeno\Listener;

use Zeno\Core;
use pocketmine\entity\Entity;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\ShortTag;
use pocketmine\Player;
use pocketmine\utils\Config;

class PotionListener implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function getPerif($player) : bool {
        $config = new Config(Core::getInstance()->getFolder() . "Stats/Perif.json", Config::JSON);
        if ($player instanceof Player) {
            $player = $player->getName();
        }
        $player = strtolower($player);
        return $config->get($player);
    }

    public function onProjectile(PlayerInteractEvent $event) : bool {
        $player = $event->getPlayer();
        $item = $event->getItem();
        if ($item->getId() == ItemIds::SPLASH_POTION) {
            if ($this->getPerif($player) == "Tactile") {
                if ($event->isCancelled()) {
                    return true;
                }
                $event->setCancelled(true);
                $nbt = new CompoundTag("", [
                    "Pos" => new ListTag("Pos", [
                        new DoubleTag("", $player->x),
                        new DoubleTag("", $player->y + $player->getEyeHeight()),
                        new DoubleTag("", $player->z),
                    ]),
                    "Motion" => new ListTag("Motion", [
                        new DoubleTag("", -sin($player->yaw / 180 * M_PI) * cos($player->pitch / 180 * M_PI)),
                        new DoubleTag("", -sin($player->pitch / 180 * M_PI)),
                        new DoubleTag("", cos($player->yaw / 180 * M_PI) * cos($player->pitch / 180 * M_PI)),
                    ]),
                    "Rotation" => new ListTag("Rotation", [
                        new FloatTag("", $player->yaw),
                        new FloatTag("", $player->pitch),
                    ]),
                ]);
                $nbt["PotionId"] = new ShortTag("PotionId", $item->getDamage());
                $entity = Entity::createEntity("SplashPotion", $player->getLevel(), $nbt, null);
                if ($entity != null) {
                    $entity->setMotion($entity->getMotion()->multiply(1.2));
                }
                if ($player->isSurvival()) {
                    $player->getInventory()->setItemInHand(Item::get(Item::AIR));
                }
            }
        }
    }

}