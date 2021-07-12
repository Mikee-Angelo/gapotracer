<?php

namespace App\Repositories;

use App\Models\LogsVehicle;
use App\Repositories\BaseRepository;

/**
 * Class LogsVehicleRepository
 * @package App\Repositories
 * @version July 8, 2021, 11:55 am UTC
*/

class LogsVehicleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
