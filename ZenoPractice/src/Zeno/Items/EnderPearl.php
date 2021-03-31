<?php

namespace Zeno\Items;

use pocketmine\item\EnderPearl as CustomEnderPearl;

class EnderPearl extends CustomEnderPearl {

    public function getMaxStackSize() : int {
        return 16;
    }

    public function getProjectileEntityType() : string {
        return "ThrownEnderpearl";
    }

    public function getThrowForce() : float {
        return 2;
    }

    public function getCooldownTicks() : int {
        return 20;
    }
}