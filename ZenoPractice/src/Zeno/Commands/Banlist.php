<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;

class Banlist extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("banlist", $plugin);
        $this->setDescription("See the list of banned players");
        $this->setPermission("banlist.cmd");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$sender->hasPermission("banlist.cmd")) {
            return $sender->sendMessage("§l§a» §r§cYou do not have permission to use this command");
        }

        $banlist = $this->plugin->getSanctionAPI()->getAllBans();
        if(count($banlist) <= 0) {
            return $sender->sendMessage("§l§a» §r§cNo player is banned from the server");
        }

        $banlist = array_reverse($banlist);
        $maxpages = intval(abs(count($banlist) / 10));
        $reste = count($banlist) % 10;

        if ($reste > 0) {
            $maxpage = $maxpages + 1;
        } else {
            $maxpage = $maxpages;
        }

        if ((isset($args[0])) and (!(is_numeric($args[0])))) {
            return $sender->sendMessage("§l§a» §r§cPlease specify a page between 1 and {$maxpage} !");
        }

        if (isset($args[0])) {
            $args[0] = intval($args[0]);
        }

        if (!isset($args[0]) or $args[0] == 1) {
            $deptop = 1;
            $fintop = 11;
            $page = 1;
        } else {
            $deptop = (($args[0] - 1) * 10) + 1;
            $fintop = (($args[0] - 1) * 10) + 11;
            $page = $args[0];
        }

        if ($page > $maxpage) {
            return $sender->sendMessage("§l§a» §r§cPlease specify a page between 1 and {$maxpage} !");
        }

        $top = 1;
        $sender->sendMessage("§l§a» §r§fList of banned players §a({$page}/{$maxpage}) §l§a«");
        $sender->sendMessage("\n");

        foreach ($banlist as $name => $value) {
            if ($top === $fintop) break;
            if ($top >= $deptop) {
                $ban = explode(":", $value);
                $time = $ban[1];
                $timeRestant = $time - time();
                $annee = intval(abs($timeRestant / 31536000));
                $timeRestant = $timeRestant - ($annee * 31536000);
                $mois = intval(abs($timeRestant / 2635200));
                $timeRestant = $timeRestant - ($mois * 2635200);
                $jours = intval(abs($timeRestant / 86400));
                $timeRestant = $timeRestant - ($jours * 86400);
                $heures = intval(abs($timeRestant / 3600));
                $timeRestant = $timeRestant - ($heures * 3600);
                $minutes = intval(abs($timeRestant / 60));
                $secondes = intval(abs($timeRestant - $minutes * 60));

                if ($annee > 0) {
                    $formatTemp = "{$annee}y";
                } else if ($mois > 0) {
                    $formatTemp = "{$mois}m{$jours}d";
                } else if ($jours > 1) {
                    $formatTemp = "{$jours}d{$heures}h";
                } else if ($heures > 0) {
                    $formatTemp = "{$heures}h{$minutes}m";
                } else if ($minutes > 0) {
                    $formatTemp = "{$minutes}m{$secondes}s";
                } else {
                    $formatTemp = "{$secondes}s";
                }

                $sender->sendMessage("§2[#{$top}] §a{$name} §f-> §a{$formatTemp}");
            }
            $top++;
        }
        return true;
    }
}