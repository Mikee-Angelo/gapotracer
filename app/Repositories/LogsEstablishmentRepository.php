<?php

namespace App\Repositories;

use App\Models\LogsEstablishment;
use App\Repositories\BaseRepository;

/**
 * Class LogsEstablishmentRepository
 * @package App\Repositories
 * @version July 8, 2021, 10:26 am UTC
*/

class LogsEstablishmentRepository extends BaseRepository
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
        return LogsEstablishment::class;
    }
}
