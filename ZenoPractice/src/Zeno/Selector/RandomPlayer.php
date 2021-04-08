<?php
declare(strict_types=1);


namespace Zeno\Selector;

use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\level\Position;

class RandomPlayer extends Select {
    
    public function __construct(){
        parent::__construct("Random player", "r", true);
    }

    public function applySelector(CommandSender $sender, array $parameters = []): array{
        $defaultParams = Select::DEFAULT_PARAMS;
        if($sender instanceof Position){
            $defaultParams["x"] = $sender->x;
            $defaultParams["y"] = $sender->y;
            $defaultParams["z"] = $sender->z;
        }
        $params = $parameters + $defaultParams;
        $possible = [];
        foreach(Server::getInstance()->getOnlinePlayers() as $p){
            if($p->getLevel()->getName() !== $params["lvl"] && $params["lvl"] !== "") continue;
            if(!$this->checkDefaultParams($p, $params)) continue;
            $possible[] = $p;
        }
        if(count($possible) == 0) return [];
        return [$possible[array_rand($possible)]->getName()];
    }
}