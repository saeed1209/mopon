<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;

/**
 * Class CouponRepository
 * @package App\Repositories
 * @version March 11, 2020, 2:51 pm UTC
*/

class CouponRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'link',
        'amount',
        'brand_id',
        'coupon_code',
        'type',
        'expire_at'
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
        return Coupon::class;
    }

    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit)
                    ->where('expire_at', null)
                    ->orWhere('expire_at', '>', Carbon::now()->toDateTime());

        return $query->get($columns);
    }

    public function is_unique($id)
    {
        $coupon = $this->model->where('id', $id)
            ->where('type', Coupon::UNIQUE)
            ->first();
        return !is_null($coupon);
    }

    public function expire_empty_coupon($id)
    {
        self::find($id)->update([
            'expire_at' => now()
        ]);
    }
}
