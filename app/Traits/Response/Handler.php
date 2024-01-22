<?php

namespace App\Traits\Response;

use App\Models\User;

trait Handler
{
    public function response($data = null, bool $status = true, ?string $message = '', ?int $code = 200)
    {
        if ($status === true) {
            if (getType($data) == "object" && get_class($data) === "App\Http\Resources\Api\ResponsePagination") {
                $response = [
                    'code' => $code,
                    'success' => $status,
                    'message' => $message,
                    'data' => $data->resolve()[0],
                    'paginate' => $data->resolve()[1],
                ];
            } else {
                $response = [
                    'code' => $code,
                    'success' => $status,
                    'message' => $message,
                    'data' => $data,
                ];
            }
        } else {
            $response = [
                'code' => $code,
                'success' => $status,
                'message' => $message,
                'errors' => $data,
            ];
        }

        return response()->json($response);
    }
}
