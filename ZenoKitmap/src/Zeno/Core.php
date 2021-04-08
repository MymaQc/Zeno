<?php

namespace Zeno;

use Zeno\Events\PlayerDeath;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Core extends PluginBase implements Listener {

    private static $instance;

    public function onEnable() {
        $corelaunch = TextFormat::DARK_GREEN . "[" . TextFormat::GREEN . "Zeno" . TextFormat::DARK_GREEN . "]" . TextFormat::WHITE . " ZenoKitmap plugin enable !";
        $this->getLogger()->info($corelaunch);
        $this->initEvents();

        self::$instance = $this;
    }

    public function onDisable() {
        foreach($this->getServer()->getOnlinePlayers() as $players) {
            $players->kick("§aServer restart", false);
        }
    }

    private function registerEvent($event) : void {
        $this->getServer()->getPluginManager()->registerEvents($event, $this);
    }

    private function initEvents() : void {
        $events = [$this, new PlayerDeath($this)];
        foreach($events as $event){
            $this->registerEvent($event);
        }
    }

    public static function getInstance() : Core {
        return self::$instance;
    }

    // TODO: Changer le path
    public function getFolder() : string {
        return "/var/lib/pufferpanel/servers/2f1b5c88/plugin_data/ZenoDatas/";
    }

}