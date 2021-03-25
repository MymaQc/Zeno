<?php

namespace Zeno;

use Zeno\API\{SanctionAPI, SelectAPI, ServerAPI};
use Zeno\Commands\{Ban, Banlist, Gamemode, Kick, KickAll, Knockback, Mute, Mutelist, Online, Ping, Say, Size, Tell, TpRandom, TPS, Unban, Unmute};
use Zeno\Events\{PlayerChat, PlayerCreation, PlayerDeath, PlayerJoin, PlayerPreLogin};
use Zeno\Selector\{SelectAllPlayers, SelectRandomPlayers};
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Core extends PluginBase implements Listener {

    /**
     * @var Config
     */
    public static $data;
    private static $instance;

    public function onEnable() {
        $corelaunch = TextFormat::DARK_GREEN . "[" . TextFormat::GREEN . "Zeno" . TextFormat::DARK_GREEN . "]" . TextFormat::WHITE . " ZenoCore enable !";
        $this->getLogger()->info($corelaunch);
        SelectAPI::registerSelector(new SelectAllPlayers());
        SelectAPI::registerSelector(new SelectRandomPlayers());
        $this->initCommands();
        $this->initEvents();
        if (!file_exists($this->getDataFolder()."knockback.yml")) {
            $this->saveResource('knockback.yml');
        } self::$data = new Config($this->getDataFolder() . "knockback.yml", Config::YAML);
        self::$instance = $this;
    }

    public function onDisable() {
        foreach($this->getServer()->getOnlinePlayers() as $players) {
            $players->kick("Server restart", false);
        }
    }

    private function registerCommand(Command $cmd) : void {
        $this->getServer()->getCommandMap()->register($cmd->getName(), $cmd);
    }

    private function unregisterCommand(string $name) : void {
        $map = $this->getServer()->getCommandMap();
        $cmd = $map->getCommand($name);
        if($cmd !== null) {
            $this->getServer()->getCommandMap()->unregister($cmd);
        }
    }

    private function initCommands() : void {
        $cmdunregister = ["mixer", "?", "help", "checkperm", "seed", "save-all", "save-on", "save-off", "particle", "reload", "difficulty", "dumpmemory",
            "defaultgamemode", "tell", "list", "ban", "plugins", "me", "say", "about", "pardon", "kick", "gamemode", "pardon-ip", "unban-ip", "ban-ip", "banlist"];
        foreach ($cmdunregister as $unregister) {
            $this->unregisterCommand($unregister);
        }

        $cmdregister = [new Size($this), new Online($this), new Say($this), new Ban($this), new Mute($this), new TPS($this), new KickAll($this),
            new TpRandom($this), new Mutelist($this), new Ping($this), new Kick($this), new Unban($this), new Gamemode($this), new Banlist($this),
            new Unmute($this), new Tell($this), new Knockback($this)];
        foreach ($cmdregister as $register) {
            $this->registerCommand($register);
        }
    }

    private function registerEvent($event) : void {
        $this->getServer()->getPluginManager()->registerEvents($event, $this);
    }

    private function initEvents() : void {
        $events = [$this, new PlayerChat($this), new PlayerCreation($this), new PlayerDeath($this),
            new PlayerJoin($this), new PlayerPreLogin($this)];
        foreach($events as $event){
            $this->registerEvent($event);
        }
    }

    public static function getInstance() : Core {
        return self::$instance;
    }

    public function removeTask($id) {
        $this->getScheduler()->cancelTask($id);
    }

    public function getSanctionAPI() : SanctionAPI {
        return new SanctionAPI($this);
    }

    public function getServerAPI() : ServerAPI {
        return new ServerAPI($this);
    }

    public function getFolder() : string {
        return "/var/lib/pufferpanel/servers/2f1b5c88/plugin_data/ZenoDatas/";
    }

}