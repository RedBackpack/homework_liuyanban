<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liuyanban extends Model
{
    protected $table = 'commit';

    protected function getDateFormat()
    {
        return time();
    }

}
