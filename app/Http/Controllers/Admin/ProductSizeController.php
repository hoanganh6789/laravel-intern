<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    private const VIEW_PATH = "admin.product_size.";
    public function index()
    {
        return view(self::VIEW_PATH . __FUNCTION__);
    }

    public function create()
    {
        return view(self::VIEW_PATH . __FUNCTION__);
    }
    public function store() {}
    public function show() {}
    public function edit() {}
    public function update() {}
    public function destroy() {}
}
