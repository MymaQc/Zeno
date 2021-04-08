<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;

class Knockback extends Command {

    private $plugin;

    public function __construct(Core $plugin){
        parent::__construct("knockback", "Edit server knockback");
        $this->setPermission("OP");
        $this->plugin = $plugin;
    }

    public function getPlugin() : Plugin {
        return $this->plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool {
        if ($sender->isOp()) {
            if (!empty($args[4])) {
                $world = strtolower($args[0]);
                $x = $args[1];
                $y = $args[2];
                $z = $args[3];
                $cooldown = $args[4];
                if ($world === "default") {
                    $data = Core::$data;
                    $data->set("default-x", (float)$x);
                    $data->set("default-y", (float)$y);
                    $data->set("default-z", (float)$z);
                    $data->set("default-cooldown", (int)$cooldown);
                    $data->save();
                    $sender->sendMessage("§l§a» §r§fThe default knockback has been changed !");
                } else {
                    $data = Core::$data;
                    $datas = [
                        "x" => (float)$x,
                        "y" => (float)$y,
                        "z" => (float)$z,
                        "cooldown" => (int)$cooldown
                    ];
                    $data->set($world, $datas);
                    $data->save();
                    $sender->sendMessage("§l§a» §r§fThe ". $world . " world knockback has been changed !");
                } return true;
            }
            $sender->sendMessage("§l§a» §r§cUsage: /knockback (world) (x) (y) (z) (hit delay) !");
            return false;
        } return false;
    }

}