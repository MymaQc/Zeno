<?php

namespace Zeno\Events;

use Zeno\Core;
use Zeno\API\ServerAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class PlayerDeath implements Listener {

    private static $cooldown;
    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    function onPlayerDeath(PlayerDeathEvent $event) {
        $player = $event->getPlayer();
        self::$cooldown[$player->getName()] = time()+1;
        $name = $player->getName();
        $event->setDrops([]);
        $event->setDeathMessage("");
        if ($player->getLastDamageCause()->getCause() === EntityDamageByEntityEvent::CAUSE_ENTITY_ATTACK and
            $player->getLevel()->getFolderName() == "nodebuff") {
                $nameD = $player->getLastDamageCause()->getDamager()->getName();
                $ppots = ServerAPI::getPotionsCount($player);
                $dpots = ServerAPI::getPotionsCount($player->getLastDamageCause()->getDamager());
                $event->setDeathMessage("§c{$name} [{$ppots} POTS] §7was killed by §a{$nameD} [$dpots POTS] §7!");
        }
    }

}