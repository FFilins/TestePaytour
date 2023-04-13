<?php

namespace App\Http\Controllers;

use App\Models\Curriculo;

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
            $curriculo = new Curriculo();

            $curriculo->nome = $request->nome;
            $curriculo->email = $request->email;
            $curriculo->telefone = $request->telefone;
            $curriculo->cargo = $request->cargo;
            $curriculo->escolaridade = $request->escolaridade;
            $curriculo->observacoes = $request->observacoes;
            $curriculo->ip = $request->ip();

            // dd($request->ip());
            //validate file
            if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
                $request->validate([
                    'arquivo' => 'required|mimes:pdf,doc,docx|max:1024'
                ]);
                
                $arquivo = $request->arquivo;
                $extension = $arquivo->extension();
                $arquivoName = md5($arquivo->getClientOriginalName() . strtotime("now") . '.' . $extension);
                $arquivo->move(public_path('arquivos/curriculos'), $arquivoName);
                $curriculo->arquivo = $arquivoName;
                
                $curriculo->save();

                flash('Currículo enviado com sucesso!');
                return redirect()->back();
            }

            throw new Exception('Erro: Arquivo não suportado!');

        }catch (Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }

    }
}
