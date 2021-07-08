<?php

namespace App\Repositories;

use App\Models\Establishment;
use App\Repositories\BaseRepository;

/**
 * Class EstablishmentRepository
 * @package App\Repositories
 * @version July 6, 2021, 8:43 pm UTC
*/

class EstablishmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'staff_name',
        'address',
        'contact_no',
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
        return Establishment::class;
    }
}
