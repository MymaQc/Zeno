<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

class Unmute extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("unmute", $plugin);
        $this->setDescription("Unmute a player");
        $this->setPermission("unmute.cmd");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$sender->hasPermission("unmute.cmd")) {
            return $sender->sendMessage("§l§a» §r§cYou do not have permission to use this command !");
        }

        if (!isset($args[0])) {
            return $sender->sendMessage("§l§a» §r§cUsage: /unmute (name) !");
        }

        if ($this->plugin->getServer()->getPlayer($args[0]) == true) {
            $target = $this->plugin->getServer()->getPlayer($args[0]);
            $targetName = $target->getName();
            if ($this->plugin->getSanctionAPI()->isMuted($targetName) == false) {
                return $sender->sendMessage("§l§a» §r§cThis player is not muted !");
            }
            $this->plugin->getSanctionAPI()->DeleteMute($targetName);
            $target->sendMessage("§l§a» §r§fYou have been unmute !");
            $sender->sendMessage("§l§a» §r§fYou have unmuted §a{$targetName}§f !");
        } else {
            $targetName = strtolower($args[0]);
            if ($this->plugin->getSanctionAPI()->isMuted($targetName) == false) {
                return $sender->sendMessage("§l§a» §r§cThis player is not muted !");
            }
            $this->plugin->getSanctionAPI()->DeleteMute($targetName);
            $sender->sendMessage("§l§a» §r§fYou have unmuted §a{$targetName}§f !");
        }
        return true;
    }
}
