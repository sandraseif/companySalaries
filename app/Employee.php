<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //table name
    protected $table = 'employees';

    //primary key 
    public $primarykey = 'id';

    //timestamps
    public $timestamps = true;

}
