<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository extends BaseRepository
{

    /**
     * @var Comment $model
     */
    protected $model;

    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    public function getAllWithRelation($perPage = 10, array $relations)
    {
        return $this->model->with($relations)->latest('id')->paginate($perPage);
    }

    public function findCommentByProductId($productId)
    {
        return $this->model
            ->with(['user'])
            ->where(['product_id' => $productId])
            ->latest('id')
            ->get();
    }

    public function deleteById($id)
    {
        $comment = $this->model->find($id);
        return $comment->delete();
    }
}
