<?php

namespace Osarze\Account\Traits;

use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

trait JsonApiResponse
{
    /**
     * @param array|null $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function successResponse(
        array $data = null,
        $message = "Success",
        $statusCode = Response::HTTP_OK
    ): JsonResponse {
        $responseData = [
            'success' => true,
            'message' => $message,
        ];

        if (!is_null($data)) {
            $responseData['data'] = $data;
        }

        return response()->json($responseData, $statusCode);
    }

    public function resourceSuccessResponse(
        JsonResource $data,
        string $message = "Success"
    ): JsonResponse {
        $data = $data->response()->getData(true);

        $responseData = [
            'success' => true,
            'message' => $message,
            'data' => $data['data'],
        ];

        if (Arr::has($data, 'meta')) {
            $responseData['meta'] = $data['meta'];
        }

        if (Arr::has($data, 'links')) {
            $responseData['links'] = $data['links'];
        }

        return response()->json($responseData, Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function errorResponse(
        array $errorData = null,
        $message = "Fail",
        $statusCode = Response::HTTP_BAD_REQUEST
    ): JsonResponse {
        $responseData = [
            'success' => false,
            'message' => $message,
        ];

        if (!is_null($errorData)) {
            $responseData['errors'] = $errorData;
        }

        return response()->json($responseData, $statusCode);
    }

    public function serverErrorResponse(
        \Throwable $e
    ) {
        $responseData = [
            'success' => false,
            'message' => $e->getMessage(),
        ];

        if (config('app.env') != 'production') {
            $responseData['error'] = $e->getTrace();
        }

        return response()->json($responseData, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
