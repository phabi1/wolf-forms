<?php

namespace Wolf\Forms\Form;

abstract class AbstractForm
{
    private $state;

    public function setState(FormState $state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function validateForm() {}

    public abstract function getForm();

    public abstract function submitForm();
}
