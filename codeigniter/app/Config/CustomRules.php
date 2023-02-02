<?php

namespace Config;

class CustomRules
{
    public function betweenDeliveryDate($str): bool
    {
        if (strtoTime($str) > strtoTime(date('Y-m-d').'+ 3 days') && strtoTime($str) < strtoTime(date('Y-m-d').'+ 100 days'))
            return TRUE;
        return FALSE;
    }
}