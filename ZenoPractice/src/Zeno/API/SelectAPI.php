<?php

namespace Zeno\API;

use Zeno\Core;
use Zeno\Selector\Select;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\server\CommandEvent;

class SelectAPI {

    private $plugin;
    public static $selectors;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    /**
     *
     * @param CommandEvent $event
     * @priority HIGHEST
     * @return void
     *
     */
    public function onServerCommand(CommandEvent $event): void{
        if(!$event->getSender() instanceof ConsoleCommandSender)
            return;
        $m = $event->getCommand();
        if($this->execSelectors($m, $event->getSender())) $event->setCancelled();
    }

    /**
     *
     * @param string $m
     * @param CommandSender $sender
     * @return bool
     *
     */
    public function execSelectors(string $m, CommandSender $sender): bool{
        preg_match_all($this->buildRegExr(), $m, $matches);
        $commandsToExecute = [$m];
        foreach($matches[0] as $index => $match){
            if(isset(self::$selectors[$matches[1][$index]])){
                $params = self::$selectors[$matches[1][$index]]->acceptsModifiers() ? $this->checkArgParams($matches, $index): [];
                $newCommandsToExecute = [];
                foreach($commandsToExecute as $indexB => $cmd){
                    foreach(self::$selectors[$matches[1][$indexB]]->applySelector($sender, $params) as $selectorStr){
                        if(strpos($selectorStr, " ") !== -1) $selectorStr = explode(" ", $selectorStr)[count(explode(" ", $selectorStr)) - 1]; // Name w/ spaces. Match the nearest name in the player. Not perfect :/
                        $newCommandsToExecute[] = substr_replace($cmd, " " . $selectorStr . " ", strpos($cmd, $match), strlen($match));
                    }
                    if(count($newCommandsToExecute) == 0) {
                        $sender->sendMessage("§cYour selector $match (" . self::$selectors[$matches[1][$indexB]]->getName() . ") did not match any player/entity.");
                        return true;
                    }
                } $commandsToExecute = $newCommandsToExecute;
            }
        }

        if(!isset($matches[0][0]))
            return false;
        foreach($commandsToExecute as $cmd){
            $this->plugin->getServer()->dispatchCommand($sender, $cmd);
        } return true;
    }

    public static function checkArgParams(array $match, int $index): array{
        $params = [];
        if (strlen($match[2][$index]) !== 0) {
            if (strpos($match[3][$index], ",") !== -1) {
                foreach (explode(",", $match[3][$index]) as $param) {
                    $parts = explode("=", $param);
                    $params[$parts[0]] = $parts[1];
                }
            } else {
                $parts = explode("=", $match[3][$index]);
                $params[$parts[0]] = $parts[1];
            }
        } return $params;
    }

    public static function buildRegExr() : string {
        $regexr = "/ @(";
        $regexr .= preg_replace("/(\\$|\\(|\\)|\\^|\\[|\\])/", "\\\\$1",
            implode("|", array_keys(self::$selectors))
        );

        $regexr .= ")(\\[(((\w+)?=(.)+(,)?){1,})\\])?";
        $regexr .= "( |$)/";
        return $regexr;
    }

    public static function registerSelector(Select $sel): void{
        self::$selectors[$sel->getSelectorChar()] = $sel;
    }

    public static function unregisterSelector(string $selChar): void{
        unset(self::$selectors[$selChar]);
    }

    public static function getSelector(string $selChar) : Select {
        return self::$selectors[$selChar];
    }
}