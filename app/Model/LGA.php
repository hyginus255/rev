<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LGA extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'local_goverment_area';
    protected $primaryKey = 'id_lga';
}
