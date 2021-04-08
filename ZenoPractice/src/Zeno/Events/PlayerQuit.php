<?php

namespace Zeno\Events;

use Zeno\Core;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;

class PlayerQuit implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function PlayerQuit(PlayerQuitEvent $event) {
        $player = $event->getPlayer();
        $player->getInventory()->clearAll();
        $player->getArmorInventory()->clearAll();
        $lvl = $player->getLevel();
        $name = $player->getName();
        $event->setQuitMessage("");
        $this->plugin->getServer()->broadcastPopup("§c- {$name} -");
    }

}