<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\DocumentModel;
use App\Models\CustomJobsModel;

class ProcessDocumentQueueJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $delete = false;

    protected $document;

    public function __construct(DocumentModel $document) {
        $this->document = $document;
    }

    public function handle() {
        // Atualizando o campo queue_status como 'processed'
        $this->document->update(['queue_status' => 'processed']);

        // Inserindo o nova linha na tabela custom_jobs
        $newCustomJob = new CustomJobsModel();
        $newCustomJob->job_id = $this->job->getJobId();
        $newCustomJob->job_type = static::class;
        $newCustomJob->payload = json_encode($this->job);
        $newCustomJob->save();
    }
}