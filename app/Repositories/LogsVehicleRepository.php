<?php

namespace App\Repositories;

use App\Models\LogsVehicle;
use App\Repositories\BaseRepository;

/**
 * Class LogsVehicleRepository
 * @package App\Repositories
 * @version July 7, 2021, 5:31 pm UTC
*/

class LogsVehicleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'host_id'
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
        return LogsVehicle::class;
    }
}
