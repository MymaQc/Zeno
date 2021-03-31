<?php

namespace Zeno\Events;

use Zeno\Core;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

class BlockBreak implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function onBreak(BlockBreakEvent $event) {
        $event->setDrops([]);
    }

}