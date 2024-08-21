<?php

namespace App\Libraries;

use App\Exceptions\ValidationException;

class Validation 
{
    public static function sanitizeString(string $input): string
    {
        return $input;
    }

    public static function validateInt($input): ?int
    {
        if (filter_var($input, FILTER_VALIDATE_INT) !== false) {
            return $input;
        }
        
        return null;
    }

    public static function sanitizeForSQL(\mysqli $connection, string $input): string
    {
        return $connection->real_escape_string($input);
    }

    public static function validate(array $data, array $rules): array
    {
        $validatedData = [];
        
        foreach ($rules as $key => $rule) {
            if (isset($data[$key])) {
                switch ($rule) {
                    case 'string':
                        $validatedData[$key] = self::sanitizeString($data[$key]);
                        
                        break;

                    case 'int':
                        $validatedData[$key] = self::validateInt($data[$key]);
                        
                        break;
                    default:
                        throw new ValidationException("Validation rule '{$rule}' is not supported.");
                }
            }
        }
        
        return $validatedData;
    }
}