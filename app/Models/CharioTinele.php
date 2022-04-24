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
class CharioTinele extends Model
{
	use SoftDeletes;
	protected $table = 'charios_tineles';

	protected $casts = [
		'tinele_id' => 'int',
		'chario_id' => 'int',
	];
	protected $fillable = [
		'tinele_id',
		'chario_id',
	];
	public function chario()
	{
		return $this->belongsTo(Chario::class);
	}
	public function tinele()
	{
		return $this->belongsTo(Tinele::class);
	}
}
