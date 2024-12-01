<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'categories';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'created_at', 'updated_at'];

    // Validation Rules
    protected $validationRules    = [
        'name' => 'required|min_length[3]|max_length[255]'
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'The name field is required.',
            'min_length' => 'Category name must be at least 3 characters long.',
            'max_length' => 'Category name cannot be longer than 255 characters.'
        ]
    ];
    protected $skipValidation     = false;
}
