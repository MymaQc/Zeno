<?php


namespace Zeno\Events;

use Zeno\Core;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;

class DataPacketReceive implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function noSoundDamage(DataPacketReceiveEvent $event) : void {
        $pk = $event->getPacket();
        $player = $event->getPlayer();
        if ($player instanceof Player){
            if ($pk instanceof LevelSoundEventPacket) {
                if ($pk->sound === LevelSoundEventPacket::SOUND_ATTACK_NODAMAGE or
                    $pk->sound === LevelSoundEventPacket::SOUND_ATTACK or
                    $pk->sound === LevelSoundEventPacket::SOUND_ATTACK_STRONG)
                    $event->setCancelled(true);
            }
        }
    }

}