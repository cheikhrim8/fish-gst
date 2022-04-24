<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Chario extends Model
{
    use SoftDeletes;
    protected $table = 'charios';

   protected $casts = [
        'poisson_id' => 'int',
        'nb_plat' => 'int',
        'rest_plat' => 'int',
    ];

    protected $fillable = [
        'poisson_id',
        'nb_plat',
        'rest_plat'
    ];

    public function rest_plat_disponible(){
        return $this->nb_plat - $this->chario_reception_poissons->sum('nb_table');
    }

     public function poissons(){
        return $this->belongsToMany(Poisson::class, 'charios_poissons')
            ->withPivot('id', 'nb_plat', 'deleted_at')
            ->withTimestamps();
    }

     public function tineles(){
        return $this->belongsToMany(Tinele::class, 'charios_tineles')
            ->withPivot('id','etat_poisson','created_at')
            ->withTimestamps();
    }
     public function chario_reception_poissons(){
        return $this->hasMany(CharioReceptionPoisson::class,'chario_id');
    }
     public function charios_tineles()
    {
       return CharioTinele::where('chario_id',$this->id)->first();
        //return $this->belongsToMany(CharioTinele::class);
    }
    public function affecter_poisson($nb_plat){
        if( $this->rest_plat > 0 ){
            if($this->rest_plat >= $nb_plat){
                $this->rest_plat = $this->rest_plat - $nb_plat;
                $this->save();
                return   0;
            }
            else{
                $nb_rest = $nb_plat - $this->rest_plat;  
                $this->rest_plat = 0;
                $this->save();
                return $nb_rest;
            }   
        }
        else{
            return -1;
        }
    }

}


