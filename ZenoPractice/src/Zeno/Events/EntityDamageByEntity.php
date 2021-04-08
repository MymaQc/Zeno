<?php

namespace Zeno\Events;

use Zeno\Core;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\Player;

class Tonfront implements Listener {

    private $plugin;
    public static $cooldown;

    public function __construct(Core $plugin) {
        $this->plugin = $plugin;
    }

    public function OnDamage(EntityDamageByEntityEvent $event) : bool {
        $damager = $event->getDamager();
        $victim = $event->getEntity();
        if ($damager instanceof Player && $victim instanceof Player) {
            if ($event->getFinalDamage() >= $victim->getHealth()) {
                $level = $event->getDamager()->getLevel()->getName();
                $player = $damager;
                if (isset(self::$cooldown[$player->getName()]) and self::$cooldown[$player->getName()] - time() > 0) {
                    return true;
                }
                self::$cooldown[$player->getName()] = time()+1;
                switch ($level){
                    case "tonbouche":
                        $player->getArmorInventory()->clearAll();
                        return true;
                    case "gapple":
                        $player->getArmorInventory()->clearAll();
                        $player->removeAllEffects();
                        $player->getInventory()->clearAll();
                        $player->setHealth(20);
                        $player->setFood(20);
                        $player->setSaturation(20);
                        $helmet = Item::get(Item::DIAMOND_HELMET, 0, 1);
                        $helmet->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 4));
                        $player->getArmorInventory()->setHelmet($helmet);
                        $chestplate = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                        $chestplate->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 4));
                        $player->getArmorInventory()->setChestplate($chestplate);
                        $leggings = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                        $leggings->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 4));
                        $player->getArmorInventory()->setLeggings($leggings);
                        $boots = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                        $boots->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 4));
                        $player->getArmorInventory()->setBoots($boots);
                        $sword = Item::get(Item::DIAMOND_SWORD, 0, 1);
                        $sword->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), 5));
                        $player->getInventory()->setItem(0, ($sword));
                        $apple = Item::get(Item::GOLDEN_APPLE, 0, 10);
                        $player->getInventory()->setItem(1, ($apple));
                        return true;
                    case "nodebuff":
                        $player->getArmorInventory()->clearAll();
                        $player->removeAllEffects();
                        $player->getInventory()->clearAll();
                        $player->setHealth(20);
                        $player->setFood(20);
                        $player->setSaturation(20);
                        $helmet1 = Item::get(Item::DIAMOND_HELMET, 0, 1);
                        $helmet1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                        $player->getArmorInventory()->setHelmet($helmet1);
                        $chestplate1 = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                        $chestplate1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                        $player->getArmorInventory()->setChestplate($chestplate1);
                        $leggings1 = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                        $leggings1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                        $player->getArmorInventory()->setLeggings($leggings1);
                        $boots1 = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                        $boots1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                        $player->getArmorInventory()->setBoots($boots1);
                        $sword1 = Item::get(Item::DIAMOND_SWORD, 0, 1);
                        $sword1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                        $player->getInventory()->setItem(0, ($sword1));
                        $pearl1 = Item::get(Item::ENDER_PEARL, 0, 16);
                        $player->getInventory()->setItem(1, ($pearl1));
                        $pot1 = Item::get(Item::SPLASH_POTION, 22, 64);
                        $player->getInventory()->addItem($pot1);
                        $effect1 = new EffectInstance(Effect::getEffect(Effect::SPEED));
                        $effect1->setVisible(false);
                        $effect1->setAmplifier(0);
                        $effect1->setDuration(100 * 100 * 100);
                        $player->addEffect($effect1);
                        return true;
                    case "hivesumo":
                        $player->getArmorInventory()->clearAll();
                        $player->removeAllEffects();
                        $player->getInventory()->clearAll();
                        $player->setHealth(20);
                        $player->setFood(20);
                        $player->setSaturation(20);

                        $boots2 = Item::get(Item::CHAIN_BOOTS, 0, 1);
                        $player->getArmorInventory()->setBoots($boots2);

                        $effect2 = new EffectInstance(Effect::getEffect(Effect::RESISTANCE));
                        $effect2->setVisible(false);
                        $effect2->setAmplifier(1);
                        $effect2->setDuration(100 * 100 * 100);
                        $player->addEffect($effect2);
                        return true;
                    case "soupkit":
                        $player->getArmorInventory()->clearAll();
                        $player->removeAllEffects();
                        $player->getInventory()->clearAll();
                        $player->setHealth(20);
                        $player->setFood(20);
                        $player->setSaturation(20);
                        $helmet3 = Item::get(Item::DIAMOND_HELMET, 0, 1);
                        $helmet3->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                        $player->getArmorInventory()->setHelmet($helmet3);
                        $chestplate3 = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                        $player->getArmorInventory()->setChestplate($chestplate3);
                        $leggings3 = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                        $player->getArmorInventory()->setLeggings($leggings3);
                        $boots3 = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                        $boots3->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                        $player->getArmorInventory()->setBoots($boots3);
                        $sword3 = Item::get(Item::DIAMOND_SWORD, 0, 1);
                        $sword3->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), 3));
                        $sword3->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                        $player->getInventory()->setItem(0, ($sword3));
                        $apple3 = Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 4);
                        $player->getInventory()->setItem(8, ($apple3));
                        $pearl3 = Item::get(Item::ENDER_PEARL, 0, 6);
                        $player->getInventory()->setItem(1, ($pearl3));
                        $soup3 = Item::get(Item::SLIME_BALL, 0, 64);
                        $player->getInventory()->setItem(2, ($soup3));
                        return true;
                }
            }
        } return true;
    }

}