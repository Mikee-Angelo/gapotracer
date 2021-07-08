<?php

namespace App\Repositories;

use App\Models\LogsCivilian;
use App\Repositories\BaseRepository;

/**
 * Class LogsCivilianRepository
 * @package App\Repositories
 * @version July 7, 2021, 11:46 am UTC
*/

class LogsCivilianRepository extends BaseRepository
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
        return LogsCivilian::class;
    }
}
