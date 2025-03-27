<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    private const PATH_VIEW = 'admin.menus.';
    public function index()
    {
        $menus = Menu::query()->orderByDesc('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'name' => 'required|unique:menus',
                'position' => 'required|integer',
                'parent_id' => 'nullable|integer',
                'slug' => 'required|unique:menus',
                'is_active' => 'in:0,1'
            ]);

            if ($validated->fails()) {
                return back()->withErrors($validated)->withInput();
            }

            $validated = $validated->validated();
            $validated['is_active'] ??= 0;


            Menu::create($validated);
            Toastr::success(null, 'Thao tác thành công');
            return redirect()->route('admin.menus.index');
        } catch (\Throwable $th) {
            Log::error('error' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
