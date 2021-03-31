<?php
namespace Zeno\Others;

use Zeno\Core;
use pocketmine\Player;
use pocketmine\Server;
use Zeno\Form\SimpleForm;
use Zeno\Others\Gadgets;
use Zeno\Others\Cosmetics;
use Zeno\Form\FormUI;
use Zeno\Others\KitForms;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat as TE;

class Settings{

    use FormUI;

    public function settings(Player $player)
    {
        $form = $this->createSimpleForm(function (Player $pl, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    (new Mods) -> mods($pl);
                    break;
                case 1:
                    Cosmetics::cosmetics($pl);
                    break;
                case 2:
                    return true;
            }
        });

        $form -> setTitle("Settings");
        $form -> addButton("Mods", 0, "textures/ui/debug_glyph_color.png");
        $form -> addButton("Cosmetics", 0, "textures/ui/color_picker.png");
        $form -> addButton("Exit", 0, "textures/ui/realms_red_x");
        $player -> sendForm($form);
    }
}