<?php

namespace App\Exceptions;

use Exception;

class NoValidationRulesDefinedForModelException extends Exception
{
    public function __construct()
    {
        parent::__construct('You must define some validation rules on your model. Either overwrite the rules function, or define an array of rules for creating and updating.');
    }
}
