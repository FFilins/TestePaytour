@extends('layout.layout')

@section('content')

<div class="row justify-content-center">
    <div class="col col-sm-10 col-md-8 col-lg-6">
        <form action="{{route('curriculo.add')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input class="form-control" name="nome" required placeholder="Seu nome">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Endereço de e-mail</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" 
                required placeholder="Seu e-mail">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="tel" maxlength="15" onkeyup="handlePhone(event)"
                class="form-control" name="telefone" required placeholder="(xx) xxxxx-xxxx">
            </div>
            <div class="form-group">
                <label for="cargo">Cargo Desejado</label>
                <textarea class="form-control"  name="cargo" style="resize: none"  required placeholder="Cargo desejado"></textarea>
            </div>
            <div class="form-group">
                <label for="escolaridade">Escolaridade</label>
                <select name="escolaridade" class="form-control form-select form-select-lg" required id="escolaridade">
                    <option value="fundamental-incompleto">Fundamental incompleto</option>
                    <option value="fundamental-completo">Fundamental completo</option>
                    <option value="medio-incompleto">Médio incompleto</option>
                    <option value="medio-completo">Médio completo</option>
                    <option value="superior-incompleto">Superior incompleto</option>
                    <option value="superior-completo">Superior completo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="observacoes">Observações</label>
                <textarea class="form-control"  name="observacoes" style="resize: vertical" 
                placeholder="Observações"></textarea>
            </div>

            <div class="form-group">
                <label for="arquivo">Upload do Currículo</label>
                <input type="file" class="form-control" id="arquivo" name="arquivo" required>
            </div>




            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</div>

<script>
    const handlePhone = (event) => {
        let input = event.target
        input.value = phoneMask(input.value)
    }

    const phoneMask = (value) => {
        if (!value) return ""
        value = value.replace(/\D/g,'')
        value = value.replace(/(\d{2})(\d)/,"($1) $2")
        value = value.replace(/(\d)(\d{4})$/,"$1-$2")
        return value
    }
</script>

@endsection