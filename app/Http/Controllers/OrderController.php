<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * @return mixed
     */
    public function list(Request $request, DataTables $dataTables): mixed
    {
        if ($request->ajax()) {
            $query = Order::query();
            return $dataTables->eloquent($query)
                ->addColumn('actions', function ($query) {

                    $deleteForm = '';
                    if ($query->id != 1 && $query->id != auth()->user()->id) {
                        $deleteForm = '<a href="javascript:void(0)" class="btn-edit" data-id="'.$query->id.'" onclick="delete_order('.$query->id.')" class="btn btn-sm btn-danger delete-confirm">
                                <i class="bi bi-trash"></i>
                            </a>';
                    }

                    return $deleteForm;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('orders.index');
    }

    /**
     * @return mixed
     */
    public function create(): mixed
    {
        return view('orders.create');
    }
}
