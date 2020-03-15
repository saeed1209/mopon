<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class CouponTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($data)
    {
        return [
            'id' => $data->id,
            'title' => $data->title,
            'link' => $data->link,
            'amount' => $data->amount,
            'coupon_code' => $data->coupon_code,
            'unique_code' => $data->unique_coupons ?:'',
            'brand' => $data->brand,
            'type' => $data->type,
            'expire_at' => $data->expire_at
        ];
    }
}
