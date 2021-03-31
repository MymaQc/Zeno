<?php


namespace Zeno\Commands;

use Zeno\Core;
use Zeno\Others\KitForms;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

class Kit extends PluginCommand {

    private $plugin;

    public function __construct(Core $plugin) {
        parent::__construct("kit", $plugin);
        $this->setDescription("Choose a kit");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, $label, array $args) {
        $player = $sender->getPlayer();
        if ($player->getLevel()->getFolderName() == "soupkit") {
            KitForms::kit($sender);
            return true;
        } else {
            $sender->sendMessage("§l§a» §cYou cannot use this command in this world !");
            return true;
        }
    }
}
