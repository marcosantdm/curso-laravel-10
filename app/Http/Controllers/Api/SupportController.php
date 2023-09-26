<?php

namespace App\Http\Controllers\Api;

use App\Adapters\ApiAdapter;
use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Http\Resources\SupportResource;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupportController extends Controller
{

    public function __construct(
        protected SupportService $service,
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $supports = Support::paginate();

        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('totalPerPage', 1),
            filter: $request->filter
        );

        return ApiAdapter::toJson($supports);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSupportRequest $request)
    {
       $support = $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        /**
         ** Ao passar um dado na função de uma API REST o LARAVEL automaticamente transforma o return em um json encode
         */
        return (new SupportResource($support))
                    ->response()
                    ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$support = $this->service->findOne($id)) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSupportRequest $request, string $id)
    {
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request, $id),
        );

        if (!$support) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$support = $this->service->findOne($id)) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        $this->service->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
