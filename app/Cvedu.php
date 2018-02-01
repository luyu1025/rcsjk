<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cvedu extends Model
{
    //
    protected function getDateFormat()
    {
        return time();
    }
}
