<?php

namespace Zeno\Events;

use Zeno\Core;
use Zeno\CustomPlayer;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCreationEvent;

class PlayerCreation implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function onPlayer(PlayerCreationEvent $event) : void {
        $event->setPlayerClass(CustomPlayer::class);
    }
}