@extends('layouts.dashboard')

@section('content')
    @include('admin.components.breadcrumbs')

    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header active"><i class="material-icons">dashboard</i>Dashboard</div>
            <div class="collapsible-body"><span>Nesta seção você tem uma lista dos recursos que podem ser gerenciados em seu site. O cartão "Visitas" informa o número de acessos ao seu site.</span></div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">build</i>Serviços</div>
            <div class="collapsible-body"><span>Os serviços cadastrados aparecerão em uma seção específica do seu site. Você pode atualizar, deletar e recuperar registros deletados.</span></div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">apps</i>Categorias</div>
            <div class="collapsible-body"><span>As categorias cadastradas podem ser atualizadas, deletadas e recuperadas. Uma categoria possui mais de um produto. Em uma seção espsecífica do seu site, seus produtos podem ser filtrados pelas categorias.</span></div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">add_shopping_cart</i>Produtos</div>
            <div class="collapsible-body"><span>Os produtos cadastrados aparecerão em uma seção específica do seu site. Vocô pode atualizar, deletar e recuperar registros deletados. Um produto possui uma categoria. Os produtos são listados por categoria na seção "Categorias" deste painel.</span></div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">group</i>Parceiros</div>
            <div class="collapsible-body"><span>Os parceiros cadastrados aparecerão em uma seção específica do seu site. Você pode atualizar, deletar e recuperar registros deletados.</span></div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">place</i>Ver Site</div>
            <div class="collapsible-body"><span>Veja seu site!</span></div>
        </li>
    </ul>

    <a href="{{ route('dashboard') }}" class="btn blue">Voltar</a>
@endsection


