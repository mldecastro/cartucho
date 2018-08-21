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
                <td>Categoria</td>
                <td>Imagem</td>
                <td>Ação</td>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td><img width="50" class="materialboxed" src="{{ $product->image->getUrl() }}"></td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                <a title="Atualizar" href="{{ route('products.edit', $product->id) }}" class="btn orange">
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
        <a href="{{ route('categories.index') }}" class="btn blue left">Voltar</a>
    </div>

    <div align="center" class="row">
        {{ $products->links() }}
    </div>
@endsection


