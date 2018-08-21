@extends('layouts.dashboard')

@section('content')
    @include('admin.components.breadcrumbs')

    <div class="row">
        <div class="col s6">
            <div class="card blue-grey darken-2">
                <div class="card-content white-text">
                    <span class="card-title">Serviços</span>
                    <p>Você tem {{ $serviceQty }} serviços cadastrados</p>
                </div>
                <div class="card-action">
                    <a href="{{ route('services.index') }}">Gerenciar</a>
                </div>
            </div>
        </div>

        <div class="col s6">
            <div class="card blue-grey darken-2">
                <div class="card-content white-text">
                    <span class="card-title">Categorias</span>
                    <p>Você tem {{ $categoryQty }} categorias cadastradas</p>
                </div>
                <div class="card-action">
                    <a href="{{ route('categories.index') }}">Gerenciar</a>
                </div>
            </div>
        </div>

        <div class="col s6">
            <div class="card blue-grey darken-2">
                <div class="card-content white-text">
                    <span class="card-title">Produtos</span>
                    <p>Você tem {{ $productQty }} produtos cadastrados</p>
                </div>
                <div class="card-action">
                    <a href="{{ route('products.index') }}">Gerenciar</a>
                </div>
            </div>
        </div>

        <div class="col s6">
            <div class="card blue-grey darken-2">
                <div class="card-content white-text">
                    <span class="card-title">Parceiros</span>
                    <p>Você tem {{ $partnerQty }} parceiros cadastrados</p>
                </div>
                <div class="card-action">
                    <a href="{{ route('partners.index') }}">Gerenciar</a>
                </div>
            </div>
        </div>

        <div class="col s6">
            <div class="card blue-grey darken-2">
                <div class="card-content white-text">
                    <span class="card-title">Visitas</span>
                    @if($visitQty > 0)
                        <p>Seu site tem {{ $visitQty }} visitas</p>
                    @else
                        <p>Seu site não tem nenhuma visita</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
