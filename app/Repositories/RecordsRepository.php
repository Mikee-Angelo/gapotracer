<?php

namespace App\Repositories;

use App\Models\Records;
use App\Repositories\BaseRepository;

/**
 * Class RecordsRepository
 * @package App\Repositories
 * @version July 24, 2021, 8:28 pm UTC
*/

class RecordsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'status',
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
        return Records::class;
    }
}
