<?php

namespace Core;

use Exception;

class ValidationException extends Exception {
    private $validationErrors;

    public function __construct(array $errors) {
        parent::__construct('Validation failed');
        $this->validationErrors = $errors;
    }

    public function getValidationErrors(): array {
        return $this->validationErrors;
    }
}

class ValidateRequest {
    private $data;
    private $errors = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function validate(array $rules): void {
        foreach ($rules as $field => $ruleSet) {
            $rules = explode('|', $ruleSet);
            foreach ($rules as $rule) {
                $this->applyRule($field, $rule);
            }
        }

        if (!empty($this->errors)) {
            throw new ValidationException($this->errors);
        }
    }

    private function applyRule(string $field, string $rule): void {
        $value = $this->data[$field] ?? null;

        if ($rule === 'required' && empty($value)) {
            $this->addError($field, "$field is required.");
        }

        if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "$field must be a valid email.");
        }

        if (str_starts_with($rule, 'min:')) {
            $min = (int)explode(':', $rule)[1];
            if (strlen($value) < $min) {
                $this->addError($field, "$field must be at least $min characters.");
            }
        }

        if (str_starts_with($rule, 'max:')) {
            $max = (int)explode(':', $rule)[1];
            if (strlen($value) > $max) {
                $this->addError($field, "$field must be no more than $max characters.");
            }
        }
    }

    private function addError(string $field, string $message): void {
        $this->errors[$field][] = $message;
    }
}
