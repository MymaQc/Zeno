<?php

namespace Zeno;

use Zeno\API\{SanctionAPI, SelectAPI, ServerAPI};
use Zeno\Commands\{Ban, Banlist, Gamemode, Kick, KickAll, Kit, Knockback, Mute, Mutelist, Online, Ping,
    Say, Size, Spawn, Tell, TpRandom, TPS, Unban, Unmute};
use Zeno\Entity\{EnderPearl, SplashPotion};
use Zeno\Events\{BlockBreak,
    CommandPreprocess,
    EntityDamage,
    PlayerChat,
    PlayerCreation,
    PlayerDeath,
    PlayerDropItem,
    PlayerExhaust,
    PlayerInteract,
    PlayerJoin,
    PlayerPreLogin,
    PlayerQuit};
use Zeno\Form\FormUI;
use Zeno\Listener\PotionListener;
use Zeno\Others\Gadgets;
use Zeno\Selector\{SelectAllPlayers, SelectRandomPlayers};
use Zeno\Tasks\{BorderTask, BroadcastMessageTask, ParticleTask};
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Core extends PluginBase implements Listener {

    /**
     * @var Config
     */

    use FormUI;
    public $red = array();
    public $green = array();
    public $blue = array();
    public static $cooldown;
    public static $data;
    private static $config;
    private static $instance;

    public function onEnable() {
        $corelaunch = TextFormat::DARK_GREEN . "[" . TextFormat::GREEN . "Zeno" . TextFormat::DARK_GREEN . "]" . TextFormat::WHITE . " ZenoPractice plugin enable !";
        $this->getLogger()->info($corelaunch);
        $this->getResource("config.yml");
        $this->saveResource("cooldown.yml");
        $this->saveDefaultConfig();
        @mkdir($this->getDataFolder());

        Item::initCreativeItems();
        SelectAPI::registerSelector(new SelectAllPlayers());
        SelectAPI::registerSelector(new SelectRandomPlayers());
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

    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $lvl = $player->getLevel();
        $player->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
        $player->setGamemode(0);
        $player->setHealth(20);
        $player->setFood(20);
        $player->setMaxHealth(20);
        $player->setScale(1);
        $player->setImmobile(false);
        $player->removeAllEffects();
        $this->getArticulos()->give($player);
    }

    public function onQuit(PlayerQuitEvent $event) {
        $player = $event->getPlayer();
        $player->getInventory()->clearAll();
        $player->getArmorInventory()->clearAll();
        $lvl = $player->getLevel();
    }

    public function onRespawn(PlayerRespawnEvent $event) {
        $player = $event->getPlayer();
        $player->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
        $player->setGamemode(0);
        $player->setHealth(20);
        $player->setFood(20);
        $player->setMaxHealth(20);
        $player->setScale(1);
        $player->setImmobile(false);
        $player->removeAllEffects();
        $player->getInventory()->clearAll();
        $player->getArmorInventory()->clearAll();
        $this->getArticulos()->give($player);
    }

    public function onInteract(PlayerInteractEvent $event) {
        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();
        if (isset(self::$cooldown[$player->getName()]) and self::$cooldown[$player->getName()] - time() > 0) {
            return;
        }

        if (!$event->getAction() == $event::RIGHT_CLICK_BLOCK and !$event->getAction() == $event::RIGHT_CLICK_AIR) {
            return;
        }

        self::$cooldown[$player->getName()] = time()+1;
        if ($item->getName() == "§r§aFFA") {
            $this->getArticulos()->MiniGM($player);
        } else if ($item->getName() == "§r§aEvent") {
            if ($player instanceof Player) {
                $this->getArticulos()->eventt($player);
            }
        } else if ($item->getName() === "§r§aSettings"){
            (new Others\Settings) -> settings($player);
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
            new EntityDamage($this), new BlockBreak($this), new PlayerDropItem($this),
            new PotionListener($this), new CommandPreprocess($this), new PlayerQuit($this)];
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