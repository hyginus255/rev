<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Buildings;

class Businesses extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'businesses';
    protected $primaryKey = 'buisiness_id';
    

    public function building()
    {
        return $this->hasOne('App\Model\Buildings');
    }
}
