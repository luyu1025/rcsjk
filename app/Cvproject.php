<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cvproject extends Model
{
    //
    protected function getDateFormat()
    {
        return time();
    }
}
