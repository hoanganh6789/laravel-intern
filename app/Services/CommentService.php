<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }


    public function createComment($data)
    {
        try {
            $data['user_id'] = Auth::id();
            return $this->commentRepository->create($data);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }

    public function getComment($productId)
    {
        try {
            return $this->commentRepository->findCommentByProductId($productId);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }

    public function getAllComment()
    {
        try {
            return $this->commentRepository->getAllWithRelation(5, ['user', 'product']);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }

    public function deleteById($id)
    {
        try {
            $this->commentRepository->deleteById($id);
            return true;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
}
