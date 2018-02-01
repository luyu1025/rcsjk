<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    //
    protected function getDateFormat()
    {
        return time();
    }
}
