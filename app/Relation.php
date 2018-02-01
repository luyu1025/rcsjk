<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    //
    protected function getDateFormat()
    {
        return time();
    }
}
