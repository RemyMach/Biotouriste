<?php

namespace App\Http\Controllers\API\NoApiClass;

use App\Http\Controllers\Controller;

class UsefullController extends Controller
{

    public function keepKeysThatWeNeed(array $data,array $keys)
    {
        $validData = [];
        foreach($keys as $key => $value)
        {
            if(array_key_exists($value,$data))
            {
                $validData[$value] = $data[$value];
            }
        }
        return $validData;
    }

}