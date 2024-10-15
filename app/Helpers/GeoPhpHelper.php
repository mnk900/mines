<?php

namespace App\Helpers;

class GeoPHPHelper
{
    public static function loadGeoPHP()
    {
        // Include the geoPHP library manually
        require_once base_path('vendor/phayes/geophp/geoPHP.inc');
    }
}
