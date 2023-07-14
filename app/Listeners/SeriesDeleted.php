<?php

namespace App\Listeners;

use App\Events\SeriesDeletedEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SeriesDeleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SeriesDeletedEvent  $event
     * @return void
     */
    public function handle(SeriesDeletedEvent $event)
    {
        Log::info("Removendo série {$event->series->nome}");

        if($event->series->delete()){
            Log::info("Série {$event->series->nome} removida com sucesso do banco de dados");
        }else{
            Log::error("Erro ao remover série {$event->series->nome} do banco de dados");
        }
        
        $file = $event->series->cover;
        if(isset($file) && file_exists(public_path('storage/'.$file)) ){ 
            Log::info("Arquivo de imagem da série {$event->series->nome} removido com sucesso.");
            Storage::disk('public')->delete($file);
        }else{
            Log::error("Arquivo de imagem da série {$event->series->nome} não encontrado.");
        }
    }
}
