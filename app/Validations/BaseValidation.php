<?php

namespace App\Validations;

abstract class BaseValidation
{
    /**
     * Validation errors
     *
     * @var array <int, string>
     */
    protected array $errors = [];

    /**
     * Define validation rules (to be implemented in child classes)
     *
     * @return array <string, string>x
     */
    abstract public function rules(): array;

    /**
     * Define custom messages (optional)
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Run validation and return result
     */
    public function validate(array $data): array|bool
    {
        $validation = service('validation');
        $validation->setRules($this->rules(), $this->messages());

        if (! $validation->run($data)) {
            $this->errors = $validation->getErrors();

            // Validation failed
            return false;
        }

        // Validation passed & return validated data
        return $validation->getValidated();
    }

    /**
     * Get validation errors
     *
     * @return array <int, string>
     */
    public function errors(): array
    {
        return $this->errors;
    }
}
