<?php

namespace App\Repositories;

use App\Models\Utalvany;
use App\Repositories\BaseRepository;

/**
 * Class UtalvanyRepository
 * @package App\Repositories
 * @version June 2, 2022, 12:52 pm UTC
*/

class UtalvanyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sorszam',
        'osszeg'
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
        return Utalvany::class;
    }
}
