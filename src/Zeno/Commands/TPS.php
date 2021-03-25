<?php


namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\TextFormat;

class TPS extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("tps", $plugin);
        $this->setDescription("View Server TPS");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        $tpsColor = TextFormat::GREEN;
        $server = Core::getInstance()->getServer();
        if ($server->getTicksPerSecond() < 17) {
            $tpsColor = TextFormat::GOLD;
        } elseif ($server->getTicksPerSecond() < 12) {
            $tpsColor = TextFormat::RED;
        }

        $sender->sendMessage("§l§a» §r§fServer performance §l§a«");
        $sender->sendMessage("\n");
        $sender->sendMessage("§l§a» §r§fCurrent TPS: {$tpsColor}{$server->getTicksPerSecond()} ({$server->getTickUsage()}%)");
        $sender->sendMessage("§l§a» §r§fAverage TPS: {$tpsColor}{$server->getTicksPerSecondAverage()} ({$server->getTickUsageAverage()}%)");
        return true;
    }
}