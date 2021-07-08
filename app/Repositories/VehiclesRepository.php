<?php

namespace App\Repositories;

use App\Models\Vehicles;
use App\Repositories\BaseRepository;

/**
 * Class VehiclesRepository
 * @package App\Repositories
 * @version July 6, 2021, 9:07 pm UTC
*/

class VehiclesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'body_no',
        'plate_no',
        'contact_no',
        'address',
        'type'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Vehicles::class;
    }
}
