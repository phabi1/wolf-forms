<?php

namespace Wolf\Forms\Form;

class FormState
{
    private $values = [];

    private $errors = [];

    private $submitted = false;

    public function getValues(): array
    {
        return $this->values;
    }

    public function setValues(array $values): void
    {
        $this->values = $values;
    }

    public function isValid(): bool
    {
        return count($this->errors) === 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getError(string $field): ?string
    {
        return $this->errors[$field] ?? null;
    }

    public function setError(string $field, string $message): void
    {
        $this->errors[$field] = $message;
    }

    public function clearErrors(): void
    {
        $this->errors = [];
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function hasError(string $field): bool
    {
        return isset($this->errors[$field]);
    }

    public function isSubmitted(): bool
    {
        return $this->submitted;
    }

    public function setSubmitted(bool $submitted): void
    {
        $this->submitted = $submitted;
    }
}
