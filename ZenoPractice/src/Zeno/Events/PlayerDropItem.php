<?php

namespace Zeno\Events;

use Zeno\Core;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\Listener;

class PlayerDropItem implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function onDrop(PlayerDropItemEvent $event) {
        $item = $event->getItem();
        $player = $event->getPlayer();
        $event->setCancelled();
    }

}