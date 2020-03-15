<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\BaseRepository;

/**
 * Class BrandRepository
 * @package App\Repositories
 * @version March 11, 2020, 2:00 pm UTC
*/

class BrandRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'categroy_id',
        'website'
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
        return Brand::class;
    }
}
