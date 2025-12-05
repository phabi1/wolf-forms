<?php

namespace Wolf\Forms\Form;

abstract class AbstractForm
{
    public abstract function getForm();

    public function validateForm($data)
    {
        return new FormResult(true);
    }

    public function submitForm($data)
    {
        // Default submission logic
        return true;
    }
}
