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
                <td>Link</td>
                <td>Imagem</td>
                <td>Ação</td>
            </thead>
            <tbody>
                @foreach($partners as $partner)
                    <tr>
                        <td>{{ $partner->id }}</td>
                        <td>{{ $partner->name }}</td>
                        <td>{{ $partner->link }}</td>
                        <td><img width="50" class="materialboxed" src="{{ $partner->image->getUrl() }}"></td>
                        <td>
                            <form action="{{ route('partners.destroy', $partner->id) }}" method="post">
                                <a title="Atualizar" href="{{ route('partners.edit', $partner->id) }}" class="btn orange">
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
            <a href="{{ route('partners.create') }}" class="btn green">Cadastrar</a>
            <a href="{{ route('partners.deleted') }}" class="btn red">Deletados</a>
        </div>
    </div>

    <div align="center" class="row">
        {{ $partners->links() }}
    </div>
@endsection


