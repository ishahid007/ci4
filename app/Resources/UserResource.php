<?php

namespace App\Resources;

class UserResource extends BaseResource
{
    /**
     * Convert data to array
     *
     * @param array $data <string, mixed>
     *
     * @return array <string, mixed>
     */
    public static function toArray(array $data): array
    {
        return [
            'id'         => $data['id'],
            'username'   => $data['username'],
            'status'     => $data['status'],
            'active'     => $data['active'],
            'created_at' => $data['created_at'],
        ];
    }
}
