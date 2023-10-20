<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model {
    use HasFactory;

    /**
     * Tabela associada com a model.
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * Relação para acesso de dados da tabela categoria.
     *
     * @var string
     */
    public function category() {
        return $this->belongsTo(CategoryModel::class);
    }
}
