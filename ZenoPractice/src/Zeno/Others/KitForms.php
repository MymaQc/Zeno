<?php

namespace Zeno\Others;

use Zeno\Form\SimpleForm;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\Player;

class KitForms extends SimpleForm {

    public static function kit(Player $player){ {
            $form = new SimpleForm(function (Player $player , $data) {
                    if ($data == null) {
                        $player->sendMessage("§l§a» §r§fYou have just selected the §aDefault §fkit !");
                    } else {
                        switch ($data) {
                            case 0:
                                $player->sendMessage("§l§a» §r§fYou have just selected the §aDefault §fkit !");
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
                                break;
                            case 1:
                                if ($player->hasPermission("kit.star")) {
                                    $player->sendMessage("§l§a» §r§fYou have just selected the §9Star §fkit !");
                                    $player->getArmorInventory()->clearAll();
                                    $player->removeAllEffects();
                                    $player->getInventory()->clearAll();
                                    $player->setHealth(20);
                                    $player->setFood(20);
                                    $player->setSaturation(20);

                                    $helmet1 = Item::get(Item::DIAMOND_HELMET, 0, 1);
                                    $helmet1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                    $helmet1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 1));
                                    $player->getArmorInventory()->setHelmet($helmet1);

                                    $chestplate1 = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                                    $chestplate1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                    $player->getArmorInventory()->setChestplate($chestplate1);

                                    $leggings1 = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                                    $player->getArmorInventory()->setLeggings($leggings1);

                                    $boots1 = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                                    $boots1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                    $boots1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 1));
                                    $player->getArmorInventory()->setBoots($boots1);

                                    $sword1 = Item::get(Item::DIAMOND_SWORD, 0, 1);
                                    $sword1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), 3));
                                    $sword1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                                    $player->getInventory()->setItem(0, ($sword1));

                                    $apple1 = Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 8);
                                    $player->getInventory()->setItem(8, ($apple1));

                                    $pearl1 = Item::get(Item::ENDER_PEARL, 0, 8);
                                    $player->getInventory()->setItem(1, ($pearl1));

                                    $soup1 = Item::get(Item::SLIME_BALL, 0, 64);
                                    $player->getInventory()->setItem(2, ($soup1));
                                } else {
                                    $player->sendMessage("§l§a» §r§cYou do not have permission to use this kit !");
                                    KitForms::kit($player);
                                } break;
                            case 2:
                                if ($player->hasPermission("kit.youtube")) {
                                    $player->getArmorInventory()->clearAll();
                                    $player->sendMessage("§l§a» §r§fYou have just selected the §cYoutube §fkit !");
                                    $player->removeAllEffects();
                                    $player->getInventory()->clearAll();
                                    $player->setHealth(20);
                                    $player->setFood(20);
                                    $player->setSaturation(20);

                                    $helmet2 = Item::get(Item::DIAMOND_HELMET, 0, 1);
                                    $helmet2->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                    $player->getArmorInventory()->setHelmet($helmet2);

                                    $chestplate2 = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                                    $player->getArmorInventory()->setChestplate($chestplate2);

                                    $leggings2 = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                                    $leggings2->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                    $player->getArmorInventory()->setLeggings($leggings2);

                                    $boots2 = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                                    $boots2->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                    $player->getArmorInventory()->setBoots($boots2);

                                    $sword2 = Item::get(Item::DIAMOND_SWORD, 0, 1);
                                    $sword2->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), 3));
                                    $sword2->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                                    $player->getInventory()->setItem(0, ($sword2));

                                    $apple2 = Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 10);
                                    $player->getInventory()->setItem(8, ($apple2));

                                    $pearl2 = Item::get(Item::ENDER_PEARL, 0, 10);
                                    $player->getInventory()->setItem(1, ($pearl2));

                                    $soup2 = Item::get(Item::SLIME_BALL, 0, 64);
                                    $player->getInventory()->setItem(2, ($soup2));
                                } else {
                                    $player->sendMessage("§l§a» §r§cYou do not have permission to use this kit !");
                                    KitForms::kit($player);
                                } break;
                        }
                    }
                }
            );
            $form->setTitle("Kit");
            $form->addButton("Default",0,"textures/items/gold_ingot.png");
            $form->addButton("Star",0,"textures/items/diamond.png");
            $form->addButton("Youtube",0,"textures/items/emerald.png");
            $player->sendForm($form);
        }
    }
}