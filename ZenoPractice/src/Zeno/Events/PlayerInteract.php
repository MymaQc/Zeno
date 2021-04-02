<?php

namespace Zeno\Events;

use Zeno\Core;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\EnderPearl;

class PlayerInteract implements Listener {

    private $pcooldown;
    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
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