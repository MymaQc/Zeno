<?php

namespace Zeno\API;

use Zeno\Core;
use pocketmine\utils\Config;

class SanctionAPI {

    private $plugin;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function InsertBan($name, $value) {
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/Ban.json", Config::JSON);
        $config->set($name, $value);
        $config->save();
    }

    public function isBanned($name) {
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/Ban.json", Config::JSON);
        return $config->exists($name);
    }

    public function DeleteBan($name) {
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/Ban.json", Config::JSON);
        $config->remove($name);
        $config->save();
    }

    public function GetBan($name) {
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/Ban.json", Config::JSON);
        return $config->get($name);
    }

    public function InsertBanIP($ip, $name) {
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/BanIP.json", Config::JSON);
        $config->set($name, $ip);
        $config->save();
    }

    public function isBannedIP($name) {
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/BanIP.json", Config::JSON);
        return $config->exists($name);
    }

    public function DeleteBanIP($name) {
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/BanIP.json", Config::JSON);
        $config->remove($name);
        $config->save();
    }

    public function GetBanIP($name) {
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/BanIP.json", Config::JSON);
        return $config->get($name);
    }

    public function InsertMute($name, $value) {
        $name = strtolower($name);
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/Mute.json", Config::JSON);
        $config->set($name, $value);
        $config->save();
    }

    public function isMuted($name) {
        $name = strtolower($name);
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/Mute.json", Config::JSON);
        return $config->exists($name);
    }

    public function DeleteMute($name) {
        $name = strtolower($name);
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/Mute.json", Config::JSON);
        $config->remove($name);
        $config->save();
    }

    public function GetMute($name) {
        $name = strtolower($name);
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/Mute.json", Config::JSON);
        return $config->get($name);
    }


    public function getAllBans() {
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/Ban.json", Config::JSON);
        return $config->getAll();
    }

    public function getAllMutes() {
        $config = new Config(Core::getInstance()->getFolder() . "Sanctions/Mute.json", Config::JSON);
        return $config->getAll();
    }
}