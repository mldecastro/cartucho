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
        <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="input-field">
                <input id="name" name="name" type="text" class="validate"
                    value="{{ isset($product->name) ? $product->name : '' }}">
                <label for="name">Nome</label>
            </div>
            <div class="input-field">
                <select name="category_id">
                    @if(isset($product->category->id))
                        <option value="{{ $product->category->id }}" disabled selected>{{ $product->category->name }}</option>
                    @else
                        <option value="" disabled selected>Selecione uma opção</option>
                    @endif
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <label>Materialize Select</label>
            </div>
            <div class="file-field input-field">
                <div class="btn">
                    <span>Carregar Imagem</span>
                    <input name="image" type="file">
                </div>
                <div class="file-path-wrapper">
                    <input type="text" class="file-path-wrapper">
                </div>
            </div>

            <a href="{{ route('products.index') }}" class="btn red">Cancelar</a>
            <button class="btn green right">Atualizar</button>
        </form>
    </div>
@endsection

