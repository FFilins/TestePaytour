<?php

namespace App\UseCases;

use App\Models\Curriculo;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Exception;

class EnviarCurriculoPorEmail 
{
    private Curriculo $curriculo;

    private string $email;

    private bool $enviado = false;

    public function __construct(Curriculo $curriculo) 
    {
        $this->curriculo = $curriculo;

        $this->email = config('app.email');

    }

    public function enviar() 
    {
         // Configurar a conta para enviar o email no arquivo .env
        try {
            $enviarEmail = Mail::to($this->email)->send(new SendMail($this->curriculo));
            if ($enviarEmail) {
                $this->enviado = true;
            }

        }catch(Exception $e) {
            throw new Exception('Erro ao enviar Email');
        }

    }

    public function foiEnviado() :bool 
    {
        return $this->enviado;
    }
}
