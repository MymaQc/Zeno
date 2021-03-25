<?php


namespace Zeno\Events;

use Zeno\Core;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;

class PlayerExhaust implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function onExhaust(PlayerExhaustEvent $event) {
        $event->getPlayer()->setFood(20);
    }

}