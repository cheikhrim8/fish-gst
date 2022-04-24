<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PrPeGroupesQuestionsPrPeQuestion
 * 
 * @property int $id
 * @property int $pr_pe_groupes_question_id
 * @property int $pr_pe_question_id
 * @property int $ordre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property PrPeGroupesQuestion $pr_pe_groupes_question
 * @property PrPeQuestion $pr_pe_question
 *
 * @package App\Models
 */
class PoissonsReception extends Model
{
	use SoftDeletes;
	// protected $table = 'charios_tineles';

	protected $casts = [
		'poisson_id' => 'int',
		'reception_id' => 'int',
		'nb_carton' => 'float',
		'poid_reel' => 'float',
		'poid' => 'float',
	];
	protected $fillable = [
		'poisson_id',
		'reception_id',
	];
	public function poisson()
	{
		return $this->belongsTo(Poisson::class);
	}
	public function reception()
	{
		return $this->belongsTo(Reception::class);
	}

	public function chario_reception_poissons(){
	    return $this->hasMany(CharioReceptionPoisson::class,'poissons_reception_id');
	}	

	 public function retires(){
        return $this->hasMany(Retire::class,'poissons_reception_id');
    }
}
