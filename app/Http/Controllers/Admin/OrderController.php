<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Alert;
use App\Http\Controllers\Controller;
use App\Services\OrderItemService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private const PATH_VIEW = 'admin.orders.';
    protected $orderService;
    protected $orderItemService;

    public function __construct(OrderService $orderService, OrderItemService $orderItemService)
    {
        $this->orderService = $orderService;
        $this->orderItemService = $orderItemService;
    }

    public function index()
    {
        $orders = $this->orderService->getAllPaginate();

        // dd($orders);

        return view(self::PATH_VIEW . __FUNCTION__, compact('orders'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = $this->orderService->findById($id);

        if (!empty($order)) {
            $this->orderService->deleteOrder($id);
        }
        Alert::success('Bạn đã xóa thành công orde', 'LuxChill thông báo');
        return redirect()->route('admin.orders.index');
    }
}
