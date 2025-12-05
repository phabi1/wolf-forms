<?php

namespace Wolf\Forms\Form;

class FormResult
{
    private $valid;
    private $errors = [];

    public function __construct(bool $valid, array $errors = [])
    {
        $this->valid = $valid;
        $this->errors = $errors;
    }

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function getMessages(): array
    {
        return $this->errors;
    }
}
