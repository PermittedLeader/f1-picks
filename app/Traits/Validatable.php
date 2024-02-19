<?php

namespace App\Traits;

use App\Exceptions\NoValidationRulesDefinedForModelException;

trait Validatable
{
    /**
     * Define rules for validation.
     *
     * If different rules are required for create/update,
     * set createRules and updateRules respectively, and
     * leave this function inherited from the trait.
     */
    public function rules(): array
    {
        if (blank($this->createRules()) && blank($this->updateRules())) {
            throw new NoValidationRulesDefinedForModelException();
        }
        if (! is_null($this->getKey())) {
            return blank($this->updateRules()) ? $this->createRules() : $this->updateRules();
        } else {
            return $this->createRules();
        }
    }

    /**
     * Validation rules to be applied to create.
     * Define this function for rules to be applied
     * for model creation.
     *
     * If there are no differences between update
     * and create, simply define rules() instead.
     */
    protected function createRules(): array
    {
        return [];
    }

    /**
     * Validation rules to be applied to updates
     * Define this function for rules to be applied
     * for updates.
     *
     * If there are no differences between update
     * and create, simply define rules() instead.
     */
    protected function updateRules(): array
    {
        return [];
    }
}
