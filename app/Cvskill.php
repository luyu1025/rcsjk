<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cvskill extends Model
{
    //
    protected function getDateFormat()
    {
        return time();
    }
}
