<?php

namespace App\Models;

use CodeIgniter\Model;

class RatingModel extends Model
{
    protected $table = 'ratings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['book_id', 'user_id', 'rating'];
    protected $useTimestamps = true;  // Automatically manage created_at and updated_at

    // You can add additional methods like averageRating() to get the average rating for a book
    public function getAverageRating($bookId)
    {
        return $this->where('book_id', $bookId)->avg('rating');
    }
}
