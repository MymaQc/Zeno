<?php

namespace Zeno\Commands;

use pocketmine\command\CommandSender;
use pocketmine\Player;
use Zeno\Core;
use pocketmine\command\PluginCommand;

class Gamemode extends PluginCommand {

    /**
     * @var Core
     */
    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("gamemode", $plugin);
        $this->setDescription("Change your gamemode or that of a player");
        $this->setPermission("gamemode.cmd");
        $this->setAliases(["gm"]);
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(!isset($args[0])) {
            return $sender->sendMessage("§l§a» §r§cUsage: /gamemode (0/1/2/3) (name) !");
        }

        switch ($args[0]) {
            case 0:
                $gamemode = "Survival"; break;
            case 1:
                $gamemode = "Creative"; break;
            case 2:
                $gamemode = "Adventure"; break;
            case 3:
                $gamemode = "Spectator"; break;
            default:
                return $sender->sendMessage("§l§a» §r§cUsage: /gamemode (0/1/2/3) (name) !");
        }

        if ((!$sender->hasPermission("gamemode.cmd"))) {
            return $sender->sendMessage("§l§a» §r§cYou do not have permission to use this command !");
        }

        if(isset($args[1])) {
            if(!$this->plugin->getServer()->getPlayer($args[1]))$sender->sendMessage("§l§a» §r§c " . $args[1] . " §cis not connected.");
            $targetPlayer = $this->plugin->getServer()->getPlayer($args[1]);
            $targetPlayer->setGamemode((int)$args[0]);
            $targetPlayer->sendMessage("§l§a» §r§fYou are now in §a{$gamemode} Mod §f!");
            $sender->sendMessage("§l§a» §r§fYou put §a" . $targetPlayer->getName() . "§f in §a{$gamemode} Mod §f!");
        } else if (!$sender instanceof Player) {
                return $sender->sendMessage("§l§a» §r§cYou cannot use this command from the console !");
        } else {
            $sender->setGamemode((int)$args[0]);
            $sender->sendMessage("§l§a» §r§fYou are now in §a{$gamemode} Mod §f!");
        }
        return true;
    }
}