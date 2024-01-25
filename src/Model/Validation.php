<?php

namespace nimbus\Model;

use Exception;

class Validation
{
    private $rules;
    private $input_data;
    private $error_messages;

    public function set_rules(array $rules): void
    {
        $this->rules = $rules;
    }

    public function validate(array $data): bool
    {
        $this->input_data = $data;

        foreach ($this->rules as $field => $field_rules) {
            $field_rules = explode('|', $field_rules);

            if (!$this->validate_field($field, $field_rules)) {
                return false;
            };
        }

        return true;
    }

    private function validate_field(string $field, array $rules): bool
    {
        foreach ($rules as $rule) {
            if(!method_exists(Validation::class,$rule)){
                continue;
            }

            try{
                $this->{$rule}();
            } catch (Exception $e){
                $message = $e->getMessage();
                $this->error_messages[$field] = $message;
                return false;
            }
        }

        return true;
    }

    public function get_messages(): array
    {
        if(!empty($this->error_messages)){
            return $this->error_messages;
        }

        return [];
    }

    private function required(string $field): void
    {
        if(!isset($this->input_data[$field]) || empty($this->input_data[$field])){
            throw new Exception('Please fill out this field');
        }
    }

    private function email(string $field): void
    {
        if(!filter_var($this->input_data[$field], FILTER_VALIDATE_EMAIL))
        {
            throw new Exception('Please use a valid email adress');
        }
    }
}
