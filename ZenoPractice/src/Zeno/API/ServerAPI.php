<?php

namespace Zeno\API;

use Zeno\Core;
use pocketmine\Player;

class ServerAPI {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    /**
     * @param Player $player
     * @return int
     */

    public static function getPotionsCount(Player $player) : int {
        $potions = 0;
        foreach ($player->getInventory()->getContents() as $item) {
            if ($item->getId() == 438) $potions++;
        } return $potions;
    }

}