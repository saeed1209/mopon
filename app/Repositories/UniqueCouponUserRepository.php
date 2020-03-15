<?php

namespace App\Repositories;

use App\Models\UniqueCouponUser;
use App\Repositories\BaseRepository;

/**
 * Class UniqueCouponUserRepository
 * @package App\Repositories
 * @version March 11, 2020, 3:58 pm UTC
*/

class UniqueCouponUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'coupon_id',
        'user',
        'coupon_code'
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
        return UniqueCouponUser::class;
    }
}
