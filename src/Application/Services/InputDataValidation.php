<?php

namespace Application\Services;

class InputDataValidation
{
    public static function dataValidation($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}