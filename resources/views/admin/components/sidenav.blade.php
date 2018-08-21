<ul id="slide-out" class="side-nav fixed">
    <li>
        <div class="user-view">
            <div class="background {{ config('app.dashboardColor') }}"></div>
            <a href="{{ route('dashboard') }}"><img width="250" src="{{ asset('images/logo.png') }}"></a>
            <a><span class="white-text name">{{ Auth::user()->name }}</span></a>
            <a><span class="white-text email">{{ Auth::user()->email }}</span></a>

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <span class="white-text email">Sair</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

        </div>
    </li>
    <li><a href="{{ route('dashboard') }}"><i class="material-icons">dashboard</i>Dashboard</a></li>
    <li><a href="{{ route('help') }}"><i class="material-icons">book</i>Manual</a></li>
    <li><a href="{{ route('services.index') }}"><i class="material-icons">build</i>Serviços</a></li>
    <li><a href="{{ route('categories.index') }}"><i class="material-icons">apps</i>Categorias</a></li>
    <li><a href="{{ route('products.index') }}"><i class="material-icons">add_shopping_cart</i>Produtos</a></li>
    <li><a href="{{ route('partners.index') }}"><i class="material-icons">group     </i>Parceiros</a></li>
    <li><a href="{{ route('site') }}" class="center-align">Ver Site</a></li>
</ul>

<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
