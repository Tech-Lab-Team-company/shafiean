<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\QuraanResource;
use App\Models\Quraan;
use Exception;

class QuraanService
{
    public function createQuraan(array $data): DataStatus
    {
        try {
            $quraan = Quraan::create($data);

            return new DataSuccess(
                data: new QuraanResource($quraan),
                statusCode: 200,
                message: 'Quraan entry created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Quraan entry creation failed: ' . $e->getMessage()
            );
        }
    }

    public function updateQuraan($id, array $data): DataStatus
    {
        try {
            $quraan = Quraan::findOrFail($id);
            $quraan->update($data);

            return new DataSuccess(
                data: new QuraanResource($quraan),
                statusCode: 200,
                message: 'Quraan entry updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Quraan entry update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteQuraan($id): DataStatus
    {
        try {
            $quraan = Quraan::findOrFail($id);
            $quraan->delete();

            return new DataSuccess(
                statusCode: 200,
                message: 'Quraan entry deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Quraan entry deletion failed: ' . $e->getMessage()
            );
        }
    }

    public function getAllQuraans()
    {
        return Quraan::all();
    }

    public function getQuraanById($id)
    {
        return Quraan::findOrFail($id);
    }
}

