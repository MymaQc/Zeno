<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

class Ban extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("ban", $plugin);
        $this->setDescription("Ban a player");
        $this->setPermission("ban.cmd");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$sender->hasPermission("ban.cmd")) {
            return $sender->sendMessage("§l§a» §r§cYou do not have permission to use this command !");
        }

        if (!isset($args[0]) or !isset($args[1]) or !isset($args[2]) or !isset($args[3])) {
            return $sender->sendMessage("§l§a» §r§cUsage: /ban (name) (time) (ip [yes/no]) (reason) !");
        }

        if (ctype_alnum($args[1]) == false) {
            return $sender->sendMessage("§l§a» §r§cUsage: /ban (name) (time) (ip [yes/no]) (reason) !");
        }

        $val = substr($args[1], -1);
        if ($val == "y") {
            $temp = time() + ((int)$args[1] * 31536000);
            $FormatTemp = (int)$args[1] . " année(s).";
        } else if ($val == "M") {
            $temp = time() + ((int)$args[1] * 2635200);
            $FormatTemp = (int)$args[1] . " mois.";
        } else if ($val == "w") {
            $temp = time() + ((int)$args[1] * 604800);
            $FormatTemp = (int)$args[1] . " semaine(s).";
        } else if ($val == "d") {
            $temp = time() + ((int)$args[1] * 86400);
            $FormatTemp = (int)$args[1] . " jour(s).";
        } else if ($val == "h") {
            $temp = time() + ((int)$args[1] * 3600);
            $FormatTemp = (int)$args[1] . " heure(s).";
        } else if ($val == "m") {
            $temp = time() + ((int)$args[1] * 60);
            $FormatTemp = (int)$args[1] . " minute(s).";
        } else if ($val == "s") {
            $temp = time() + ((int)$args[1]);
            $FormatTemp = (int)$args[1] . " seconde(s).";
        } else {
            return $sender->sendMessage("§l§a» §r§cUsage: /ban (name) (time) (ip [yes/no]) (reason) !");
        }

        $raison = [];
        for ($i = 3; $i < count($args); $i++) {
            array_push($raison, $args[$i]);
        }
        $raison = implode(" ", $raison);

        if ($this->plugin->getServer()->getPlayer($args[0]) instanceof Player) {
            $target = $this->plugin->getServer()->getPlayer($args[0]);
            $targetName = $target->getName();
            $this->plugin->getServer()->broadcastMessage("\n§a" . $targetName . "§f was banned from Zeno by §a" . $sender->getName() . "§f for §c" . $raison . " §f!\n\n");
            $target->kick("§cYou are banned from Zeno Practice by " . $sender->getName() . "\n§cYou were banned for: §7" . $raison . "\n§6You may also purchase an unban at https://zenopractice.ml", false);
            if ($args[2] == "oui") {
                $ban = "{$sender->getName()}:{$temp}:{$raison}:oui:{$target->getAddress()}";
                $this->plugin->getSanctionAPI()->InsertBan(strtolower($targetName), $ban);
                $this->plugin->getSanctionAPI()->InsertBanIP($target->getAddress(), strtolower($targetName));
            } else {
                $ban = "{$sender->getName()}:{$temp}:{$raison}:non";
                $this->plugin->getSanctionAPI()->InsertBan(strtolower($targetName), $ban);
            }
        } else {
            $targetName = strtolower($args[0]);
            $this->plugin->getServer()->broadcastMessage("\n§a" . $targetName . "§f was banned from Zeno by §a" . $sender->getName() . "§f for §c" . $raison . " §f!\n\n");
            $ban = "{$sender->getName()}:{$temp}:{$raison}:non";
            $this->plugin->getSanctionAPI()->InsertBan($targetName, $ban);
        }

        return true;
    }
}