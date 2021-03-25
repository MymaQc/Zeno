<?php

namespace Zeno;

use pocketmine\entity\Attribute;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Player;

class CustomPlayer extends Player {

    /**
     * @param Entity $attacker
     * @param float $damage
     * @param float $x
     * @param float $z
     * @param float $base
     */
    public function knockBack(Entity $attacker, float $damage, float $x, float $z, float $base = 0.4) : void{
        if (Core::$data->exists($this->getLevel()->getFolderName())) {
            $data = Core::$data->get($this->getLevel()->getFolderName());
            $basex = $data["x"];
            $basey = $data["y"];
            $basez = $data["z"];
        } else {
            $data = Core::$data;
            $basex = $data->get("default-x");
            $basey = $data->get("default-y");
            $basez = $data->get("default-z");
        }

        $f = sqrt($x * $x + $z * $z);
        if ($f <= 0){
            return;
        }

        if (mt_rand() / mt_getrandmax() > $this->getAttributeMap()->getAttribute(Attribute::KNOCKBACK_RESISTANCE)->getValue()) {
            $f = 1 / $f;

            $motion = clone $this->motion;

            $motion->x /= 2;
            $motion->y /= 2;
            $motion->z /= 2;
            $motion->x += $x * $f * $basex;
            $motion->y += $basey;
            $motion->z += $z * $f * $basez;

            if($motion->y > $basey){
                $motion->y = $basey;
            }

            $this->setMotion($motion);
        }
    }

    public function attack(EntityDamageEvent $source) : void {
        parent::attack($source);
        if (Core::$data->exists($this->getLevel()->getFolderName())) {
            $data = Core::$data->get($this->getLevel()->getFolderName())["cooldown"];
        } else {
            $data = Core::$data->get("default-cooldown");
        }

        if ($source->isCancelled()) {
            return;
        }

        $attackSpeed = $data;

        if ($attackSpeed < 0) {
            $attackSpeed = 0;
        } $this->attackTime = $attackSpeed;
    }

}