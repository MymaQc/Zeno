<?php


namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

class Unban extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("unban", $plugin);
        $this->setDescription("Unban a player");
        $this->setPermission("unban.cmd");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$sender->hasPermission("unban.cmd")) {
            return $sender->sendMessage("§l§a» §r§cYou do not have permission to use this command !");
        }

        if (!isset($args[0])) {
            return $sender->sendMessage("§l§a» §r§cUsage: /unban (name) !");
        }

        if ($this->plugin->getSanctionAPI()->isBanned(strtolower($args[0])) == false) {
            return $sender->sendMessage("§l§a» §r§cThis player is not banned !");
        }

        $ban = $this->plugin->getSanctionAPI()->GetBan(strtolower($args[0]));
        $ban = explode(":", $ban);
        if ($ban[3] == "oui") {
            $this->plugin->getSanctionAPI()->DeleteBan(strtolower($args[0]));
            $this->plugin->getSanctionAPI()->DeleteBanIP($ban[4]);
        } else {
            $this->plugin->getSanctionAPI()->DeleteBan(strtolower($args[0]));
        }

        $sender->sendMessage("§l§a» §r§fYou have unbanned §a{$args[0]}§f !");
        return true;
    }
}