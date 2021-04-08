<?php

declare(strict_types=1);

namespace Zeno\Selector;

use pocketmine\command\CommandSender;
use pocketmine\entity\Entity;
use pocketmine\Player;
use pocketmine\math\Vector3;

abstract class Select {

    const DEFAULT_PARAMS = [
        "x" => 0,
        "y" => 0,
        "z" => 0,
        "lvl" => "",
        "dx" => 0,
        "dy" => 0,
        "dz" => 0,
        "r" => 0,
        "rm" => 0,
        "rx" => 180,
        "rxm" => 0,
        "ry" => 360,
        "rym" => 0,
        "c" => 0,
        "m" => -1,
        "l" => PHP_INT_MAX,
        "lm" => 0,
        "name" => "",
        "type" => "all",
        "tag" => "Health",
    ];

    protected $name;
    protected $selectorChar;
    protected $acceptModifiers;

    public function __construct(string $name, string $selectorChar, bool $acceptModifiers){
        $this->name = $name;
        $this->selectorChar = $selectorChar;
        $this->acceptModifiers = $acceptModifiers;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getSelectorChar(): string{
        return $this->selectorChar;
    }

    public function acceptsModifiers(): bool{
        return $this->acceptModifiers;
    }

    abstract public function applySelector(CommandSender $sender, array $parameters = []): array;

    public function checkDefaultParams(Entity $et, array $params): bool{
        $dist = sqrt($et->distanceSquared(new Vector3($params["x"], $params["y"], $params["z"])));
        if(($params["r"] !== 0 && $dist > $params["r"]) || $dist < $params["rm"]) return false;
        if($params["dx"] !== 0 && abs($et->x - $params["x"]) > $params["dx"]) return false;
        if($params["dy"] !== 0 && abs($et->y - $params["y"]) > $params["dy"]) return false;
        if($params["dz"] !== 0 && abs($et->z - $params["z"]) > $params["dz"]) return false;
        if($params["m"] !== -1 && $et instanceof Player && $et->getGamemode() !== $params["m"]) return false;
        if($params["rx"] < $et->getPitch() || $et->getPitch() < $params["rxm"]) return false;
        if($params["ry"] < $et->getYaw() || $et->getYaw() < $params["rym"]) return false;
        if($et instanceof Player && ($et->getXpLevel() > $params["l"] || $et->getXpLevel() < $params["lm"])) return false;
        if($params["name"] !== "" && (($et instanceof Player && $et->getDisplayName() !== $params["name"]) ||
                (!($et instanceof Player) && $et->getNameTag() !== $params["name"]))) return false;
        $etClassName = explode("\\", get_class($et))[count(explode("\\", get_class($et))) - 1];
        if(substr($params["type"], 0, 1) == "!" && $etClassName == substr($params["type"], 1)) return false;
        if($params["type"] !== "all" && $etClassName !== $params["type"]) return false;
        return true;
    }
}