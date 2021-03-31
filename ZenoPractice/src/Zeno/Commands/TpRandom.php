<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class TpRandom extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("tpr", $plugin);
        $this->setDescription("Randomly teleport to a player");
        $this->setPermission("tpr.cmd");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        $players = $this->plugin->getServer()->getOnlinePlayers();
        if (!($sender instanceof Player)) {
            return true;
        }

        if (!($sender->hasPermission("tpr.cmd"))) {
            return $sender->sendMessage("§l§a» §r§cYou do not have permission to use this command !");
        }

        if (count($players) <= 1) {
            return $sender->sendMessage("§l§a» §r§cNo player is connected on the server !");
        }

        $random = $players[array_rand($players)];
        while ($random === $sender) {
            $random = $players[array_rand($players)];
        }

        $sender->teleport($random);
        $sender->sendMessage("§l§a» §r§fYou have been telephoned to §a{$random->getName()}§f !");
        return true;
    }

}