<?php

namespace App\Http\Controllers\API\NoApiClass;

use App\Http\Controllers\Controller;

class UsefullController extends Controller
{

    public function keepKeysThatWeNeed(array $requestArray,array $validAttributes)
    {
        $validData = [];
        foreach($validAttributes as $key => $value)
        {
            if(array_key_exists($value,$requestArray))
            {
                $validData[$value] = $requestArray[$value];
            }
        }
        return $validData;
    }
}