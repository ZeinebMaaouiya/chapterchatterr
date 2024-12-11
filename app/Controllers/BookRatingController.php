<?php

namespace App\Controllers;

use App\Models\BookRatingModel;

class BookRatingController extends BaseController
{
    protected $bookRatingModel;

    public function __construct()
    {
        $this->bookRatingModel = new BookRatingModel();
    }

    // Save rating
    public function save()
    {
        $bookId = $this->request->getPost('book_id');
        $userId = session()->get('user_id'); // Ensure user is logged in
        $rating = $this->request->getPost('rating');

        if ($rating >= 1 && $rating <= 5) {
            $this->bookRatingModel->saveRating($bookId, $userId, $rating);
            return $this->response->setJSON(['success' => true, 'message' => 'Rating saved successfully!']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Invalid rating value.']);
    }

    // Fetch average rating and count
    public function getRating($bookId)
    {
        $averageRating = $this->bookRatingModel->getAverageRating($bookId);
        $ratingCount   = $this->bookRatingModel->getRatingCount($bookId);

        return $this->response->setJSON([
            'averageRating' => $averageRating,
            'ratingCount'   => $ratingCount,
        ]);
    }
}
