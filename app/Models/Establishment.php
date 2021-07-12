<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Establishment",
 *      required={"name", "staff_name", "address", "contact_no", "type"},
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="staff_name",
 *          description="staff_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          description="address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="contact_no",
 *          description="contact_no",
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
class Establishment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'establishments';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'staff_name',
        'address',
        'contact_no',
        'type',
        'guid',
        'lat',
        'lng',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'staff_name' => 'string',
        'address' => 'string',
        'contact_no' => 'string',
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'staff_name' => 'required',
        'address' => 'required',
        'contact_no' => 'required',
        'type' => 'required',
        'lat' => 'required',
        'lng' => 'required'
    ];

    
}
