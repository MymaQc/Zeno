<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

class Spawn extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("spawn", $plugin);
        $this->setDescription("Teleport to spawn");
        $this->setAliases(["lobby", "hub"]);
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, $label, array $args) {
        if($sender instanceof Player) {
            $sender->teleport($this->plugin->getServer()->getDefaultLevel()->getSafeSpawn());
            $sender->removeAllEffects();
            $sender->setHealth(20);
            $sender->setMaxHealth(20);
            $sender->setScale(1.0);
            $sender->setGamemode(0);
            $sender->setFood(20);
            $sender->getArmorInventory()->clearAll();
            $sender->getInventory()->clearAll();
            $sender->setAllowFlight(false);
            $sender->sendMessage("§l§a» §r§fYou have been teleported to the spawn !");
            $this->plugin->getArticulos()->give($sender);
        }
    }

}