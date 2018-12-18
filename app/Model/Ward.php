<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wards';
    protected $primaryKey = 'ward_id';
}
