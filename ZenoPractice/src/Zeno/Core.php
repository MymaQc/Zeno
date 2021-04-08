<?php

namespace Zeno;

use Zeno\API\{SanctionAPI, SelectAPI, ServerAPI};
use Zeno\Commands\{Ban, Banlist, Gamemode, Kick, KickAll, Kit, Knockback, Mute, Mutelist, Online, Ping,
    Say, Size, Spawn, Tell, TpRandom, TPS, Unban, Unmute};
use Zeno\Entity\{EnderPearl, SplashPotion};
use Zeno\Events\{BlockBreak, DataPacketReceive, EntityDamage, EntityDamageByEntity,
    PlayerChat, PlayerCreation, PlayerDeath, PlayerDropItem, PlayerExhaust, PlayerInteract,
    PlayerJoin, PlayerPreLogin};
use Zeno\Form\FormUI;
use Zeno\Listener\PotionListener;
use Zeno\Others\{Gadgets};
use Zeno\Selector\{AllPlayers, ClosestPlayer, Entities, RandomPlayer, SelfSelector, WorldPlayers};
use Zeno\Tasks\{BorderTask, BroadcastMessageTask, ParticleTask};
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Core extends PluginBase implements Listener {

    use FormUI;
    public $red = array();
    public $green = array();
    public $blue = array();
    public static $cooldown;
    public static $data;
    private static $config;
    private static $instance;

    public function onEnable() {
        $corelaunch = "§2[§aZeno§2] §fZenoPractice plugin enable !";
        $this->getLogger()->info($corelaunch);
        $this->getResource("config.yml");
        $this->saveResource("cooldown.yml");
        $this->saveDefaultConfig();
        @mkdir($this->getDataFolder());

        Item::initCreativeItems();
        SelectAPI::registerSelector(new ClosestPlayer());
        SelectAPI::registerSelector(new AllPlayers());
        SelectAPI::registerSelector(new RandomPlayer());
        SelectAPI::registerSelector(new WorldPlayers());
        SelectAPI::registerSelector(new Entities());
        SelectAPI::registerSelector(new SelfSelector());
        Entity::registerEntity(SplashPotion::class, false, ['ThrownPotion', 'minecraft:potion', 'thrownpotion']);
        Entity::registerEntity(EnderPearl::class, false, ['ThrownEnderpearl', 'minecraft:ender_pearl']);
        for($i = 37; $i <= 42; $i++) {
            Item::removeCreativeItem(Item::get(Item::SPLASH_POTION, $i));
        }

        $this->getServer()->getPluginManager()->registerEvents(new Items\Soup(), $this);
        $this->getScheduler()->scheduleRepeatingTask(new ParticleTask($this), 10);
        $this->getScheduler()->scheduleRepeatingTask(new BorderTask($this), 20*5);
        $this->getScheduler()->scheduleRepeatingTask(new BroadcastMessageTask($this), 10000);
        $this->initCommands();
        $this->initEvents();
        if (!file_exists($this->getDataFolder()."knockback.yml")) {
            $this->saveResource('knockback.yml');
        }

        self::$config = new Config($this->getDataFolder()."cooldown.yml", Config::YAML);
        self::$data = new Config($this->getDataFolder() . "knockback.yml", Config::YAML);
        self::$instance = $this;

        $this->getServer()->loadLevel("spawn");
        $this->getServer()->loadLevel("gapple");
        $this->getServer()->loadLevel("nodebuff");
        $this->getServer()->loadLevel("soupkit");
        $this->getServer()->loadLevel("hivesumo");
    }

    public function onDisable() {
        foreach($this->getServer()->getOnlinePlayers() as $players) {
            $players->kick("§aServer restart", false);
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
            new Unmute($this), new Tell($this), new Knockback($this), new Spawn($this), new Kit($this)];
        foreach ($cmdregister as $register) {
            $this->registerCommand($register);
        }
    }

    private function registerEvent($event) : void {
        $this->getServer()->getPluginManager()->registerEvents($event, $this);
    }

    private function initEvents() : void {
        $events = [$this, new PlayerChat($this), new PlayerCreation($this), new PlayerDeath($this),
            new PlayerJoin($this), new PlayerPreLogin($this), new PlayerExhaust($this), new PlayerInteract($this),
            new EntityDamage($this), new EntityDamageByEntity($this), new BlockBreak($this), new PlayerDropItem($this),
            new PotionListener($this), new DataPacketReceive($this)];
        foreach($events as $event){
            $this->registerEvent($event);
        }
    }

    private function registerItem($item, $truefalse) : void {
        ItemFactory::registerItem($item, $truefalse);
    }

    private function initItems() : void {
        $items = new Items\EnderPearl();
        foreach($items as $item) {
            $this->registerItem($item, true);
        }
    }

    public static function getInstance() : Core {
        return self::$instance;
    }

    public function getArticulos() : Gadgets {
        return new Gadgets($this);
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