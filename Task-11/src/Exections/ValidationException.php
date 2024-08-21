<?php

namespace App\Exceptions;

class ValidationException extends \Exception
{
    public static function checkErrors(array $data, array $rules)
    {
        foreach ($rules as $field => $ruleSet) {
            $value = $data[$field] ?? null;

            foreach ($ruleSet as $rule) {
                switch ($rule) {
                    case 'required':
                        if (is_null($value) || $value === '') {
                            throw new ValidationException("The {$field} field is required.");
                        }

                        break;
                    case 'string':
                        if (!is_string($value)) {
                            throw new ValidationException("The {$field} field must be a string.");
                        }

                        break;
                    case 'int':
                        if (!is_int($value) && !ctype_digit($value)) {
                            throw new ValidationException("The {$field} field must be an integer.");
                        }

                        break;
                    default:
                        throw new ValidationException("The validation rule '{$rule}' is not supported.");
                }
            }
        }
    }
}