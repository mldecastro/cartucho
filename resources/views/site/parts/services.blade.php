<div id="tf-team" class="text-center">
    <div class="overlay">
        <div class="container">
            <div class="section-title center">
                <h2>Conheça <strong>nossos serviços</strong></h2>
                <div class="line"></div>
            </div>

            <div id="team" class="owl-carousel owl-theme row">
                @foreach($services as $service)
                    <div class="item">
                        <div class="thumbnail">
                            <img src="{{ $service->image->getUrl() }}" alt="" class="img-circle team-img">
                            <div class="caption">
                                <h3>{{ $service->name }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


