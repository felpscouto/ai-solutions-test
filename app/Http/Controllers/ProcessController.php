<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Artisan;
use App\Models\DocumentModel;
use App\Jobs\ProcessDocumentQueueJob;

class ProcessController extends Controller {
    public function index() {
        // Recuperando documentos
        $documents = DocumentModel::where("queue_status", "unprocessed")->orderBy("id", "desc")->get();

        // Transformando os dados recuperados em um
        $documentsInJsonFormat = json_encode($documents, true);

        return view("documents/process", compact('documents'));
    }
    
    public function startQueue() {
        // Inicializando a queue
        Artisan::call('queue:work', []);
    }

    public function processQueue() {
        $response = [
            "code" => 500,
            "status"=> "error",
            "message"=> "Oops! Algum erro acabou ocorrendo :("
        ];

        try {
            // Carregando documentos
            $documents = DocumentModel::orderBy('id', 'desc')->where('queue_status', 'unprocessed')->get();

            foreach($documents as $document) {
                // Atualizando o campo queue_status como 'processing'
                $document->update(['queue_status' => 'processing']);

                // Enviando documentos para a fila
                dispatch(new ProcessDocumentQueueJob($document));
            }

            // Se tudo ocorrer bem, devemos atualizar nossa variável $response
            $response['code'] = 200;
            $response['status'] = 'success';
            $response['message'] = 'Oba! Seus documentos foram processados com sucesso!';
        }

        catch(Exception $e) {
            // Caso alguma exception for gerada, retornar o erro (APENAS EM AMBIENTE DE DESENVOLVIMENTO!)
            $response['code'] = $e->getCode();
            $response['message'] = $e->getMessage();
        }

        return response()->json([$response], $response['code']);
    }
}