<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\TermResource;
use App\Models\Term;
use Exception;

class TermService
{
    public function getAllTerms(): DataStatus
    {
        try {
            $terms = Term::all();
            return new DataSuccess(
                data: TermResource::collection($terms),
                statusCode: 200,
                message: 'Terms retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Failed to retrieve terms: ' . $e->getMessage()
            );
        }
    }

    public function getTermById($id): DataStatus
    {
        try {
            $term = Term::findOrFail($id);
            return new DataSuccess(
                data: new TermResource($term),
                statusCode: 200,
                message: 'Term retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 404,
                message: 'Term not found: ' . $e->getMessage()
            );
        }
    }

    public function createTerm(array $data): DataStatus
    {
        try {
            $term = Term::create($data);
            return new DataSuccess(
                data: new TermResource($term),
                statusCode: 201,
                message: 'Term created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Term creation failed: ' . $e->getMessage()
            );
        }
    }

    public function updateTerm($id, array $data): DataStatus
    {
        try {
            $term = Term::findOrFail($id);
            $term->update($data);
            return new DataSuccess(
                data: new TermResource($term),
                statusCode: 200,
                message: 'Term updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Term update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteTerm($id): DataStatus
    {
        try {
            $term = Term::findOrFail($id);
            $term->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Term deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Term deletion failed: ' . $e->getMessage()
            );
        }
    }
}

