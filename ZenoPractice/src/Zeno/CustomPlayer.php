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

    public function knockBack(Entity $attacker, float $damage, float $x, float $z, float $base = 0.4): void {
        if ($attacker instanceof self) {
            $f = sqrt($x * $x + $z * $z);

            if ($f <= 0){
                return;
            }

            if (mt_rand() / mt_getrandmax() > $this->getAttributeMap()->getAttribute(Attribute::KNOCKBACK_RESISTANCE)->getValue()){
                $f = 1 / $f;

                $motion = clone $this->motion;

                $motion->x /= 2;
                $motion->y /= 2;
                $motion->z /= 2;
                $motion->x += $x * $f * $base * 1.0685;
                $motion->y += $base * 0.97;
                $motion->z += $z * $f * $base * 1.0685;
                var_dump($motion);

                if ($motion->y > $base) {
                    $motion->y = $base;
                }

                $this->setMotion($motion);
            }
            return;
        }
        parent::knockBack($attacker, $damage, $x, $z, $base);
    }

}