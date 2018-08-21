<div class="row">
    <nav>
        <div class="nav-wrapper {{ config('app.dashboardColor') }}">
            <div class="col s12">
                @if(isset($breadcrumbs))
                    @foreach($breadcrumbs as $breadcrumb)
                        @if($breadcrumb['url'])
                            <a href="{{ $breadcrumb['url'] }}" class="breadcrumb">{{ $breadcrumb['title'] }}</a>
                        @else
                            <span class="breadcrumb">{{ $breadcrumb['title'] }}</span>
                        @endif
                    @endforeach
                @else
                    <span class="breadcrumb">Dashboard</span>
                @endif
            </div>
        </div>
    </nav>
</div>


