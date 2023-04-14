<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Curriculo;
use App\Mail\SendMail;

class EmailController extends Controller
{
    public function enviarEmail(Request $request) 
    {
        // Configurar a conta para enviar o email no arquivo .env

        $curriculo = Curriculo::where('id', $request->session()->get('id'))->get()->first();

        //                        vvv  destinatário vvv
        $enviarEmail = Mail::to('felipe.clayton97@hotmail.com')->send(new SendMail($curriculo));

        dd($enviarEmail);
        flash('Currículo enviado com sucesso!')->success();
        return redirect()->intended('/'); 

    }
}
