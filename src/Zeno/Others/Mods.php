<?php

namespace Zeno\Others;

use Zeno\Form\SimpleForm;
use pocketmine\Player;

class Mods extends SimpleForm {

    public static function mods(Player $player) {
        {
            $form = new SimpleForm
            (
                function (Player $pl, $data) {
                    if ($data == null) {
                        return true;
                    } else {
                        switch ($data) {
                            case 0:
                                break;
                        }
                    }
                });

            $form->setTitle("Mods");
            $form->addButton("Exit", 0, "textures/ui/realms_red_x.png");
            $player->sendForm($form);
        }
    }
}