<?php

namespace Zeno\Others;

use Zeno\Form\FormUI;
use Zeno\Form\SimpleForm;
use Zeno\Core;
use Zeno\Others\KitForms;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TE;

class Gadgets {

    private $plugin;
    use FormUI;

    public function __construct(Core $plugin){
        $this->plugin = $plugin;
    }

    public function give($pl){
        $pl->getInventory()->clearAll();
        $pl->getArmorInventory()->clearAll();
        $pl->getInventory()->setItem(4,Item::get(345,0,1)->setCustomName("§aFFA"));
        $pl->getInventory()->setItem(1,Item::get(388,0,1)->setCustomName("§aEvent"));
        $pl->getInventory()->setItem(7,Item::get(399,0,1)->setCustomName("§aSettings"));
    }

    public function MiniGM($pl){
        $form=new SimpleForm(function(Player $pl, $data=null):void{
            $result = $data;
            if($result === null){
                return;
            }
            switch($data){
                case "gapple":
                    $pl->sendMessage("§l§a» §r§fYou have been teleported to the §aGapple Arena §f!");
                    $pl->teleport(Server::getInstance()->getLevelByName('gapple')->getSafeSpawn());
                    $pl->getArmorInventory()->clearAll();
                    $pl->removeAllEffects();
                    $pl->getInventory()->clearAll();
                    $pl->setHealth(20);
                    $pl->setFood(20);
                    $pl->setSaturation(20);

                    $helmet = Item::get(Item::DIAMOND_HELMET, 0, 1);
                    $helmet->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 4));
                    $pl->getArmorInventory()->setHelmet($helmet);

                    $chestplate = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                    $chestplate->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 4));
                    $pl->getArmorInventory()->setChestplate($chestplate);

