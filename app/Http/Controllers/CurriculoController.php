<?php

namespace App\Http\Controllers;

use App\Models\Curriculo;
use App\UseCases\EnviarCurriculoPorEmail;
use Exception;
use Illuminate\Http\Request;

class CurriculoController extends Controller
{
    public function show(Request $request) 
    {
        return view('curriculo.show');
    }

    public function add(Request $request) 
    {
        

        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telefone' => 'required|string|max:20',
                'cargo' => 'required|string|max:255',
                'escolaridade' => 'required|string|max:30',
                'observacoes' => 'nullable|string|max:255',
                'arquivo' => 'required|mimes:pdf,doc,docx|max:1024'
            ]);

            $curriculo = new Curriculo();

            $curriculo->nome = $request->nome;
            $curriculo->email = $request->email;
            $curriculo->telefone = $request->telefone;
            $curriculo->cargo = $request->cargo;
            $curriculo->escolaridade = $request->escolaridade;
            $curriculo->observacoes = $request->observacoes;
            $curriculo->ip = $request->ip();

            // dd($request->ip());
            // validate file
            if ($request->file('arquivo')->isValid()) {
                
                $arquivo = $request->arquivo;
                $extension = $arquivo->extension();
                $arquivoName = md5($arquivo->getClientOriginalName() . strtotime("now")) . '.' . $extension;
                $arquivo->move(public_path('arquivos/curriculos'), $arquivoName);
                $curriculo->arquivo = $arquivoName;
                
                $curriculo->save();

                $enviarCurriculoPorEmail = new EnviarCurriculoPorEmail($curriculo);

                $enviarCurriculoPorEmail->enviar();
                if($enviarCurriculoPorEmail->foiEnviado()) {
                    flash('Currículo enviado com sucesso!');
                    return redirect()->back();
                }
                
                // $id = $curriculo->id;
                // flash('Currículo enviado com sucesso!');
                // return redirect()->route('email.enviar')->with(compact('id'));
            }else {
                throw new Exception('Arquivo não é válido!');
            }

        }catch (Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }

    }
}
