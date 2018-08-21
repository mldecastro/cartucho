@extends('layouts.dashboard')

@section('content')
    @include('admin.components.breadcrumbs')

    @if(count($errors) > 0)
        <div class="row">
            <div class="col s12">
                <div class="card red darken-2">
                    <div class="card-content white-text">
                        <span class="card-title">Erros</span>
                        @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <table>
            <thead>
                <td>#</td>
                <td>Nome</td>
                <td>Imagem</td>
                <td>Ação</td>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->name }}</td>
                        <td><img width="50" class="materialboxed" src="{{ $service->image->getUrl() }}"></td>
                        <td>
                            <form action="{{ route('services.destroy', $service->id) }}" method="post">
                                <a title="Atualizar" href="{{ route('services.edit', $service->id) }}" class="btn orange">
                                    <i class="material-icons">mode_edit</i>
                                </a>

                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}

                                <button title="Deletar" class="btn red">
                                    <i class="material-icons">delete</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
        <a href="{{ route('dashboard') }}" class="btn blue left">Voltar</a>
        <div class="right">
            <a href="{{ route('services.create') }}" class="btn green">Cadastrar</a>
            <a href="{{ route('services.deleted') }}" class="btn red">Deletados</a>
        </div>
    </div>

    <div align="center" class="row">
        {{ $services->links() }}
    </div>
@endsection


