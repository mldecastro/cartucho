<div id="tf-contact" class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="section-title center">
                    <h2>Entre em contato <strong>conosco</strong></h2>
                    <div class="line"></div>
                    <div class="clearfix"></div>
                    <small><em>Rua Pinheiro Machado, 713 - N. Sra. de Fátima - São Gotardo, MG</em></small>
                </div>

                <form action="{{ route('send') }}" method="post">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bodyMessage">Menssagem</label>
                        <textarea class="form-control" id="bodyMessage" name="bodyMessage" rows="3" placeholder="Digite sua mensage"></textarea>
                    </div>

                    <button class="btn tf-btn btn-default">Enviar</button>
                </form>

            </div>
        </div>

    </div>
</div>