                    $leggings = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                    $leggings->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 4));
                    $pl->getArmorInventory()->setLeggings($leggings);

                    $boots = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                    $boots->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 4));
                    $pl->getArmorInventory()->setBoots($boots);

                    $sword = Item::get(Item::DIAMOND_SWORD, 0, 1);
                    $sword->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), 5));
                    $pl->getInventory()->setItem(0, ($sword));

                    $apple = Item::get(Item::GOLDEN_APPLE, 0, 10);
                    $pl->getInventory()->setItem(1, ($apple));


                    //effect
                    //$effect = new EffectInstance(Effect::getEffect(Effect::SPEED));
                    //$effect->setVisible(false);
                    //$effect->setAmplifier(0);
                    //$effect->setDuration(100 * 100 * 100);
                    //$pl->addEffect($effect);
                    break;
                case "nodebuff":
                    $pl->sendMessage("§l§a» §r§fYou have been teleported to the §aNodebuff Arena §f!");
                    $pl->teleport(Server::getInstance()->getLevelByName('nodebuff')->getSafeSpawn());
                    $pl->getArmorInventory()->clearAll();
                    $pl->removeAllEffects();
                    $pl->getInventory()->clearAll();
                    $pl->setHealth(20);
                    $pl->setFood(20);
                    $pl->setSaturation(20);

                    $helmet1 = Item::get(Item::DIAMOND_HELMET, 0, 1);
                    $helmet1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                    $pl->getArmorInventory()->setHelmet($helmet1);

                    $chestplate1 = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                    $chestplate1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                    $pl->getArmorInventory()->setChestplate($chestplate1);

                    $leggings1 = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                    $leggings1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                    $pl->getArmorInventory()->setLeggings($leggings1);

                    $boots1 = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                    $boots1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                    $pl->getArmorInventory()->setBoots($boots1);

                    $sword1 = Item::get(Item::DIAMOND_SWORD, 0, 1);
                    $sword1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                    $pl->getInventory()->setItem(0, ($sword1));

                    $pearl1 = Item::get(Item::ENDER_PEARL, 0, 16);
                    $pl->getInventory()->setItem(1, ($pearl1));

                    $pot1 = Item::get(Item::SPLASH_POTION, 22, 64);
                    $pl->getInventory()->addItem($pot1);
                    //effect
                    $effect1 = new EffectInstance(Effect::getEffect(Effect::SPEED));
                    $effect1->setVisible(false);
                    $effect1->setAmplifier(0);
                    $effect1->setDuration(100 * 100 * 100);
                    $pl->addEffect($effect1);
                    break;
                case "hivesumo":
                    $pl->sendMessage("§l§a» §r§fYou have been teleported to the §aHive Sumo Arena §f!");
                    $pl->teleport(Server::getInstance()->getLevelByName('hivesumo')->getSafeSpawn());
                    $pl->getArmorInventory()->clearAll();
                    $pl->removeAllEffects();
                    $pl->getInventory()->clearAll();
                    $pl->setHealth(20);
                    $pl->setFood(20);
                    $pl->setSaturation(20);

                    $boots2 = Item::get(Item::CHAIN_BOOTS, 0, 1);
                    $pl->getArmorInventory()->setBoots($boots2);

                    $effect2 = new EffectInstance(Effect::getEffect(Effect::RESISTANCE));
                    $effect2->setVisible(false);
                    $effect2->setAmplifier(1);
                    $effect2->setDuration(100 * 100 * 100);
                    $pl->addEffect($effect2);

                    break;
                case "soupkit":
                    $pl->sendMessage("§l§a» §r§fYou have been teleported to the §aSoup Arena §f!");
                    $pl->teleport(Server::getInstance()->getLevelByName('soupkit')->getSafeSpawn());
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

                    KitForms::kit($pl);
                    break;
            }
        });
        $nodebuff=$this->plugin->getServer()->getLevelByName("nodebuff");
        $gapple=$this->plugin->getServer()->getLevelByName("gapple");
        $hivesumo=$this->plugin->getServer()->getLevelByName("hivesumo");
        $soup=$this->plugin->getServer()->getLevelByName("soupkit");


        if(!$this->plugin->getServer()->isLevelLoaded("nodebuff")){
            $count1="§cOffline";
            $c1="offline";
        }else{
            $totalnodebuff=count($nodebuff->getPlayers());
            $count1="§fCurrently Playing: §2".$totalnodebuff;
            $c1="nodebuff";
        }
        if(!$this->plugin->getServer()->isLevelLoaded("gapple")){
            $count2="§cOffline";
            $c2="offline";
        }else{
            $totalgapple=count($gapple->getPlayers());
            $count2="§fCurrently Playing: §2".$totalgapple;
            $c2="gapple";
        }
        if(!$this->plugin->getServer()->isLevelLoaded("hivesumo")){
            $count4="§cOffline";
            $c4="offline";
        }else{
            $count4="§fCurrently Playing: §2".count($hivesumo->getPlayers());
            $c4="hivesumo";
        }
        if(!$this->plugin->getServer()->isLevelLoaded("soupkit")){
            $count5="§cOffline";
            $c5="offline";
        }else{
            $count5="§fCurrently Playing: §2".count($soup->getPlayers());
            $c5="soupkit";
        }

        $form->setTitle("FFA");
        $form->addButton("Gapple\n". $count2,0,"textures/items/apple_golden.png", $c2);
        $form->addButton("Nodebuff\n". $count1, 0,"textures/items/potion_bottle_splash_saturation.png", $c1);
        $form->addButton("Hive Sumo\n". $count4,0,"textures/items/feather.png", $c4);
        $form->addButton("Soup Fly\n". $count5 ,0,"textures/items/mushroom_stew.png", $c5);
        $form->sendToPlayer($pl);
        return $form;
    }

    public function Cms($pl){
        $form = $this->createSimpleForm(function (Player $pl, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    if($pl->hasPermission("nick.use")) {
                        $this->plugin->getServer()->dispatchCommand($pl, $this->plugin->getConfig()->get("command8"));
                    }else{
                        $pl -> sendMessage("§0- §6Vous n'avez pas la permission d'effectué ceci §0-");

                    }
                    break;
                case 1:
                    if($pl instanceof Player){
                        $this->Particles($pl);
                    } else {
                        $pl->sendMessage("§0- §6Vous n'avez pas la permission d'effectué ceci §0-");
                    }
                    break;
                case 2:
                    if($pl->hasPermission("core.cape")){
                        $this->plugin->getServer()->dispatchCommand($pl, $this->plugin->getConfig()->get("command7"));
                    }else{
                        $pl->sendMessage("§0- §6Vous n'avez pas la permission d'effectué ceci §0-");
                    }
                case 3:
                    break;
            }
        });
        $form->setTitle("§0Comestiques");
        $form->setContent("§7Seul les héro ou premium peuvent utilisé les comestiques.");
        $form->addButton("§6Nick",0,"textures/items/fireworks");
        $form->addButton("§6Particules",0,"textures/ui/icon_staffpicks");
        $form->addButton("§6Capes",0,"textures/items/banner_pattern");
        $form->addButton("§0Sortir",0,"textures/items/arrow");
        $form->sendToPlayer($pl);
        return $form;
    }


    public function Particles($pl){
        $form = $this->createSimpleForm(function (Player $pl, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    if($pl->hasPermission("core.blue")){
                        if(!in_array($pl->getName(), $this->plugin->blue)){
                            $this->plugin->blue[] = $pl->getName();
                            $pl->sendMessage($this->plugin->prefix.TE::WHITE."Vous avez séléctionné les particules ".TE::BLUE."bleu");
                            if(in_array($pl->getName(), $this->plugin->red)){
                                unset($this->plugin->red[array_search($pl->getName(), $this->plugin->red)]);
                            }elseif (in_array($pl->getName(), $this->plugin->green)){
                                unset($this->plugin->green[array_search($pl->getName(), $this->plugin->green)]);
                            }
                        }else{
                            unset($this->plugin->blue[array_search($pl->getName(), $this->plugin->blue)]);
                            $pl->sendMessage($this->plugin->prefix.TE::WHITE."Vous avez séléctionné les particules ".TE::BLUE."bleu");
                        }
                    }else{
                        $pl->sendMessage("§0- §6Vous n'avez pas la permission d'effectué ceci §0-");
                    }
                    break;
                case 1:
                    if($pl->hasPermission("core.red")){
                        if(!in_array($pl->getName(), $this->plugin->red)){
                            $this->plugin->red[] = $pl->getName();
                            $pl->sendMessage($this->plugin->prefix.TE::WHITE."Vous avez séléctionné les particules ".TE::RED."rouge");
                            if(in_array($pl->getName(), $this->plugin->blue)){
                                unset($this->plugin->blue[array_search($pl->getName(), $this->plugin->blue)]);
                            }elseif (in_array($pl->getName(), $this->plugin->green)){
                                unset($this->plugin->green[array_search($pl->getName(), $this->plugin->green)]);
                            }
                        }else{
                            unset($this->plugin->red[array_search($pl->getName(), $this->plugin->red)]);
                            $pl->sendMessage($this->plugin->prefix.TE::WHITE."Vous avez séléctionné les particules ".TE::RED."rouge");
                        }
                    }else{
                        $pl->sendMessage("§0- §6Vous n'avez pas la permission d'effectué ceci §0-");
                    }
                    break;
                case 2:
                    if($pl->hasPermission("core.green")){
                        if(!in_array($pl->getName(), $this->plugin->green)){
                            $this->plugin->green[] = $pl->getName();
                            $pl->sendMessage($this->plugin->prefix.TE::WHITE."Vous avez séléctionné les particules ".TE::GREEN."verte");
                            if(in_array($pl->getName(), $this->plugin->blue)){
                                unset($this->plugin->blue[array_search($pl->getName(), $this->plugin->blue)]);
                            }elseif (in_array($pl->getName(), $this->plugin->red)){
                                unset($this->plugin->red[array_search($pl->getName(), $this->plugin->red)]);
                            }
                        }else{
                            unset($this->plugin->green[array_search($pl->getName(), $this->plugin->green)]);
                            $pl->sendMessage($this->plugin->prefix.TE::WHITE."Vous avez séléctionné les particules ".TE::GREEN."verte");
                        }
                    }else{
                        $pl->sendMessage("§0- §6Vous n'avez pas la permission d'effectué ceci §0-");
                    }
                    break;
                case 3:
                    break;
            }
        });
        $form->setTitle("§0-§6 Particules §0-");
        $form->addButton("§b Bleu");
        $form->addButton("§4Rouge");
        $form->addButton("§aVert");
        $form->addButton("§0Sortir");

        $form->sendToPlayer($pl);
        return $form;
    }
    public function eventt($pl){
        $form = $this->createSimpleForm(function (Player $pl, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->plugin->getServer()->dispatchCommand($pl, $this->plugin->getConfig()->get("command1"));
                    break;
                case 1:
                    $this->plugin->getServer()->dispatchCommand($pl, $this->plugin->getConfig()->get("command2"));
                    break;
                case 2:
                    return true;
            }
        });
        $form->setTitle("Event");
        $form->addButton("Create Event",0,"textures/ui/village_hero_effect.png");
        $form->addButton("Join Event",0,"textures/ui/FriendsDiversity.png");
        $form->addButton("Close",0,"textures/ui/realms_red_x.png");
        $form->sendToPlayer($pl);
        return $form;
    }
}