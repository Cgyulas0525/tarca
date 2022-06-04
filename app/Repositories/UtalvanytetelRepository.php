<?php

namespace App\Repositories;

use App\Models\Utalvanytetel;
use App\Repositories\BaseRepository;

/**
 * Class UtalvanytetelRepository
 * @package App\Repositories
 * @version June 2, 2022, 12:53 pm UTC
*/

class UtalvanytetelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'utalvany_id',
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
        return Utalvanytetel::class;
    }
}
