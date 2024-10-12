<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    /**
     * @var Category $model
     */
    protected $model;

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
