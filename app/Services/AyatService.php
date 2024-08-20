<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\AyatResource;
use App\Models\Ayat;
use Exception;

class AyatService
{
    public function createAyat(array $data): DataStatus
    {
        try {
            $ayat = Ayat::create($data);

            return new DataSuccess(
                data: new AyatResource($ayat),
                statusCode: 200,
                message: 'Ayat created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Ayat creation failed: ' . $e->getMessage()
            );
        }
    }

    public function updateAyat($id, array $data): DataStatus
    {
        try {
            $ayat = Ayat::findOrFail($id);
            $ayat->update($data);

            return new DataSuccess(
                data: new AyatResource($ayat),
                statusCode: 200,
                message: 'Ayat updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Ayat update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteAyat($id): DataStatus
    {
        try {
            $ayat = Ayat::findOrFail($id);
            $ayat->delete();

            return new DataSuccess(
                statusCode: 200,
                message: 'Ayat deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Ayat deletion failed: ' . $e->getMessage()
            );
        }
    }

    public function getAllAyats()
    {
        $ayat = Ayat::all();
        return new DataSuccess(
            data: new AyatResource($ayat),
            statusCode: 200,
            message: 'Ayat retrieved successfully'
        );
    }

    public function getAyatById($id)
    {
        $ayat_by_id = Ayat::findOrFail($id);
        return new DataSuccess(
            data: new AyatResource($ayat_by_id),
            statusCode: 200,
            message: 'Ayat retrieved successfully'
        );
    }
}

