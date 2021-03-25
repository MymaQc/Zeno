<?php

namespace Zeno\Others;

use Zeno\Form\SimpleForm;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\Player;

class KitForms extends SimpleForm {

    public static function kit(Player $player){
        {
            $form = new SimpleForm
            (
                function (Player $pl , $data){
                    if ($data == null){
                        $pl->sendMessage("§l§a» §r§fYou have just selected the §aDefault §fkit !");
                    }else{
                        switch ($data){
                            case 0 :
                                $pl->sendMessage("§l§a» §r§fYou have just selected the §aDefault §fkit !");
                                $pl->getArmorInventory()->clearAll();
                                $pl->removeAllEffects();
                                $pl->getInventory()->clearAll();
                                $pl->setHealth(20);
                                $pl->setFood(20);
                                $pl->setSaturation(20);

                                $helmet3 = Item::get(Item::DIAMOND_HELMET, 0, 1);
                                $helmet3->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                $pl->getArmorInventory()->setHelmet($helmet3);

                                $chestplate3 = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                                $pl->getArmorInventory()->setChestplate($chestplate3);

                                $leggings3 = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                                $pl->getArmorInventory()->setLeggings($leggings3);

                                $boots3 = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                                $boots3->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                $pl->getArmorInventory()->setBoots($boots3);

                                $sword3 = Item::get(Item::DIAMOND_SWORD, 0, 1);
                                $sword3->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), 3));
                                $sword3->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                                $pl->getInventory()->setItem(0, ($sword3));

                                $apple3 = Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 4);
                                $pl->getInventory()->setItem(8, ($apple3));

                                $pearl3 = Item::get(Item::ENDER_PEARL, 0, 6);
                                $pl->getInventory()->setItem(1, ($pearl3));

                                $soup3 = Item::get(Item::SLIME_BALL, 0, 64);
                                $pl->getInventory()->setItem(2, ($soup3));


                                break;
                            case 1:
                                if($pl->hasPermission("kit.star")){
                                    $pl->sendMessage("§l§a» §r§fYou have just selected the §9Star §fkit !");
                                    $pl->getArmorInventory()->clearAll();
                                    $pl->removeAllEffects();
                                    $pl->getInventory()->clearAll();
                                    $pl->setHealth(20);
                                    $pl->setFood(20);
                                    $pl->setSaturation(20);

                                    $helmet1 = Item::get(Item::DIAMOND_HELMET, 0, 1);
                                    $helmet1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                    $helmet1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 1));
                                    $pl->getArmorInventory()->setHelmet($helmet1);

                                    $chestplate1 = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                                    $chestplate1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                    $pl->getArmorInventory()->setChestplate($chestplate1);

                                    $leggings1 = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                                    $pl->getArmorInventory()->setLeggings($leggings1);

                                    $boots1 = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                                    $boots1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                    $boots1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 1));
                                    $pl->getArmorInventory()->setBoots($boots1);

                                    $sword1 = Item::get(Item::DIAMOND_SWORD, 0, 1);
                                    $sword1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), 3));
                                    $sword1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                                    $pl->getInventory()->setItem(0, ($sword1));

                                    $apple1 = Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 8);
                                    $pl->getInventory()->setItem(8, ($apple1));

                                    $pearl1 = Item::get(Item::ENDER_PEARL, 0, 8);
                                    $pl->getInventory()->setItem(1, ($pearl1));

                                    $soup1 = Item::get(Item::SLIME_BALL, 0, 64);
                                    $pl->getInventory()->setItem(2, ($soup1));
                                }else{
                                    $pl->sendMessage("§l§a» §r§cYou do not have permission to use this kit !");
                                    \Corepractice\Others\KitForms::kit($pl);
                                }
                                break;
                            case 2:
                                if($pl->hasPermission("kit.youtube")){
                                    $pl->getArmorInventory()->clearAll();
                                    $pl->sendMessage("§l§a» §r§fYou have just selected the §cYoutube §fkit !");
                                    $pl->removeAllEffects();
                                    $pl->getInventory()->clearAll();
                                    $pl->setHealth(20);
                                    $pl->setFood(20);
                                    $pl->setSaturation(20);

                                    $helmet2 = Item::get(Item::DIAMOND_HELMET, 0, 1);
                                    $helmet2->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                    $pl->getArmorInventory()->setHelmet($helmet2);

                                    $chestplate2 = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                                    $pl->getArmorInventory()->setChestplate($chestplate2);

                                    $leggings2 = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                                    $leggings2->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                    $pl->getArmorInventory()->setLeggings($leggings2);

                                    $boots2 = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                                    $boots2->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                                    $pl->getArmorInventory()->setBoots($boots2);

                                    $sword2 = Item::get(Item::DIAMOND_SWORD, 0, 1);
                                    $sword2->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), 3));
                                    $sword2->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                                    $pl->getInventory()->setItem(0, ($sword2));

                                    $apple2 = Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 10);
                                    $pl->getInventory()->setItem(8, ($apple2));

                                    $pearl2 = Item::get(Item::ENDER_PEARL, 0, 10);
                                    $pl->getInventory()->setItem(1, ($pearl2));

                                    $soup2 = Item::get(Item::SLIME_BALL, 0, 64);
                                    $pl->getInventory()->setItem(2, ($soup2));
                                }else{
                                    $pl->sendMessage("§l§a» §r§cYou do not have permission to use this kit !");
                                    KitForms::kit($pl);
                                }
                                break;
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