<h1>Curriculo de:</h1>
<h2>{{$nome}}</h2>
<br>
<h3 style="display:inline">Email: </h3><span>{{$email}}</span>
<br>
<br>
<h3 style="display:inline">Telefone: </h3><span>{{$telefone}}</span>
<br>
<br>
<h3>cargo: </h3>
<span>{{$cargo}}</span>
<br>
<br>
<h3 style="display:inline">Escolaridade: </h3><span>{{$escolaridade}}</span>
<br>
<br>
@if(isset($observacoes))
<h3>Observações: </h3>
<span>{{$observacoes}}</span>
<br>
<br>
@endif