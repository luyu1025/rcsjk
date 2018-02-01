<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    protected function getDateFormat()
    {
        return time();
    }
}
