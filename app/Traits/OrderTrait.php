<?php

namespace App\Traits;


trait OrderTrait
{
    /**
     * @param $validated
     * @return array
     */
    public function formatOrderData($validated): array
    {
        return [
            'customer_name' => $validated['company'],
            'item_name' => $validated['item'],
            'price' => $validated['price'],
            'status' => $validated['status'],
        ];
    }
}
