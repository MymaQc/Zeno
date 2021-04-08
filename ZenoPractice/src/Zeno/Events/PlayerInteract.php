<?php

namespace Zeno\Events;

use Zeno\Core;
use Zeno\Others\Settings;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\EnderPearl;

class PlayerInteract implements Listener {

    public static $cooldown;
    private $pcooldown;
    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function onInteract(PlayerInteractEvent $event) {
        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();
        if (isset(self::$cooldown[$player->getName()]) and self::$cooldown[$player->getName()] - time() > 0) {
            return;
        }

        if (!$event->getAction() == $event::RIGHT_CLICK_BLOCK and !$event->getAction() == $event::RIGHT_CLICK_AIR) {
            return;
        }

        self::$cooldown[$player->getName()] = time()+1;
        if ($item->getName() == "§r§aFFA") {
            $this->plugin->getArticulos()->MiniGM($player);
        } else if ($item->getName() == "§r§aEvent") {
            if ($player instanceof Player) {
                $this->plugin->getArticulos()->eventt($player);
            }
        } else if ($item->getName() === "§r§aSettings"){
            (new Settings)->settings($player);
        }
    }

    public function onEnderPearl(PlayerInteractEvent $event){
        $item = $event->getItem();
        if($event->getAction() === PlayerInteractEvent::RIGHT_CLICK_AIR) {
            if($item instanceof EnderPearl) {
                $cooldown = 10;
                $player = $event->getPlayer();
                if (isset($this->pcooldown[$player->getName()]) and time() - $this->pcooldown[$player->getName()] < $cooldown) {
                    $event->setCancelled(true);
                    $time = time() - $this->pcooldown[$player->getName()];
                    $message = "§a{cooldown}";
                    $message = str_replace("{cooldown}", ($cooldown - $time), $message);
                    $player->sendPopup($message);
                } else {
                    $this->pcooldown[$player->getName()] = time();
                }
            }
        }
    }

}