<?php
declare(strict_types=1);


namespace Zeno\Selector;

use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\level\Position;

use Ad5001\PlayerSelectors\Main;


class Entities extends Select {
    
    public function __construct(){
        parent::__construct("Entities", "e", true);
    }

    public function applySelector(CommandSender $sender, array $parameters = []): array{
        $defaultParams = Select::DEFAULT_PARAMS;
        if($sender instanceof Position){
            $defaultParams["x"] = $sender->x;
            $defaultParams["y"] = $sender->y;
            $defaultParams["z"] = $sender->z;
        }
        $params = $parameters + $defaultParams;
        $return = [];
        foreach(Server::getInstance()->getLevels() as $lvl){
            foreach($lvl->getEntities() as $e){
                if($params["c"] !== 0 && count($return) == $params["c"]) continue;
                if($e->getLevel()->getName() !== $params["lvl"] && $params["lvl"] !== "") continue;
                if(!$this->checkDefaultParams($e, $params)) continue;
                $return[] = $e->getId();
            }
        }
        return array_merge($return, Main::getSelector("a")->applySelector($sender, $parameters));
    }
}