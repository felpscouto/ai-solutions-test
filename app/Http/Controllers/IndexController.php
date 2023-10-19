<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CategoryModel;
use App\Models\DocumentModel;

class IndexController extends Controller {
    public function uploadJsonFile(Request $request) {
        $response = [
            "code" => 500,
            "status"=> "error",
            "message"=> "Oops! Algum erro acabou ocorrendo :("
        ];

        try {
            // Recuperando arquivo
            $file = $request->file('jsonFile');
        
            if($request->hasFile('jsonFile') && $file->isValid()) {
                // Gerando nome temporário do arquivo
                $fileName = uniqid() . '-' . $file->getClientOriginalName();

                // Salvando o arquivo e recuperando seu caminho
                $path = Storage::putFileAs('data/imported-json-files', $file, $fileName);

                // Lendo o JSON
                $jsonData = Storage::get($path);

                // Transformando em um array de dados
                $jsonFileToArray = json_decode($jsonData, true);

                // Percorrendo o array de dados do JSON
                foreach($jsonFileToArray['documentos'] as $document) {
                    $categoryId = $this->categoryCreation($document['categoria']);

                    // Inserindo o novo documento
                    $this->documentCreation($document, $categoryId);
                }

                // Se tudo ocorrer bem, devemos atualizar nossa variável $response
                $response['code'] = 200;
                $response['status'] = 'success';
                $response['message'] = 'Oba! Seus documentos foram importados com sucesso!';
            }
        }

        catch(Exception $e) {
            // Caso alguma exception for gerada, retornar o erro (APENAS EM AMBIENTE DE DESENVOLVIMENTO!)
            $response['code'] = $e->getCode();
            $response['message'] = $e->getMessage();

            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], $response['code']);
        }

        return response()->json([$response], $response['code']);
    }

    private function categoryCreation($name) {
        // Tentando encontrar a categoria com o nome fornecido
        $category = CategoryModel::firstOrNew(['name' => trim($name)]);
                    
        // Verificando se a categoria já existe no banco de dados para não haver duplicidade
        if(!$category->exists) {
            // Se a categoria não existir, é criada no banco de dados
            $category->name = trim($name);
            $category->save();
        }

        return $category->id;
    }

    private function documentCreation($document, $categoryId) {
        // Inserindo o novo documento
        $brandnewDocument = new DocumentModel();
        $brandnewDocument->title = $document['titulo'];
        $brandnewDocument->contents = $document['conteúdo'];
        $brandnewDocument->category_id = $categoryId;
        $brandnewDocument->save();
    }
}