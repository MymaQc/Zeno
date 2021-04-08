<?php

namespace Zeno\Events;

use Zeno\Core;
use Zeno\API\ServerAPI;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerDeathEvent;

class PlayerDeath implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    function onPlayerDeath(PlayerDeathEvent $event) {
        $player = $event->getPlayer();
        $name = $player->getName();
        $event->setDrops([]);
        $event->setDeathMessage("");
        if ($player->getLastDamageCause()->getCause() === EntityDamageByEntityEvent::CAUSE_ENTITY_ATTACK and $player->getLevel()->getFolderName() == "soupkit") {
            $nameD = $player->getLastDamageCause()->getDamager()->getName();
            $psoup = ServerAPI::getSoupsCount($player);
            $dsoup = ServerAPI::getSoupsCount($player->getLastDamageCause()->getDamager());
            $event->setDeathMessage("§c{$name} [{$psoup} Soupe(s)] §7was killed by §a{$nameD} [$dsoup Soupe(s)] §7!");
        }
    }

}