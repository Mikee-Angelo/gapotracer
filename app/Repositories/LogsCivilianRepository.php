<?php

namespace App\Repositories;

use App\Models\LogsCivilian;
use App\Repositories\BaseRepository;

/**
 * Class LogsCivilianRepository
 * @package App\Repositories
 * @version July 8, 2021, 6:23 am UTC
*/

class LogsCivilianRepository extends BaseRepository
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
        return LogsCivilian::class;
    }

}
