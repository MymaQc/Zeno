<?php

namespace Zeno\Events;

use Zeno\Core;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class PlayerChat implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function PlayerChat(PlayerChatEvent $event) {
        $player = $event->getPlayer();
        $name = $player->getName();

        if ($this->plugin->getSanctionAPI()->isMuted(strtolower($name))) {
            $mute = $this->plugin->getSanctionAPI()->GetMute(strtolower($name));
            $mute = explode(":", $mute);
            $staff = $mute[0];
            $time = $mute[1];
            $raison = $mute[2];
            if ($time - time() <= 0) {
                $this->plugin->getSanctionAPI()->DeleteMute(strtolower($name));
                $player->sendMessage("§l§a» §r§fYou have been unmute !");
            } else {
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
                $player->sendMessage("§l§a» §r§cYou are still mute for " . $formatTemp . " !");
                $event->setCancelled(true);
                return true;
            }
        } return true;
    }
}