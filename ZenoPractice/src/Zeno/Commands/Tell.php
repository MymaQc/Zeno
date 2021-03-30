<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

class Tell extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("tell", $plugin);
        $this->setDescription("Send a private message");
        $this->setAliases(["w", "msg"]);
        $this->plugin=$plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(!$sender instanceof Player) {
            return true;
        }

        $player = $sender->getPlayer();
        $name = $player->getName();

        if ($this->plugin->getSanctionAPI()->isMuted(strtolower($name))) {
            return $sender->sendMessage("§l§a» §r§cYou are still muted !");
        }

        if(!isset($args[0])) {
            return $sender->sendMessage("§l§a» §r§cUsage: /tell (name) (message) !");
        }

        if($this->plugin->getServer()->getPlayer($args[0]) === null) {
            return $sender->sendMessage("§l§a» §r§cPlayer not found.");
        }

        if (count($args) < 2) {
            return $sender->sendMessage("§l§a» §r§cUsage: /tell (name) (message) !");
        }

        $target = $this->plugin->getServer()->getPlayer(array_shift($args));
        $message = implode(" ", $args);
        $sendername = $sender->getDisplayName();
        $targetname = $target->getDisplayName();

        if ($target instanceof Player) {
            $sender->sendMessage("§7(To §f" . $targetname . "§7) ".$message);
            $target->sendMessage("§7(From §f" . $sendername . "§7) ".$message);
        } return true;
    }

}