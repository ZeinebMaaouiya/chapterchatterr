<?php

namespace App\Models;

use CodeIgniter\Model;

class LivreModel extends Model
{
    protected $table = 'livre';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'author_id', 'summary', 'pages', 'published_date', 'format', 'isbn', 'asin', 'language', 'cover_image'];

    protected $validationRules = [
        'name' => 'required|max_length[255]',
        'author_id' => 'required|integer',
        'isbn' => 'required|is_unique[livre.isbn]',
        'asin' => 'required|is_unique[livre.asin]',
    ];
}
