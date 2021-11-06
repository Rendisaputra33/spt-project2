<?php

namespace App\Http\Utility;

class HppUtil
{
    public function matchHpp(string $hpp)
    {
        $match = preg_match('/Rp. /', $hpp);
        if ($match > 0) {
            return preg_replace('/Rp. /', '', $hpp);
        }
        return $hpp;
    }
}
