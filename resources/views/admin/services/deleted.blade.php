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
                            <form action="{{ route('services.recovery', $service->id) }}" method="post">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}

                                <button title="Recuperar" class="btn green">
                                    <i class="material-icons">restore</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
        <a href="{{ route('services.index') }}" class="btn blue left">Voltar</a>
    </div>

    <div align="center" class="row">
        {{ $services->links() }}
    </div>
@endsection


