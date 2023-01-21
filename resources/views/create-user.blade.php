@extends('templates.template')

@section('content')

<script>
    function confereSenha(){
        const senha = document.querySelector('input[name=password]');
        const senha2 = document.querySelector('input[name=password2]');

        if(senha2.value ===  senha.value){
            senha2.setCustomValidity('');
        }else{
            senha2.setCustomValidity('As senhas não são iguais!');
        }
    }
</script>

<div class="row g-5">
    <div class="col-md-8">

        <hr class="my-4">

        @if(isset($user))
            <h4 class="mb-3">Alterar Conta</h4>
            <form class="needs-validation" method="post" enctype="multipart/form-data" action="{{url("users/$user->id")}}">
            @method('PUT')
        @else 
            <h4 class="mb-3">Cadastro de Conta</h4>
            <form class="needs-validation" method="post" enctype="multipart/form-data" action="{{url('users')}}">
        @endif
            @csrf
            <div class="row g-3">

                <div class="col-12">
                    <label for="name" class="form-label">Nome completo:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Example Name" value="{{$user->name ?? ''}}" required>
                    <div class="invalid-feedback">
                        Por favor digite o seu nome!
                    </div>
                </div>
                
                <div class="col-12">
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" class="form-control" name="cpf" id="cpf" placeholder="123.456.789-00" value="{{$user->cpf ?? ''}}" required>
                    <div class="invalid-feedback">
                        Por favor digite o seu CPF!
                    </div>
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">Email: <span class="text-muted">(Optional)</span></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" value="{{$user->email ?? ''}}" required>
                    <div class="invalid-feedback">
                        Por favor digite o seu email!
                    </div>
                </div>

                <div class="col-12">
                    <label for="password" class="form-label">Senha:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="********" value="{{$user->password ?? ''}}" required onchange='confereSenha();'>
                    <div class="invalid-feedback">
                        Por favor digite o sua senha!
                    </div>
                </div>

                <div class="col-12">
                    <label for="password2" class="form-label">Repita a senha:</label>
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="********" value="{{$user->password ?? ''}}" required onchange='confereSenha();'>
                </div>

            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">
            @if(isset($user))
                Alterar
                @method('PUT')
            @else 
                Adicionar
            @endif
            </button>

        </form>
        
        <hr class="my-4">

    </div>

    <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">

        <hr class="my-4">
        
            <div class="p-4 mb-3 bg-light rounded">
                <h4 class="fst-italic">About</h4>
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
    </div>
</div>

@endsection

