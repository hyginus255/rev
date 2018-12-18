<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '_business_categories';
    protected $primaryKey = 'id_lga';

}
