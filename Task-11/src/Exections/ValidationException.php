<?php

namespace App\Exections;

class ValidationException
{
    /**
     * Sanitize string input to prevent XSS.
     * 
     * @param string $input
     * @return string
     */
    
    
    public static function sanitizeString(string $input): string
    {
        return $input;
    }

    /**
     * Validate integer input.
     * 
     * @param mixed $input
     * @return int|null
     */

    public static function validateInt($input): ?int
    {
        if (filter_var($input, FILTER_VALIDATE_INT) !== false) {
            return $input;
        }
        
        return null;
    }

    /**
     * Validate string input for SQL Injection protection.
     * 
     * @param \mysqli $connection
     * @param string $input
     * @return string
     */

    public static function sanitizeForSQL(\mysqli $connection, string $input): string
    {
        return $connection->real_escape_string($input);
    }

    /**
     * Validate and sanitize data array.
     * 
     * @param array $data
     * @param array $rules
     * @return array
     */
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
                        throw new \Exception("Validation rule '{$rule}' is not supported.");
                }
            }
        }
        
        return $validatedData;
    }
}