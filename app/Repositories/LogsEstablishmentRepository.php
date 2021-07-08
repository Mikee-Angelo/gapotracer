<?php

namespace App\Repositories;

use App\Models\LogsEstablishment;
use App\Repositories\BaseRepository;

/**
 * Class LogsEstablishmentRepository
 * @package App\Repositories
 * @version July 7, 2021, 5:07 pm UTC
*/

class LogsEstablishmentRepository extends BaseRepository
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
        return LogsEstablishment::class;
    }
}
