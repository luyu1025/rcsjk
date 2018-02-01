<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected function getDateFormat()
    {
        return time();
    }
}
