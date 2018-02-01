<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    //
    protected function getDateFormat()
    {
        return time();
    }
}
