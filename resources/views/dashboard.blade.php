@extends('templates.template')

@section('content')

@csrf

<style>
    .blog-pagination svg{
        display:none;
    }
    .blog-pagination .hidden{
        display:none;
    }
</style>

<div class="row g-5">
    <div class="col-md-8">
        <hr class="my-4">

        <article class="blog-post">
            <h3>Example table</h3>
            <p>Tabela fictícia: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Numero da Conta</th>
                        <th>Tipo de Transação</th>
                        <th>Valor</th>
                        <th>Data da realização</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($extrato as $extratos)
                    <tr>
                        <td>
                        @foreach($users as $user)
                            @php
                                if($extratos->id_numcc==$user->id){
                            @endphp
                                {{$user->numcc}}
                            @php
                                }
                            @endphp
                        @endforeach
                        </td>
                        <td>
                            @php
                                if($extratos->type==1){
                            @endphp
                                Deposito
                            @php
                                }else{
                            @endphp
                                Saque
                            @php
                                }
                            @endphp
                        </td>
                        <td>
                            R$ 
                            @php
                                if($extratos->type==1){
                            @endphp
                                <span style="color:blue;">{{ number_format($extratos->valor,2,",","."); }}</span>
                            @php
                                }else{
                            @endphp  
                                <span style="color:red;">-{{ number_format($extratos->valor,2,",","."); }}</span>
                            @php
                                }
                            @endphp
                        </td>
                        <td>
                            @php
                                echo date('d/m/Y', strtotime($extratos->created_at));
                            @endphp
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </article>

        <nav class="blog-pagination" aria-label="Pagination">
            {{$extrato->links()}}
        </nav>
        
        <hr class="my-4">

    </div>

    <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
            <div class="p-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>
                @php
                    $totaldeposito = 0;
                    $totalsaque = 0;
                    $total = 0;
                @endphp

                @foreach($moneys as $money)
                    @php
                        if($money->type==1){
                            $totaldeposito = $totaldeposito + $money->valor;
                        }else{
                            $totalsaque = $totalsaque + $money->valor;
                        }
                        $total = $totaldeposito -$totalsaque;
                    @endphp
                @endforeach
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
                <canvas id="myChart" width="25%" height="20"></canvas>
                <script>
                var canvas = document.getElementById('myChart');
                Chart.defaults.global.legend.display = false;
                var data = {
                labels: ["Depositos", "Saques", "Saldo"],
                datasets: [
                    {
                    label: "",
                    backgroundColor:[
                    "rgba(54, 162, 255, 0.8)",
                    "rgba(255, 99, 132, 0.8)",
                    @php
                        if($total>=0){
                            @endphp
                                "rgba(54, 162, 255, 0.8)",
                            @php
                        }else{
                            @endphp  
                                "rgba(255, 99, 132, 0.8)",
                            @php
                        }
                    @endphp
                    ],
                    borderColor: "rgba(0,0,0,1)",
                    borderWidth: 2,
                    hoverBorderColor: "rgba(255,99,132,1)",
                    data: [
                        @php echo $totaldeposito @endphp,
                        @php echo $totalsaque @endphp,
                        @php echo $total @endphp,
                    ],
                    }
                ]
                };
                var option = {
                    animation: {
                        duration:5000
                    }
                };
                var option = {
                scales: {
                        yAxes: [{
                            ticks: {
                                //beginAtZero: true,
                                min: 0,
                                //stepSize: 10
                            },
                            scaleLabel: {
                            display: true,
                            labelString: "Escala de valores",
                            fontColor: "black"
                            }
                        }],
                        xAxes: [{
                            scaleLabel: {
                            display: true,
                            labelString: "Controle",
                            fontColor: "black"
                            }
                        }]
                    }
                };
                var myBarChart = Chart.Bar(canvas,{
                data:data,
                options:option
                });
                </script>
            </div>
            <div class="p-4 mb-3 bg-light rounded">
                <h4 class="fst-italic">About</h4>
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
    </div>
</div>

@endsection

