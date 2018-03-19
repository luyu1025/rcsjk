<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected function getDateFormat()
    {
        return time();
    }
}
