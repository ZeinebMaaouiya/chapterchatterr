<?php

namespace App\Models;

use CodeIgniter\Model;

class BookRatingModel extends Model
{
    protected $table         = 'book_ratings';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['book_id', 'user_id', 'rating', 'created_at', 'updated_at'];

    protected $useTimestamps = true;

    // Save or update a rating
    public function saveRating($bookId, $userId, $rating)
    {
        $existingRating = $this->where('book_id', $bookId)
                               ->where('user_id', $userId)
                               ->first();

        if ($existingRating) {
            $this->update($existingRating['id'], ['rating' => $rating]);
        } else {
            $this->insert([
                'book_id' => $bookId,
                'user_id' => $userId,
                'rating'  => $rating,
            ]);
        }
    }

    // Get the average rating for a book
    public function getAverageRating($bookId)
    {
        return $this->selectAvg('rating')
                    ->where('book_id', $bookId)
                    ->get()
                    ->getRow()
                    ->rating;
    }

    // Get the total number of ratings for a book
    public function getRatingCount($bookId)
    {
        return $this->where('book_id', $bookId)->countAllResults();
    }
}
