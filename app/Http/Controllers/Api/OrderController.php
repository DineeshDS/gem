<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Resources\LeadResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Traits\OrderTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use OrderTrait;
    /**
     * @var
     */
    protected  $orderRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Fetched Orders successfully',
            'data' =>  OrderResource::collection($this->orderRepository->list())
        ]);
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $validated = $this->formatOrderData($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => new OrderResource($this->orderRepository->create($validated))
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Single order fetched successfully',
            'data' => new OrderResource($this->orderRepository->show($id))
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully',
            'data' => new OrderResource($this->orderRepository->update($id, $this->formatOrderData($request->validated())))
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->orderRepository->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully',
            'data' => []
        ]);
    }
}
