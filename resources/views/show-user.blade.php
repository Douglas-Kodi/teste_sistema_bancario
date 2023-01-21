@extends('templates.template')

@section('content')

<link href="https://getbootstrap.com/docs/5.3/examples/sidebars/sidebars.css" rel="stylesheet">

<div class="row g-5">
    <main class="d-flex flex-nowrap">
        <div class="col-md-8">
            <hr class="my-4">

            <article class="blog-post">
                <h3>Controle de dados</h3>
                <p>Tabela fictícia: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Numero da Conta:</th>
                            <th>{{$user->numcc}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nome:</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <td>CPF:</td>
                            <td>{{$user->cpf}}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{$user->email}}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Data de crianção da conta:</td>
                            <td>
                                @php
                                    echo date('d/m/Y', strtotime($user->created_at));
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <td>Data da ultima atualização da conta:</td>
                            <td>
                                @php
                                    echo date('d/m/Y', strtotime($user->updated_at));
                                @endphp
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </article>

        </div>

        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 380px;">
            <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
                <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
                <span class="fs-5 fw-semibold">Extrato</span>
                <a class="btn btn-outline-primary rounded-pill" href="{{url("moneys/$user->id")}}">Realizar Transação</a>
            </a>
            <div class="list-group list-group-flush border-bottom scrollarea">
                <a href="#" class="list-group-item list-group-item-action py-3 lh-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                    <strong class="mb-1">Saldo</strong>
                    <small>
                        R$ 
                        @php
                            $totaldeposito = 0;
                            $totalsaque = 0;
                            $total = 0;
                        @endphp

                        @foreach($moneys as $money)
                            @php
                                if($money->id_numcc == $user->id){
                                    if($money->type==1){
                                        $totaldeposito = $totaldeposito + $money->valor;
                                    }else{
                                        $totalsaque = $totalsaque + $money->valor;
                                    }
                                    $total = $totaldeposito -$totalsaque;
                                }
                            @endphp
                        @endforeach
                        @php
                            if($total>=0){
                                @endphp
                                    <span style="color:blue;">{{ number_format($total,2,",","."); }}</span>
                                @php
                            }else{
                                @endphp  
                                    <span style="color:red;">{{ number_format($total,2,",","."); }}</span>
                                @php
                            }
                        @endphp
                    </small>
                    </div>
                </a>
                @foreach($moneys as $money)
                    @php
                        if($money->id_numcc == $user->id){
                    @endphp
                        <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <strong class="mb-1">R$ 
                                    @php
                                        if($money->type==1){
                                    @endphp
                                        <span style="color:blue;">{{ number_format($money->valor,2,",","."); }}</span>
                                    @php
                                        }else{
                                    @endphp  
                                        <span style="color:red;">-{{ number_format($money->valor,2,",","."); }}</span>
                                    @php
                                        }
                                    @endphp
                                </strong>
                                <small class="text-muted">
                                    @php
                                        echo date('d/m/Y', strtotime($money->created_at));
                                    @endphp
                                </small>
                            </div>
                            <div class="col-10 mb-1 small">
                                @php
                                    if($money->type==1){
                                @endphp
                                    Deposito
                                @php
                                    }else{
                                @endphp
                                    Saque
                                @php
                                    }
                                @endphp
                            </div>
                        </a>
                    @php
                        }
                    @endphp
                @endforeach
            </div>
        </div>
    </main>
    
</div>

<script src="https://getbootstrap.com/docs/5.3/examples/sidebars/sidebars.js"></script>

@endsection

