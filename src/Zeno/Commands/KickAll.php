<?php


namespace Zeno\Commands;

use Zeno\Core;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

class KickAll extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin){
        parent::__construct("kickall", $plugin);
        $this->setPermission("kickall.cmd");
        $this->setDescription("Kick all players from the server");
        $this->plugin=$plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if (!$sender->isOp()) {
            $sender->sendMessage("§l§a» §r§cYou do not have permission to use this command !");
            return;
        }

        foreach ($this->plugin->getServer()->getOnlinePlayers() as $online) {
            if(!$online->isOp()) {
                $online->kick("§cEverything was kicked off the server, try to join again later !", false);
            }
        }
    }

}