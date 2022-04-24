<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Client extends Model
{
    use SoftDeletes;
    protected $table = 'clients';

   protected $casts = [
        'tel' => 'double',
        'nom' => 'string',
        'prenom' => 'string',
    ];

    protected $fillable = [
        'nom',
        'prenom',
        'tel'
    ];
    public function receptions()
    {
        return $this->hasMany(Reception::class,'client_id');
    }

}


