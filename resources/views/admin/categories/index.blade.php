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
                <!--<td>Ação</td>-->
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                <a title="Atualizar" href="{{ route('categories.edit', $category->id) }}" class="btn orange">
                                    <i class="material-icons">mode_edit</i>
                                </a>
                                <a title="Ver Produtos" href="{{ route('categories.products', $category->id) }}" class="btn blue">
                                    <i class="material-icons">visibility</i>
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
            <a href="{{ route('categories.create') }}" class="btn green">Cadastrar</a>
            <a href="{{ route('categories.deleted') }}" class="btn red">Deletadas</a>
        </div>
    </div>

    <div align="center" class="row">
        {{ $categories->links() }}
    </div>
@endsection
