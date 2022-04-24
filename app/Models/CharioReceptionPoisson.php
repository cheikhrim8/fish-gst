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
class CharioReceptionPoisson extends Model
{
	use SoftDeletes;
	// protected $table = 'charios_tineles';

	protected $casts = [
		'chario_id' => 'int',
		'poissons_reception_id' => 'int',
	];
	protected $fillable = [
		'chario_id',
		'poissons_reception_id',
	];
	public function chario()
	{
		return $this->belongsTo(Chario::class);
	}
	public function poissons_reception()
	{
		return $this->belongsTo(PoissonsReception::class,'poissons_reception_id');
	}
}
