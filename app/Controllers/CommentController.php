<?php
namespace App\Controllers;

use App\Models\CommentModel;
use CodeIgniter\Controller;

class CommentController extends Controller
{
    // Create Comment
    public function create()
    {
        $commentModel = new CommentModel();

        $userId = session()->get('id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $data = [
            'book_id' => $this->request->getPost('book_id'),
            'user_id' => $userId,
            'content' => $this->request->getPost('comment')
        ];

        if ($commentModel->save($data)) {
            return redirect()->to('/book/' . $data['book_id']);
        }

        return redirect()->back()->with('error', 'Failed to add comment.');
    }

    // Read Comments
    public function view($bookId)
    {
        $commentModel = new CommentModel();
        $comments = $commentModel->where('book_id', $bookId)->findAll();

        $book = [
            'id' => $bookId,
            'name' => 'Sample Book',  // Example book data
            'author_name' => 'Author Name'
        ];

        return view('book_view', [
            'book' => $book,
            'comments' => $comments
        ]);
    }

    // Update Comment
    public function update($commentId)
    {
        $commentModel = new CommentModel();
        $comment = $commentModel->find($commentId);

        // Check if the comment exists and belongs to the logged-in user
        if (!$comment || $comment['user_id'] !== session()->get('user_id')) {
            return redirect()->to('/book/' . $comment['book_id'])->with('error', 'Unauthorized action.');
        }

        // Update the comment
        if ($this->request->getMethod() === 'post') {
            $data = [
                'content' => $this->request->getPost('content')
            ];

            if ($commentModel->update($commentId, $data)) {
                return redirect()->to('/book/' . $comment['book_id']);
            }
        }

        return view('edit_comment', ['comment' => $comment]);
    }

    // Delete Comment
    public function delete($commentId)
    {
        $commentModel = new CommentModel();
        $comment = $commentModel->find($commentId);

        // Check if the comment exists and belongs to the logged-in user
        if (!$comment || $comment['user_id'] !== session()->get('user_id')) {
            return redirect()->to('/book/' . $comment['book_id'])->with('error', 'Unauthorized action.');
        }

        // Delete the comment
        if ($commentModel->delete($commentId)) {
            return redirect()->to('/book/' . $comment['book_id']);
        }

        return redirect()->back()->with('error', 'Failed to delete comment.');
    }
}
