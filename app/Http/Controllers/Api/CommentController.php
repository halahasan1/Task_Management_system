<?php
namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Services\CommentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentStoreRequest;
use App\Http\Requests\Comment\CommentUpdateRequest;

class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Store a newly created comment.
     */
    public function store(CommentStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;

            $comment = $this->commentService->create($data);

            return $this->successResponse($comment, 'Comment created successfully.', 201);
        } catch (\Throwable $e) {
            return $this->errorResponse('Failed to create comment.', 500, [$e->getMessage()]);
        }
    }

    /**
     * Update the specified comment.
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        try {

            $updated = $this->commentService->update($comment, $request->validated());

            return $this->successResponse($updated, 'Comment updated successfully.');
        } catch (\Throwable $e) {
            return $this->errorResponse('Failed to update comment.', 500, [$e->getMessage()]);
        }
    }

    /**
     * Remove the specified comment.
     */
    public function destroy(Comment $comment)
    {
        try {
            $this->authorize('delete', $comment);

            $this->commentService->delete($comment);

            return $this->successResponse(null, 'Comment deleted successfully.');
        } catch (\Throwable $e) {
            return $this->errorResponse('Failed to delete comment.', 500, [$e->getMessage()]);
        }
    }
}
