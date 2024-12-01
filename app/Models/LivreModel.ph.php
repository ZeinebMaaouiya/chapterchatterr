<?php

namespace App\Models;

use CodeIgniter\Model;

class LivreModel extends Model
{
    protected $table      = 'livre';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'name', 'author_id', 'category_id', 'summary', 'pages', 'published_date',
        'format', 'isbn', 'asin', 'language', 'cover_image', 'created_at', 'updated_at'
    ];

    // Validation Rules
    protected $validationRules    = [
        'name'        => 'required|min_length[3]|max_length[255]',
        'author_id'   => 'required|is_natural_no_zero',
        'category_id' => 'required|is_natural_no_zero',
        'isbn'        => 'permit_empty|max_length[20]',
        'asin'        => 'permit_empty|max_length[20]'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'The book name field is required.',
            'min_length' => 'Book name must be at least 3 characters long.',
            'max_length' => 'Book name cannot be longer than 255 characters.'
        ],
        'author_id' => [
            'required' => 'The author field is required.',
            'is_natural_no_zero' => 'The author ID must be a valid positive integer.'
        ],
        'category_id' => [
            'required' => 'The category field is required.',
            'is_natural_no_zero' => 'The category ID must be a valid positive integer.'
        ]
    ];

    protected $skipValidation     = false;

    // Relationships
    public function getAuthor()
    {
        return $this->belongsTo(AuthorModel::class, 'author_id');
    }

    public function getCategory()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }
}
