<?php

namespace App\Repositories;

use App\Models\Civilian;
use App\Repositories\BaseRepository;

/**
 * Class CivilianRepository
 * @package App\Repositories
 * @version July 6, 2021, 7:12 pm UTC
*/

class CivilianRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'phone',
        'age',
        'gender',
        'address',
        'guid',
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
        return Civilian::class;
    }
}
