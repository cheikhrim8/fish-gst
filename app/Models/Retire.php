<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Retire extends Model
{
    use SoftDeletes;
    protected $table = 'retires';

    protected $casts = [
		'nb_carton' => 'float',
		'poisson_id' => 'int'
	];
    protected $fillable = [
        'nb_carton',
        'poisson_id',
    ];

    public function poisson()
    {
        return $this->belongsTo(Poisson::class,"poisson_id");
    }

    public function client()
    {
        return $this->belongsTo(Client::class,"client_id");
    }

    public function get_nb_jours(){
        $mytime =$this->created_at->diff($this->traitement_carton->created_at); 
        return $mytime->format('%a');
    }

}