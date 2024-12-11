<?php

namespace App\Models;

use CodeIgniter\Model;

class BookCategoriesModel extends Model
{
    protected $table = 'book_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['livre_id', 'category_id'];
}
