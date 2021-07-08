<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Vehicles",
 *      required={"name", "body_no", "plate_no", "contact_no", "address", "type"},
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="body_no",
 *          description="body_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="plate_no",
 *          description="plate_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="contact_no",
 *          description="contact_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          description="address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
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
class Vehicles extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'vehicles';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'body_no',
        'plate_no',
        'contact_no',
        'address',
        'type',
        'guid',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'body_no' => 'string',
        'plate_no' => 'string',
        'contact_no' => 'string',
        'address' => 'string',
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'body_no' => 'required',
        'plate_no' => 'required',
        'contact_no' => 'required',
        'address' => 'required',
        'type' => 'required'
    ];

    
}
