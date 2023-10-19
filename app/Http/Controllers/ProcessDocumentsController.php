<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProcessDocumentsController extends Controller
{
    public function uploadJsonFile(Request $request) {
        // Recuperando arquivo
        $file = $request->file('jsonFile');
    
        if($request->hasFile('jsonFile') && $file->isValid()) {
            // Gerando nome temporário do arquivo
            $fileName = uniqid() . '-' . $file->getClientOriginalName();

            // Salvando o arquivo e recuperando seu caminho
            $path = Storage::putFileAs('data/imported-json-files', $file, $fileName);

            // Continuar aqui
        }
        
        else {
            //return redirect('/')->with('error', 'Please upload a valid JSON file.');
        }
    }
}