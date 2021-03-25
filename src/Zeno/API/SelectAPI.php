<?php

namespace Zeno\API;

use Zeno\Core;
use Zeno\Selector\Select;

class SelectAPI {

    private $plugin;
    public static $selectors;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
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