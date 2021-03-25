<?php

namespace Zeno\Others;

use Zeno\Form\SimpleForm;
use Zeno\Others\Cosmetics;
use Zeno\Others\Mods;
use pocketmine\Player;

class Settings extends SimpleForm {

    public static function settings(Player $player){
        {
            $form = new SimpleForm
            (
                function (Player $pl , $data) {
                    if ($data == null) {
                        return true;
                    } else {
                        switch ($data) {
                            case 1:
                                Cosmetics::cosmetics($pl);
                                break;
                            case 2:
                                Mods::mods($pl);
                                break;
                            case 3:
                                break;

                        }
                    }
                });

            $form->setTitle("Settings");
            $form->addButton("Exit",0,"textures/ui/realms_red_x");
            $form->addButton("Cosmetics",0,"textures/ui/color_picker.png");
            $form->addButton("Mods",0,"textures/ui/debug_glyph_color.png");
            $player->sendForm($form);
        }
    }
}