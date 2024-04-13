<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
     /* -------------------------------------------------------------------------- */
    /*                              SUCCESS RESPONSE                              */
    /* -------------------------------------------------------------------------- */

    /**
     * Send OK Response with Code 200
     *
     * @param string $message
     * @param array  $data
     *
     * @return JsonResponse
     */
    public function sendOkResponse(
        string $message,
        array $data = []
    ): JsonResponse {
        return response()->json([
            'message' => $message,
            'data'    => $data,
        ], Response::HTTP_OK);
    }

    /**
     * Send Entity Successfully Created with Code 201
     *
     * @return JsonResponse
     */
    public function sendCreatedResponse(
        string $message = '',
        array $data = []
    ): JsonResponse {
        return response()->json([
            'message' => $message ?? 'Record created',
            'data'    => $data,
        ], Response::HTTP_CREATED);
    }

    /* -------------------------------------------------------------------------- */
    /*                           ERROR HANDLING RESPONSE                          */
    /* -------------------------------------------------------------------------- */

    /**
     * Send Unauthorized Response with Code 401
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function sendUnauthorizedResponse(string $message): JsonResponse
    {
        return response()->json([
            'message' => 'Unauthorized',
            'data'    => [],
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Send Validation Error with Code 400
     *
     * @param MessageBag $data
     *
     * @return JsonResponse
     */
    public function sendValidationErrorResponse(MessageBag $data): JsonResponse
    {
        return response()->json([
            'message' => 'Error Validation',
            'data'    => $data,
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Send Unprocessable Entity Error with Code 422
     *
     * @return JsonResponse
     */
    public function sendUnprocessableEntityResponse(
        string $message = '',
        array $data = []
    ): JsonResponse {
        return response()->json([
            'message' => $message ?? 'Unprocessable Entity',
            'data'    => $data,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Send Not Found Error with Code 404
     *
     * @return JsonResponse
     */
    public function sendNotFoundResponse(string $message = ''): JsonResponse
    {
        return response()->json([
            'message' => $message ?? 'Record Not Found',
            'data'    => [],
        ], Response::HTTP_NOT_FOUND);
    }


    /**
     * Send Internal Server Error with Code 500
     *
     * @return JsonResponse
     */
    public function sendInternalServerErrorResponse(): JsonResponse
    {
        return response()->json([
            'message' => 'Internal Server Error',
            'data'    => [],
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Send Unauthorized Response with Code 401
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function sendBadRequestResponse(
        string $message,
        array $request
    ): JsonResponse {
        return response()->json([
            'message' => $message ?? 'Bad Request',
            'request' => $request,
        ], Response::HTTP_UNAUTHORIZED);
    }
}
