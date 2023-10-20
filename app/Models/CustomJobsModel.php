<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomJobsModel extends Model {
    use HasFactory;

    /**
     * Tabela associada com a model.
     *
     * @var string
     */
    protected $table = 'custom_jobs';
}