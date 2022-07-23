<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Records",
 *      required={"user_id"},
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="suspected_at",
 *          description="suspected_at",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="negative_at",
 *          description="negative_at",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="positive_at",
 *          description="positive_at",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="death_at",
 *          description="death_at",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Records extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'records';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'case_id',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'status' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
    ];

    
}
