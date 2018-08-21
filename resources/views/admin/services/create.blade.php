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
        <form action="{{ route('services.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            @include('admin.services._form')

            <a href="{{ route('services.index') }}" class="btn red">Cancelar</a>
            <button class="btn green right">Cadastrar</button>
        </form>
    </div>
@endsection


