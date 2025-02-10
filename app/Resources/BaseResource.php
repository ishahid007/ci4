<?php

namespace App\Resources;

abstract class BaseResource
{
    /**
     * Transform the data
     *
     * @param array $data <string, mixed>
     *
     * @return array <string, mixed>
     */
    abstract public static function toArray(array $data): array;

    /**
     * Transform the data collection
     *
     * @return array $data
     *
     * @checks if the data is multidimensional array
     */
    public static function collection(array $data): array
    {
        // If it's empty array, return it
        if (empty($data)) {
            return [];
        }
        // If it's single array, return it without looping
        if (count($data) === count($data, COUNT_RECURSIVE)) {
            return static::toArray($data);
        }

        // If it's multidimensional array, loop through it
        return array_map(static fn ($item) => static::toArray($item), $data);
    }
}
