<?php

namespace Zeno;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Core extends PluginBase implements Listener {

    public function onEnable() {
        $corelaunch = TextFormat::DARK_GREEN . "[" . TextFormat::GREEN . "Zeno" . TextFormat::DARK_GREEN . "]" . TextFormat::WHITE . " ZenoKitmap plugin enable !";
        $this->getLogger()->info($corelaunch);
    }

    public function onDisable() {
        foreach($this->getServer()->getOnlinePlayers() as $players) {
            $players->kick("§aServer restart", false);
        }
    }

    // TODO: Changer le path
    public function getFolder() : string {
        return "/var/lib/pufferpanel/servers/2f1b5c88/plugin_data/ZenoDatas/";
    }

}