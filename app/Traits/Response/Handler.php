<?php

namespace App\Traits\Response;

use App\Models\User;

trait Handler
{
    public function response($data = null, bool $status = true, ?string $message = 'success', ?int $code = 200)
    {
        if ($status === true) {
            $response = [
                'code' => $code,
                'success' => $status,
                'message' => $message,
                'data' => $data
            ];

            if (getType($data) == "object" && $data->collection) {
                $response['data'] = $data->resolve()[0];
                $response['paginate'] = $data->resolve()[1];
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
