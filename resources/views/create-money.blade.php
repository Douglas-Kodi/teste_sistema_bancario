@extends('templates.template')

@section('content')

<div class="row g-5">
    <div class="col-md-8">

        <hr class="my-4">

            <h4 class="mb-3">Tipo de transição:</h4>
            <form class="needs-validation" method="post" enctype="multipart/form-data" action="{{url('moneys')}}">

            @csrf

            <div class="row g-3">

                <input type="text" class="form-control" name="id" value="{{$user->id}}" hidden>

                <div class="my-3">
                    <div class="form-check">
                    <input id="deposito" name="type" type="radio" class="form-check-input" value="1" checked required>
                    <label class="form-check-label" for="deposito">Deposito</label>
                    </div>
                    <div class="form-check">
                    <input id="saque" name="type" type="radio" class="form-check-input" value="2" required>
                    <label class="form-check-label" for="saque">Saque</label>
                    </div>
                </div>

                <div class="col-12">
                    <label for="valor" class="form-label">Digite o valor:</label>
                    <input type="text" class="form-control" name="valor" id="valor" placeholder="Ex: 100,00" required>
                </div>

                <div class="col-12">
                    <label for="password" class="form-label">Senha:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="********" required onchange='confereSenha();'>
                    <div class="invalid-feedback">
                        Por favor digite o sua senha!
                    </div>
                </div>

            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">
                Realizar a transição
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

