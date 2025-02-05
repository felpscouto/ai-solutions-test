<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model {
    use HasFactory;

    /**
     * Tabela associada com a model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * Permitir economizar por meio de criação e métodos massivos.
     *
     * @var string
     */
    protected $fillable = ['name'];
}
