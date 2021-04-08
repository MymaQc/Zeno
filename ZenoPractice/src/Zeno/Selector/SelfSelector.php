<?php

declare(strict_types=1);

namespace Zeno\Selector;

use pocketmine\command\CommandSender;

class SelfSelector extends Select {
    
    public function __construct(){
        parent::__construct("Self", "s", false);
    }

    public function applySelector(CommandSender $sender, array $parameters = []): array{
        return [$sender->getName()];
    }
}