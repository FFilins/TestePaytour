<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\EmailController;
use App\Models\Curriculo;
use App\Mail\SendMail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;

class EmailTest extends TestCase
{
    use RefreshDatabase; // Para recriar o banco de dados em cada teste
    use WithFaker; // Para usar dados falsos nos testes
    
    /** @test */
    public function testEnvioDeEmail()
    {
        $curriculo = Curriculo::factory()->make();

        $dadosFormulario = [
            'nome' => $curriculo->name,
            'email' => $curriculo->email,
            'telefone' => $curriculo->telefone,
            'cargo' => $curriculo->cargo,
            'escolaridade' => $curriculo->escolaridade,
            'observacoes' => $curriculo->observacoes,
            'arquivo' => UploadedFile::fake()->image('imagem.jpg'),
        ];

        $response = $this->post(route('email.enviar'), $dadosFormulario);

        // Verificar se o email foi enviado com sucesso
        // Mail::assertSent(SendMail::class, function ($mail) use ($curriculo) {
        //     return $mail->hasTo(config('app.email')) // Verificar o destinatário do email
        //         && $mail->curriculo->id === $curriculo->id; // Verificar se o currículo correto foi passado para o email
        // });

        // Verificar a resposta da requisição
        $response->assertStatus(200);
        $response->assertSessionHas('success'); // Verificar se a mensagem de sucesso está presente na sessão
    }
}
