<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

class Mute extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("mute", $plugin);
        $this->setDescription("Mute a player");
        $this->setPermission("mute.cmd");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$sender->hasPermission("mute.cmd")) {
            return $sender->sendMessage("§l§a» §r§cYou do not have permission to use this command !");
        }

        if (!isset($args[0]) or !isset($args[1]) or !isset($args[2])) {
            return $sender->sendMessage("§l§a» §r§cUsage: /mute (name) (time) (reason) !");
        }

        if (ctype_alnum($args[1]) == false) {
            return $sender->sendMessage("§l§a» §r§cUsage: /mute (name) (time) (reason) !");
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
            return $sender->sendMessage("§l§a» §r§cUsage: /mute (name) (time) (reason) !");
        }

        $raison = [];
        for ($i = 2; $i < count($args); $i++) {
            array_push($raison, $args[$i]);
        }
        $raison = implode(" ", $raison);

        if ($this->plugin->getServer()->getPlayer($args[0]) instanceof Player) {
            $target = $this->plugin->getServer()->getPlayer($args[0]);
            $targetName = $target->getName();
            $this->plugin->getServer()->broadcastMessage("§l§a» §r§a" . $targetName . "§f was muted from Zeno by §a" . $sender->getName() . "§f for §a" . $raison . "§f !");
            $mute = "{$sender->getName()}:{$temp}:{$raison}";
            $this->plugin->getSanctionAPI()->InsertMute(strtolower($targetName), $mute);
        } else {
            $targetName = strtolower($args[0]);
            $this->plugin->getServer()->broadcastMessage("§l§a» §r§a" . $targetName . "§f was muted from Zeno by §a" . $sender->getName() . "§f for §a" . $raison . "§f !");
            $mute = "{$sender->getName()}:{$temp}:{$raison}";
            $this->plugin->getSanctionAPI()->InsertMute($targetName, $mute);
        }
        return true;
    }
}