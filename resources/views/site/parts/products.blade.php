<div id="tf-works">
    <div class="container">
        <div class="section-title text-center center">
            <h2>Dê uma olhada nos <strong>nossos produtos</strong></h2>
            <div class="line"></div>
            <div class="clearfix"></div>
        </div>
        <div class="space"></div>

        <div class="categories">
            <ul class="cat">
                <li class="pull-left"><h4>Filtrar por categoria:</h4></li>
                <li class="pull-right">
                    <ol class="type">
                        <li><a href="#" data-filter="*" class="active">Todos</a></li>
                        @foreach($categories as $category)
                            <li>
                                <a href="#" data-filter=".{{ strtolower($category->name) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div id="lightbox" class="row">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-3 col-lg-3 {{ strtolower($product->category->name) }}">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="#">
                                <div class="hover-text">
                                    <h4>{{ $product->name }}</h4>
                                    <small>{{ $product->category->name }}</small>
                                    <div class="clearfix"></div>
                                    <i class="fa fa-plus"></i>
                                </div>
                                <img src="{{ $product->image->file->getUrl() }}" class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


