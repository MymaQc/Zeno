<?php
declare(strict_types=1);


namespace Zeno\Selector;

use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\level\Position;


class WorldPlayers extends Select {
    
    public function __construct(){
        parent::__construct("World players", "w", true);
    }

    public function applySelector(CommandSender $sender, array $parameters = []): array{
        $defaultParams = Select::DEFAULT_PARAMS;
        if($sender instanceof Position){
            $defaultParams["x"] = $sender->x;
            $defaultParams["y"] = $sender->y;
            $defaultParams["z"] = $sender->z;
            $defaultParams["lvl"] = $sender->getLevel()->getName();
        } else {
            $defaultParams["lvl"] = Server::getInstance()->getDefaultLevel()->getName();

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