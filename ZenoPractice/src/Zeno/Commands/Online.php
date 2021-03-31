<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class Online extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("list", $plugin);
        $this->setDescription("See the list of connected players");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        $playerNames = array_map(function(Player $player) : string {
            return $player->getName();
        }, array_filter($sender->getServer()->getOnlinePlayers(), function(Player $player) use ($sender) : bool {
            return $player->isOnline() and (!($sender instanceof Player) or $sender->canSee($player));
        }));

        sort($playerNames, SORT_STRING);
        $count = count($playerNames);
        $sender->sendMessage("§l§a» §r§fList of online players §a(§9{$count}/{$sender->getServer()->getMaxPlayers()}) §l§a«");
        $sender->sendMessage("§f" . implode(",§f ", $playerNames));
        return true;
    }
}