<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBrandAPIRequest;
use App\Http\Requests\API\UpdateBrandAPIRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BrandController
 * @package App\Http\Controllers\API
 */

class BrandAPIController extends AppBaseController
{
    /** @var  BrandRepository */
    private $brandRepository;
    private $categoryRepository;

    public function __construct(BrandRepository $brandRepo,
                                CategoryRepository $categoryRepo)
    {
        $this->brandRepository = $brandRepo;
        $this->categoryRepository = $categoryRepo;

    }

    /**
     * Display a listing of the Brand.
     * GET|HEAD /brands
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $brands = $this->brandRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($brands->toArray(), 'Brands retrieved successfully');
    }

    /**
     * Store a newly created Brand in storage.
     * POST /brands
     *
     * @param CreateBrandAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBrandAPIRequest $request)
    {
        $input = $request->all();

        if(!$this->categoryRepository->find($input['category_id']))
           abort(404, 'Category id not found');

        $brand = $this->brandRepository->create($input);

        return $this->sendResponse($brand->toArray(), 'Brand saved successfully');
    }

    /**
     * Display the specified Brand.
     * GET|HEAD /brands/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Brand $brand */
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            return $this->sendError('Brand not found');
        }

        return $this->sendResponse($brand->toArray(), 'Brand retrieved successfully');
    }

    /**
     * Update the specified Brand in storage.
     * PUT/PATCH /brands/{id}
     *
     * @param int $id
     * @param UpdateBrandAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrandAPIRequest $request)
    {
        $input = $request->all();

        if(!$this->categoryRepository->find($input['category_id']))
            abort(404, 'Category id not found');

        /** @var Brand $brand */
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            return $this->sendError('Brand not found');
        }

        $brand = $this->brandRepository->update($input, $id);

        return $this->sendResponse($brand->toArray(), 'Brand updated successfully');
    }

    /**
     * Remove the specified Brand from storage.
     * DELETE /brands/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Brand $brand */
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            return $this->sendError('Brand not found');
        }

        $brand->delete();

        return $this->sendSuccess('Brand deleted successfully');
    }
}
