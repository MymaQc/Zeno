<?php

namespace Zeno\Events;

use Zeno\Core;
use Zeno\Tasks\KickTask;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;

class PlayerJoin implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function PlayerJoin(PlayerJoinEvent $event) {
        if ($event->getPlayer() instanceof Player) {
            $player = $event->getPlayer();
            $name = $player->getName();
            $event->setJoinMessage("");
            $this->plugin->getServer()->broadcastPopup("§a+ {$name} +");
            if ($this->plugin->getSanctionAPI()->isBanned(strtolower($name))) {
                $ban = $this->plugin->getSanctionAPI()->GetBan(strtolower($name));
                $ban = explode(":", $ban);
                $time = $ban[1];
                if ($time - time() <= 0) {
                    $this->plugin->getSanctionAPI()->DeleteBan(strtolower($name));
                    if ($this->plugin->getSanctionAPI()->isBannedIP($player->getAddress())) {
                        $this->plugin->getSanctionAPI()->DeleteBanIP($player->getAddress());
                    }
                } else {
                    $this->plugin->getScheduler()->scheduleRepeatingTask(new KickTask($this, $player, $this->plugin), 7);
                }
            } else if ($this->plugin->getSanctionAPI()->isBannedIP($player->getAddress())) {
                $banname = $this->plugin->getSanctionAPI()->GetBanIP($player->getAddress());
                $ban = $this->plugin->getSanctionAPI()->GetBan($banname);
                $ban = explode(":", $ban);
                $time = $ban[1];
                if ($time - time() <= 0) {
                    $this->plugin->getSanctionAPI()->DeleteBan($banname);
                    $this->plugin->getSanctionAPI()->DeleteBanIP($player->getAddress());
                } else {
                    $this->plugin->getScheduler()->scheduleRepeatingTask(new KickTask($this, $player, $this->plugin), 7);
                }
            }
        }
    }
}