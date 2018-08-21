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
        <form action="{{ route('categories.update', $category->id) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="input-field">
                <input id="name" name="name" type="text" class="validate"
                    value="{{ isset($category->name) ? $category->name : '' }}">
                <label for="name">Nome</label>
            </div>

            <a href="{{ route('categories.index') }}" class="btn red">Cancelar</a>
            <button class="btn green right">Atualizar</button>
        </form>
    </div>
@endsection


