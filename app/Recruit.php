<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruit extends Model
{
    //
    protected function getDateFormat()
    {
        return time();
    }
}
