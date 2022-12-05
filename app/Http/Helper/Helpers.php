<?php

if (!function_exists('helper_to_array')) {
    /**
     * Create array of (Resource Collection)
     * @param $data
     * @return array|int
     */
    function helper_to_array($data): array|int
    {
        if (is_object($data)) {
            $data = json_decode($data->toJson(), true);
        }
        return $data;
    }
}
