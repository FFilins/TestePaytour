<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Curriculo;
use App\Mail\SendMail;
use Exception;

class EmailController extends Controller
{
    private string $email;

    public function __contruct() 
    {
        $this->email = config('app.email');
    }
    
    public function enviarEmail(Request $request) 
    {
        // Configurar a conta para enviar o email no arquivo .env

        try{
            $curriculo = Curriculo::where('id', $request->session()->get('id'))->get()->first();

            if(!$curriculo) {
                throw new Exception('curriculo não encontrado');
            }
            //                         vvv  destinatário  vvv
            $enviarEmail = Mail::to($this->email)->send(new SendMail($curriculo));
            
            flash('Currículo enviado com sucesso!')->success();
            return redirect()->intended('/'); 

        }catch (Exception $e) {
            flash($e->getMessage())->warning();
            return redirect()->back();
        }

    }
}
