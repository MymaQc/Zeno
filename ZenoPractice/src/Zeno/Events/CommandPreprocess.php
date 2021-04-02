<?php

namespace Zeno\Events;

use Zeno\Core;
use pocketmine\event\Listener;
use pocketmine\event\server\CommandEvent;

class CommandPreprocess implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function onCommandEvent(CommandEvent $event) : void {
        $args = explode(" ", $event->getCommand());
        $command = strtolower(array_shift($args));
        if (!$args) {
            $event->setCommand($command);
            return;
        } $event->setCommand($command . " " . join(" ", $args));
    }

}