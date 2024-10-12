<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all()
    {
        return $this->categoryRepository->paginate(10);
    }

    public function store(array $data)
    {
        try {
            $data['status'] ??= 0;
            $data['is_active'] ??= 0;
            $data['slug'] = Str::slug($data['name'], '-') . '-' .  Str::ulid();

            $category =  $this->categoryRepository->create($data);

            return $category;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * @var Category $category
     */

    public function update($category, array $data)
    {
        try {

            $data['status'] = !isset($data['status']) ? 0 : 1;
            $data['is_active'] = !isset($data['is_active']) ? 0 : 1;
            $data['slug'] = Str::slug($data['name'], '-') . '-' .  Str::ulid();

            $category->update($data);

            return $category;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
