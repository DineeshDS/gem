<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list(): \Illuminate\Database\Eloquent\Collection
    {
        return Order::all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return Order::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return \Illuminate\Support\Collection
     */
    public function update(int $id, array $data)
    {
        $order = Order::find($id);
        if($order){
            $order->customer_name = $data['customer_name'];
            $order->item_name = $data['item_name'];
            $order->price = $data['price'];
            $order->status = $data['status'];
            $order->save();

            return $order;
        }
        return collect();
    }

    /**
     * @param int $id
     * @return \Illuminate\Support\Collection
     */
    public function delete(int $id)
    {
        $order = Order::find($id);
        if($order){
            return $order->delete();
        }
        return collect();
    }

    /**
     * @param int $id
     * @return \Illuminate\Support\Collection
     */
    public function show(int $id)
    {
        $order = Order::find($id);
        if($order){
            return $order;
        }
        return collect();
    }
}
