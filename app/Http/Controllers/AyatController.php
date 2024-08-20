<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ayat\AyatRequest;
use App\Http\Resources\AyatResource;
use App\Services\AyatService;

class AyatController extends Controller
{
    protected AyatService $ayatService;

    public function __construct(AyatService $ayatService)
    {
        $this->ayatService = $ayatService;
    }

    public function index()
    {
        $ayats = $this->ayatService->getAllAyats();
        return AyatResource::collection($ayats);
    }

    public function store(AyatRequest $request)
    {
        return $this->ayatService->createAyat($request->validated())->response();
    }

    public function show($id)
    {
        $ayat = $this->ayatService->getAyatById($id);
        return new AyatResource($ayat);
    }

    public function update(AyatRequest $request, $id)
    {
        return $this->ayatService->updateAyat($id, $request->validated())->response();
    }

    public function destroy($id)
    {
        return $this->ayatService->deleteAyat($id)->response();
    }
}

