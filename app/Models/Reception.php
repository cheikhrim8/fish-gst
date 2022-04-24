<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reception extends Model
{
    use SoftDeletes;
    protected $table = 'receptions';

   protected $casts = [
        'client_id' => 'int',
        'total_poid'=>'float',
    ];

    protected $fillable = [
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,"client_id");
    }

     public function poissons()
    {
         return $this->belongsToMany(Poisson::class, 'poissons_receptions')
                    ->withPivot('id', 'poid','poid_reel','nb_carton', 'deleted_at')
                    ->withTimestamps();
    }
    public function poissons_receptions(){
        return $this->hasMany(PoissonsReception::class,'reception_id');
    }

}


