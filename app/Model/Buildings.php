<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Businesses;

class Buildings extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buildings';
    protected $primaryKey = 'building_id';

    public function business()
      {
        return $this->belongsTo(Businesses::class,'buisiness_id','building_id');
      }

}
