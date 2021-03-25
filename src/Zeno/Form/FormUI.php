<?php

namespace Zeno\Form;

use Corepractice\Form\{ModalForm,Form,CustomForm,SimpleForm};

trait FormUI {



    /**
     * @deprecated
     *
     * @param callable $function
     * @return CustomForm
     */
    public function createCustomForm(callable $function = null) : CustomForm {
        return new CustomForm($function);
    }

    /**
     * @deprecated
     *
     * @param callable|null $function
     * @return SimpleForm
     */
    public function createSimpleForm(callable $function = null) : SimpleForm {
        return new SimpleForm($function);
    }

    /**
     * @deprecated
     *
     * @param callable|null $function
     * @return ModalForm
     */
    public function createModalForm(callable $function = null) : ModalForm {
        return new ModalForm($function);
    }
}
