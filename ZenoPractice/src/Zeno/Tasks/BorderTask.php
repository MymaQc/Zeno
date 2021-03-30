<?php

namespace Zeno\Tasks;

use Zeno\Core;
use pocketmine\Player;
use pocketmine\scheduler\Task;

class BorderTask extends Task {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun($tick) {
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
            if ($player instanceof Player) {
                if ($player->getX() > 1500 or $player->getX() < -1500 or $player->getZ() > 2000 or $player->getZ() < -2000) {
                    $spawn = $player->getLevel()->getSpawnLocation();
                    $player->teleport($spawn);
                    $player->sendTip("§l§a» §r§cYou cannot go over the border ! §l§a«");
                }
            }
        }
    }

}