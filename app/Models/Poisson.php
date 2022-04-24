<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Poisson extends Model
{
    use SoftDeletes;

   protected $casts = [
        'libelle' => 'string',
    ];
    
    

    public function poissons_receptions(){
        return $this->hasMany(PoissonsReception::class, 'reception_id');
    }
    public function getNbplat($reception){
        $poisson_recep = PoissonsReception::where(['reception_id'=>$reception,'poisson_id'=>$this->id])->first();
        if($poisson_recep){
           return $nbt = CharioReceptionPoisson::where('poissons_reception_id',$poisson_recep->id)->sum('nb_table');
        }
        else return null;
    }

    public function get_sum_stock($receptions){
         $recep = Reception::find($receptions[0]);

         return PoissonsReception::whereIn('reception_id',$receptions)->where('poisson_id' , $this->id)->sum('nb_carton') -
         Retire::where(['client_id' => $recep->client_id , 'poisson_id'=> $this->id])->sum('nb_carton') ;
    
    }
    public function get_sum_stock_global(){

         return PoissonsReception::whereIn('reception_id',Reception::whereIn('etat',[4,5])->pluck('id'))->where('poisson_id' , $this->id)->sum('nb_carton') - Retire::where('poisson_id', $this->id)->sum('nb_carton');
    }

    public function get_stock_client_global($client_id){
         return PoissonsReception::whereIn('reception_id',Client::find($client_id)->receptions->whereIn('etat',[4,5])->pluck('id'))->where('poisson_id' , $this->id)->sum('nb_carton') - Retire::where(['poisson_id'=> $this->id , 'client_id'=>$client_id])->sum('nb_carton');
    }
    
}


