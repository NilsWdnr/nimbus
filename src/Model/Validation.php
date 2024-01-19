<?php

namespace nimbus\Model;

class Validation {
    private $rules;

    public function set_rules (array $rules): void
    {
        $this->rules = $rules;
    }

    public function validate (): bool
    {
        
    }
}

