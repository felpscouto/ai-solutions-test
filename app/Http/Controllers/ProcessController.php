<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentModel;

class ProcessController extends Controller {
    public function index() {
        $documents = DocumentModel::orderBy("id", "desc")->get();

        return view("documents/process", compact('documents'));
    }
}
