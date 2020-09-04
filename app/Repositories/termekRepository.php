<?php

namespace App\Repositories;

use App\Models\termek;
use App\Repositories\BaseRepository;

/**
 * Class termekRepository
 * @package App\Repositories
 * @version July 8, 2020, 7:24 am UTC
*/

class termekRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nev',
        'csoport',
        'cikkszam',
        'me',
        'megjegyzes'
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
        return termek::class;
    }
}
