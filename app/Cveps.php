<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cveps extends Model
{
    //
    protected function getDateFormat()
    {
        return time();
    }
}
