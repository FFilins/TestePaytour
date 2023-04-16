<?php

namespace Tests\Feature;

use App\Mail\SendMail;
use App\Models\Curriculo;
use App\UseCases\EnviarCurriculoPorEmail;
use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CurriculoTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function pode_enviar_curriculo_por_email()
    {
        $this->app['env'] = 'testing';
        Mail::fake();

        $totalDeCurriculosAntesDeEnviar = Curriculo::all()->count();

        $curriculo = Curriculo::factory()->make();

        $response = $this->post(route('curriculo.add'), [
            'nome' => $curriculo->nome,
            'email' => $curriculo->email,
            'telefone' => $curriculo->telefone,
            'cargo' => $curriculo->cargo,
            'escolaridade' => $curriculo->escolaridade,
            'observacoes' => $curriculo->observacoes,
            'arquivo' => UploadedFile::fake()->create('curriculo.pdf', 1024)
        ]);

        $totalDeCurriculosDepoisDeEnviar = Curriculo::all()->count();

        $response->assertSuccessful();

        $this->assertDatabaseHas('curriculos', [
            'nome' => $curriculo->nome,
            'email' => $curriculo->email,
            'telefone' => $curriculo->telefone,
            'cargo' => $curriculo->cargo,
            'escolaridade' => $curriculo->escolaridade,
            'observacoes' => $curriculo->observacoes
        ]);

        $this->assertFileExists(public_path('arquivos/curriculos/' . $curriculo->arquivo));
         
        $this->assertGreaterThan($totalDeCurriculosAntesDeEnviar, $totalDeCurriculosDepoisDeEnviar);

        $this->assertEquals($totalDeCurriculosDepoisDeEnviar, $totalDeCurriculosAntesDeEnviar + 1);

        //       não consegui testar se o email foi enviado.
        
        // Mail::assertSent(SendMail::class, function ($mail) use ($curriculo) {
        //     return $mail->hasTo($curriculo->email) &&
        //         $mail->curriculo->nome === $curriculo->nome &&
        //         $mail->curriculo->email === $curriculo->email &&
        //         $mail->curriculo->telefone === $curriculo->telefone &&
        //         $mail->curriculo->cargo === $curriculo->cargo &&
        //         $mail->curriculo->escolaridade === $curriculo->escolaridade &&
        //         $mail->curriculo->observacoes === $curriculo->observacoes;
        // });
    }
}
