<?php

namespace Zeno\Form;

trait FormUI {

    /**
     * @param callable $function
     * @return CustomForm
     * @deprecated
     *
     */
    public function createCustomForm(callable $function): CustomForm {
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
