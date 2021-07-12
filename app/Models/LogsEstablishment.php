<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Civilian;
use App\Models\Establishment;
/**
 * @SWG\Definition(
 *      definition="LogsEstablishment",
 *      required={"user_id", "host_id"},
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="host_id",
 *          description="host_id",
 *          type="integer",
 *          format="int32"
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
class LogsEstablishment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'logs_establishments';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'host_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'string',
        'host_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'host_id' => 'required'
    ];
 
    public function civilian(){ 
        return $this->belongsTo(Civilian::class, 'user_id'); 
    }

    public function host(){ 
        return $this->belongsTo(Establishment::class, 'host_id'); 
    }
}
