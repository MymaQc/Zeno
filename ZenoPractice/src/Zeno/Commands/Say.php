<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\Plugin;

class Say extends PluginCommand {

    protected $core;

    public function __construct(Core $core) {
        parent::__construct("say", $core);
        $this->setDescription("Write a announcement");
        $this->setPermission("say.cmd");
        $this->setAliases(["announce"]);
        $this->core = $core;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($sender instanceof Player) {
            if ($sender->hasPermission("say.cmd")) {
                $this->core->getServer()->broadcastMessage("§l§a{$sender->getName()} » " . implode(" ", $args));
            } else {
                $sender->sendMessage("§l§a» §r§cYou do not have permission to use this command !");
            }
        } else {
            $this->core->getServer()->broadcastMessage("§l§aCONSOLE » " . implode(" ", $args));
        }
        return true;
    }

    public function getPlugin(): Plugin {
        return $this->core;
    }
}