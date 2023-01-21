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
    <div class="col-md-12">
        <hr class="my-4">

        <article class="blog-post">
            <h3>Tabela de Usuário</h3>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-clientes" role="tabpanel" aria-labelledby="nav-clientes-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Detalhes</th>
                                    <th>Numero da Conta</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Email</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $users)
                                <tr>
                                    <td><a href="{{url("users/$users->id")}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M12 2.5a5.5 5.5 0 0 1 3.096 10.047 9.005 9.005 0 0 1 5.9 8.181.75.75 0 1 1-1.499.044 7.5 7.5 0 0 0-14.993 0 .75.75 0 0 1-1.5-.045 9.005 9.005 0 0 1 5.9-8.18A5.5 5.5 0 0 1 12 2.5ZM8 8a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z"></path></svg></a></td>
                                    <td>{{$users->numcc}}</td>
                                    <td>{{$users->name}}</td>
                                    <td>{{$users->cpf}}</td>
                                    <td>{{$users->email}}</td>
                                    <td><a href="{{url("users/$users->id/edit")}}">
                                        <button class="btn btn-primary">Editar</button></a></td>
                                    <td><a href="{{url("users/$users->id")}}" class="js-del">
                                        <button class="btn btn-danger">Deletar</button></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </article>

        <nav class="blog-pagination" aria-label="Pagination">
            {{$user->links()}}
        </nav>

        <hr class="my-4">

    </div>
</div>

@endsection

