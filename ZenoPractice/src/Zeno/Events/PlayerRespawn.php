<?php


namespace Zeno\Events;

use Zeno\Core;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\Listener;

class PlayerRespawn implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function onRespawn(PlayerRespawnEvent $event) {
        $player = $event->getPlayer();
        $player->teleport($this->plugin->getServer()->getDefaultLevel()->getSafeSpawn());
        $player->setGamemode(0);
        $player->setHealth(20);
        $player->setFood(20);
        $player->setMaxHealth(20);
        $player->setScale(1);
        $player->setImmobile(false);
        $player->removeAllEffects();
        $player->getInventory()->clearAll();
        $player->getArmorInventory()->clearAll();
        $this->plugin->getArticulos()->give($player);
    }

}