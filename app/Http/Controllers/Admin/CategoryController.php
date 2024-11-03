<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Alert;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $categoryService;
    private const PATH_VIEW = 'admin.categories.';

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {

        $categories = $this->categoryService->all();

        if ($categories->currentPage() > $categories->lastPage()) {
            return redirect()->route('admin.categories.index', ['page' => $categories->lastPage()]);
        }

        return view(self::PATH_VIEW . __FUNCTION__, compact('categories'));
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
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->store($request->all());

        Toastr::success(null, 'Thao tác thành công');
        return redirect()->route('admin.categories.index');
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
    public function edit(Category $category)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService->update($category, $request->all());

        Toastr::success(null, 'Thao tác thành công');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        try {
            if ($category) {
                $category->delete();
            }

            Alert::success("Bạn đã xóa thành công category:  {$category->name}", 'Thông Báo');
            return redirect()->route('admin.categories.index');
        } catch (\Throwable $th) {
            //throw $th;
            Alert::success("Có lỗi xảy ra. Check log", 'Thông Báo');
            Log::error("message" . $th->getMessage());
            return redirect()->back();
        }
    }
}
