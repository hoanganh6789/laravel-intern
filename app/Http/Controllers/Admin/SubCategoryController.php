<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Alert;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class SubCategoryController extends Controller
{
    private const PATH_VIEW = 'admin.subcategories.';
    public function index()
    {

        $subCategories = SubCategory::query()
            ->latest()->paginate(10);

        if ($subCategories->currentPage() > $subCategories->lastPage()) {
            return redirect()->route('admin.sub-categories.index', parameters: ['page' => $subCategories->lastPage()]);
        }

        return view(self::PATH_VIEW . __FUNCTION__, compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()
            ->latest()
            ->get();


        return view(self::PATH_VIEW . __FUNCTION__, compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {

        $data = $request->except(['status', 'is_active']);
        $data['status'] = $request->boolean('status', false);
        $data['is_active'] = $request->boolean('is_active', false);
        $data['slug'] = Str::slug($request->name, '-') . '-' .  time();

        SubCategory::create($data);

        Toastr::success(null, 'Thao tác thành công');
        return redirect()->route('admin.sub-categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::query()
            ->latest()
            ->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact(['subCategory', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        $data = $request->except(['status', 'is_active']);
        $data['status'] = $request->boolean('status', false);
        $data['is_active'] = $request->boolean('is_active', false);
        $data['slug'] = Str::slug($request->name, '-') . '-' .  time();

        $subCategory->update($data);

        Toastr::success(null, 'Thao tác thành công');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {

        try {

            if ($subCategory) {
                $subCategory->delete();
            }

            Alert::success("Bạn đã xóa thành công Sub Category:  {$subCategory->name}", 'Thông Báo');
            return redirect()->route('admin.sub-categories.index');
        } catch (\Throwable $th) {
            //throw $th;
            Alert::success("Có lỗi xảy ra. Check log", 'Thông Báo');
            Log::error("message" . $th->getMessage());
            return redirect()->back();
        }
    }
}
