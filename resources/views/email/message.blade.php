<h1>Deu tudo certo por aqui!</h1>
<br>
<h3>Nome:</h3>
<p>{{$request->nome}}</p>
<br>
<h3>Email:</h3>
<p>{{$request->email}}</p>
<br>
<h3>Telefone:</h3>
<p>{{$request->telefone}}</p>
<br>
<h3>cargo:</h3>
<p>{{$request->cargo}}</p>
<br>
<h3>Escolaridade:</h3>
<p>{{$request->escolaridade}}</p>
<br>
@if(isset($request->observacoes))
<h3>Observações:</h3>
<p>{{$request->observacoes}}</p>
<br>
@endif