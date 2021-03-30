<?php

namespace Zeno\Events;

use Zeno\Core;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;

class EntityDamage implements Listener {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function e_damage(EntityDamageEvent $event){
        if ($event->getCause()===EntityDamageEvent::CAUSE_FALL) {
            $event->setCancelled();
        }
    }

}