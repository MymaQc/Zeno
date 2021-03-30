<?php

namespace Zeno\Events;

use Zeno\Core;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;

class PlayerPreLogin implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function onPlayerPreLogin(PlayerPreLoginEvent $event) {
        $player = $event->getPlayer();
        if (!$this->plugin->getServer()->isWhitelisted($player->getName())) {
            $player->close("", "Server whitelisted");
            $event->setCancelled(true);
            return;
        }
    }

}