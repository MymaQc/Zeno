<?php

namespace Zeno\Tasks;

use Zeno\Core;
use pocketmine\scheduler\Task;

class BroadcastMessageTask extends Task {

    public $plugin;
    private static $message = [
        "§l§a»» §r§fJoin our official §9Discord §fat §adiscord.gg/eBkxSd7UfY §f!",
        "§l§a»» §r§fBuy a rank for access to exlusive features, cosmetics or unban at §a... §f!"];
    private static $old = 0;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun(int $tick){
        $this->plugin->getServer()->broadcastMessage(self::$message[self::$old]);
        self::$old++;
        if(self::$old > count(self::$message)-1)self::$old = 0;
    }

}