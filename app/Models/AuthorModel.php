<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthorModel extends Model
{
    protected $table      = 'authors';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'bio', 'created_at', 'updated_at'];

    // Validation Rules
    protected $validationRules    = [
        'name' => 'required|min_length[3]|max_length[255]',
        'bio'  => 'permit_empty|string'
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'The name field is required.',
            'min_length' => 'Name must be at least 3 characters long.',
            'max_length' => 'Name cannot be longer than 255 characters.'
        ]
    ];
    protected $skipValidation     = false;
}
