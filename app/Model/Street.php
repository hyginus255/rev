<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '_streets';
    protected $primaryKey = 'idstreet';
}
