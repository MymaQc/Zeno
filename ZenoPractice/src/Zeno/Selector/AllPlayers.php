<?php

declare(strict_types=1);

namespace Zeno\Selector;

use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\level\Position;


class AllPlayers extends Select {
    
    public function __construct(){
        parent::__construct("All players", "a", true);
    }

    /**
     *
     * @param CommandSender $sender
     * @param array $parameters
     * @return array
     *
     */
    public function applySelector(CommandSender $sender, array $parameters = []): array{
        $defaultParams = Select::DEFAULT_PARAMS;
        if($sender instanceof Position){
            $defaultParams["x"] = $sender->x;
            $defaultParams["y"] = $sender->y;
            $defaultParams["z"] = $sender->z;
        }
        $params = $parameters + $defaultParams;
        $return = [];
        foreach(Server::getInstance()->getOnlinePlayers() as $p){
            if($params["c"] !== 0 && count($return) == $params["c"]) continue;
            if($p->getLevel()->getName() !== $params["lvl"] && $params["lvl"] !== "") continue;
            if(!$this->checkDefaultParams($p, $params)) continue;
            $return[] = $p->getName();
        }
        return $return;
    }
}