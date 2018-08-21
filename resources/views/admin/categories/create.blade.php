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
        <form action="{{ route('categories.store') }}" method="post">
            {{ csrf_field() }}

            @include('admin.categories._form')

            <a href="{{ route('categories.index') }}" class="btn red">Cancelar</a>
            <button class="btn green right">Cadastrar</button>
        </form>
    </div>
@endsection


