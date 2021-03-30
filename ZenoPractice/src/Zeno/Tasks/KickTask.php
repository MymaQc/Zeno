<?php

namespace Zeno\Tasks;

use Zeno\Core;
use Zeno\Events\PlayerJoin;
use pocketmine\Player;
use pocketmine\scheduler\Task;

class KickTask extends Task {

    private $core;
    private $player;
    private $plugin;
    private $time = 1;

    public function __construct(PlayerJoin $core, Player $player, Core $plugin) {
        $this->core = $core;
        $this->player = $player;
        $this->plugin = $plugin;
    }

    public function onRun($tick) {
        if ($this->time == 0) {
            $player = $this->player;
            $name = $player->getName();
            if ($this->plugin->getSanctionAPI()->isBanned(strtolower($name))) {
                $ban = $this->plugin->getSanctionAPI()->GetBan(strtolower($name));
                $ban = explode(":", $ban);
            } else {
                $ban = $this->plugin->getSanctionAPI()->GetBan($this->plugin->getSanctionAPI()->GetBanIP($player->getAddress()));
                $ban = explode(":", $ban);
            }

            $staff = $ban[0];
            $time = $ban[1];
            $raison = $ban[2];
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
                $formatTemp = "{$annee} année(s)";
            } else if ($mois > 0) {
                $formatTemp = "{$mois} mois et {$jours} jour(s)";
            } else if ($jours > 0) {
                $formatTemp = "{$jours} jour(s) et {$heures} heure(s)";
            } else if ($heures > 0) {
                $formatTemp = "{$heures} heure(s) et {$minutes} minute(s)";
            } else if ($minutes > 0) {
                $formatTemp = "{$minutes} minute(s) et {$secondes} seconde(s)";
            } else {
                $formatTemp = "{$secondes} seconde(s)";
            }

            $player->kick("§cYou are banned from Zeno Practice by " . $staff . "\n§cYou were banned for: §7" . $raison . "\n§6You may also purchase an unban at https://zenopractice.ml", false);
            $this->plugin->removeTask($this->getTaskId());
        } else {
            $this->time--;
        }
    }
}