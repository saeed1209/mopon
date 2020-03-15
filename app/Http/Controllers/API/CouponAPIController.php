<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCouponAPIRequest;
use App\Http\Requests\API\UpdateCouponAPIRequest;
use App\Models\Brand;
use App\Models\Coupon;
use App\Repositories\BrandRepository;
use App\Repositories\CouponRepository;
use App\Transformers\CouponCollectionTransformer;
use App\Transformers\CouponTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CouponController
 * @package App\Http\Controllers\API
 */

class CouponAPIController extends AppBaseController
{
    /** @var  CouponRepository */
    private $couponRepository;
    private $brandRepository;

    public function __construct(CouponRepository $couponRepo,
                                BrandRepository $brandRepo)
    {
        $this->middleware('is_admin')->except(['index', 'show']);
        $this->couponRepository = $couponRepo;
        $this->brandRepository = $brandRepo;
    }

    /**
     * Display a listing of the Coupon.
     * GET|HEAD /coupons
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $coupons = $this->couponRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
        $response = json_decode(fractal()->collection($coupons)
            ->transformWith(new CouponCollectionTransformer)
            ->toJson())->data;

        return $this->sendResponse($response, 'Coupons retrieved successfully');
    }

    /**
     * Store a newly created Coupon in storage.
     * POST /coupons
     *
     * @param CreateCouponAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponAPIRequest $request)
    {
        $input = $request->all();

        $brand = $this->brandRepository->find($input['brand_id']);
        if(!$brand)
            abort(404, 'Brand id not found');

        $coupon = $this->couponRepository->create($input);

        return $this->sendResponse($coupon->toArray(), 'Coupon saved successfully');
    }

    /**
     * Display the specified Coupon.
     * GET|HEAD /coupons/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Coupon $coupon */
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            return $this->sendError('Coupon not found');
        }

        $response = json_decode(fractal()->item($coupon)
            ->transformWith(new CouponTransformer)
            ->toJson())->data;

        return $this->sendResponse($response, 'Coupon retrieved successfully');
    }

    /**
     * Update the specified Coupon in storage.
     * PUT/PATCH /coupons/{id}
     *
     * @param int $id
     * @param UpdateCouponAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCouponAPIRequest $request)
    {
        $input = $request->all();

        $brand = $this->brandRepository->find($input['brand_id']);
        if(!$brand)
            abort(404, 'Brand id not found');

        /** @var Coupon $coupon */
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            return $this->sendError('Coupon not found');
        }

        $coupon = $this->couponRepository->update($input, $id);

        return $this->sendResponse($coupon->toArray(), 'Coupon updated successfully');
    }

    /**
     * Remove the specified Coupon from storage.
     * DELETE /coupons/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Coupon $coupon */
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            return $this->sendError('Coupon not found');
        }

        $coupon->delete();

        return $this->sendSuccess('Coupon deleted successfully');
    }
}
