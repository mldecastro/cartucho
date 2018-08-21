<div id="tf-clients" class="text-center">
    <div class="overlay">
        <div class="container">

            <div class="section-title center">
                <h2>Conheça <strong>nossos parceiros</strong></h2>
                <div class="line"></div>
            </div>
            <div id="clients" class="owl-carousel owl-theme">
                @foreach($partners as $partner)
                    <div class="item">
                        <img src="{{ $partner->image->file->getUrl() }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


