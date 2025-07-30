<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'customer_name',
        'item_name',
        'price',
        'status',
    ];
}
