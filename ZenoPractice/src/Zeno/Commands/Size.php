<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

class Size extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("size", $plugin);
        $this->setDescription("Change your size");
        $this->setPermission("size.cmd");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!($sender instanceof Player)) {
            return true;
        }

        if (!($sender->hasPermission("size.cmd"))) {
            return $sender->sendMessage("§l§a» §r§cYou do not have permission to use this command !");
        }

        if (!(isset($args[0]))) {
            return $sender->sendMessage("§l§a» §r§cUsage: /size (number [0.1/3]) !");
        }

        if (!(is_numeric($args[0]))) {
            return $sender->sendMessage("§l§a» §r§cUsage: /size (number [0.1/3]) !");
        }

        if (!($args[0] >= 0.1 and $args[0] <= 3)) {
            return $sender->sendMessage("§l§a» §r§cUsage: /size (number [0.1/3]) !");
        }

        $sender->setScale($args[0]);
        $sender->sendMessage("§l§a» §r§fYour size has been changed to §a{$args[0]} §f!");

        return true;
    }
}