<?php

namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class Ping extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin){
        parent::__construct("ping", $plugin);
        $this->setDescription("Know your approximate latency");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if ($sender instanceof Player) {
            $ping = $sender->getPing();

            if (!isset($args[0])) {
                if ($ping < 100) {
                    $ping = "§a{$ping}ms";
                }
                if ($ping >= 100 and $ping < 300) {
                    $ping = "§6{$ping}ms";
                }
                if ($ping >= 300) {
                    $ping = "§c{$ping}ms";
                }
                $sender->sendMessage("§l§a» §r§fYou currently have {$ping} §f!");
            } else if ($this->plugin->getServer()->getPlayer($args[0]) instanceof Player) {
                $pinger = $this->plugin->getServer()->getPlayer($args[0]);
                $ping = $pinger->getPing();
                if($ping < 100) {
                    $ping = "§a{$ping}ms";
                }
                if($ping >= 100 and $ping < 300) {
                    $ping = "§6{$ping}ms";
                }
                if($ping >= 300) {
                    $ping = "§c{$ping}ms";
                }
                $sender->sendMessage("§l§a» §r§a{$pinger->getName()} §fcurrently has {$ping} §f!");
            } else {
                $pingerName = $args[0];
                $sender->sendMessage("§l§a» §r§c{$pingerName} is not connected !");
            }
        } else {
            $sender->sendMessage("§l§a» §r§cYou cannot use this command from the console !");
        }
        return true;
    }
}