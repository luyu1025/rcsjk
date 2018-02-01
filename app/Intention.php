<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intention extends Model
{
    //
    protected function getDateFormat()
    {
        return time();
    }
}
