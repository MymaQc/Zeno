<?php

namespace Zeno\Tasks;

use Zeno\Core;
use pocketmine\level\particle\DustParticle;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class ParticleTask extends Task {

    public function __construct(Core $plugin){
        $this->plugin = $plugin;
    }

    public function onRun($task){
        foreach(Server::getInstance()->getOnlinePlayers() as $pl){
            $name = $pl->getPlayer()->getName();
            $level = $pl->getLevel();
            $player = $pl->getPlayer();
            $players = $player->getLevel()->getPlayers();
            $x = $pl->getX();
            $y = $pl->getY() + 2;
            $z = $pl->getZ();
            if(in_array($name, $this->plugin->blue)){
                $r = 0;
                $g = 0;
                $b = 255;
                $center = new Vector3($x, $y, $z);
                $particle = new DustParticle($center, $r, $g, $b, 1);
                for($yaw = 0; $yaw <= 10; $yaw += (M_PI * 2) / 20){
                    $x = -sin($yaw) + $center->x;
                    $z = cos($yaw) + $center->z;
                    $y = $center->y;
                    $particle->setComponents($x, $y, $z);
                    $level->addParticle($particle);
                }
            }

            if(in_array($name, $this->plugin->red)){
                $r = 255;
                $g = 0;
                $b = 0;
                $center = new Vector3($x, $y, $z);
                $particle = new DustParticle($center, $r, $g, $b, 1);
                for($yaw = 0; $yaw <= 10; $yaw += (M_PI * 2) / 20){
                    $x = -sin($yaw) + $center->x;
                    $z = cos($yaw) + $center->z;
                    $y = $center->y;
                    $particle->setComponents($x, $y, $z);
                    $level->addParticle($particle);
                }
            }

            if(in_array($name, $this->plugin->green)){
                $r = 0;
                $g = 255;
                $b = 0;
                $center = new Vector3($x, $y, $z);
                $particle = new DustParticle($center, $r, $g, $b, 1);
                for($yaw = 0; $yaw <= 10; $yaw += (M_PI * 2) / 20){
                    $x = -sin($yaw) + $center->x;
                    $z = cos($yaw) + $center->z;
                    $y = $center->y;
                    $particle->setComponents($x, $y, $z);
                    $level->addParticle($particle);
                }
            }
        }
    }
}