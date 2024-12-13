<?php
namespace App\Controllers;

use App\Models\RatingModel;
use CodeIgniter\Controller;

class RatingController extends Controller
{
    // Rate a book
    public function rate()
    {
        $ratingModel = new RatingModel();

        $data = [
            'book_id' => $this->request->getPost('book_id'),
            'user_id' => session()->get('user_id'), // Assuming you're using session for user info
            'rating' => $this->request->getPost('rating'),
        ];

        // Save rating to the database
        if ($ratingModel->save($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Rating added successfully.']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to add rating.']);
    }

    // Get average rating for a book
    public function averageRating($bookId)
    {
        $ratingModel = new RatingModel();

        // Calculate the average rating for the book
        $averageRating = $ratingModel->where('book_id', $bookId)->avg('rating');

        return $this->response->setJSON(['average_rating' => $averageRating]);
    }
}
