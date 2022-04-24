<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tinele extends Model
{
    use SoftDeletes;
    protected $table = 'tineles';

   protected $casts = [
        'nom' => 'string',
        'nb_charo_place' => 'int',
    ];

    protected $fillable = [
        'nom',
        'nb_charo_place',
    ];

    

    public function charios_tineles()
    {
        return $this->hasMany(CharioTinele::class,'tinele_id');
    }
    public function charios(){
        return $this->belongsToMany(Chario::class, 'charios_tineles')
            ->withPivot('id','deleted_at')
            ->withTimestamps();
    }
}


