<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\plugin\Plugin;

class Kick extends PluginCommand {

    protected $core;

    public function __construct(Core $core) {
        parent::__construct("kick", $core);
        $this->setDescription("Kick a player");
        $this->setPermission("kick.cmd");
        $this->core = $core;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$sender->hasPermission("kick.cmd")) {
            return $sender->sendMessage("§l§a» §r§cYou do not have permission to use this command !");
        }

        if (count($args) < 2) {
            return $sender->sendMessage("§l§a» §r§cUsage: /kick (name) (reason) !");
        }

        $victime = $this->core->getServer()->getPlayer($args[0]);
        $name = $victime->getName();
        $raison = [];
        for ($i = 1; $i < count($args); $i++) {
            array_push($raison, $args[$i]);
        }
        $raison = implode(" ", $raison);

        if ($victime == null) {
            return $sender->sendMessage("§l§a» §r§cPlayer not found.");
        }

        $this->core->getServer()->broadcastMessage("\n§a" . $name . "§f was kicked from Zeno by §a" . $sender->getName() . "§f for §c" . $raison . " §f!");
        $this->core->getServer()->broadcastMessage("\n");
        $victime->kick("§cYou are kicked from Zeno Practice by " . $sender->getName() . "\n§cYou were kicked for: §7" . $raison, false);
        return true;
    }

    public function getPlugin(): Plugin {
        return $this->core;
    }
}