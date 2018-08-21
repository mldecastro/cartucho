<div class="input-field">
    <input id="name" name="name" type="text" class="validate">
    <label for="name">Nome</label>
</div>

<div class="input-field">
    <select name="category_id">
        <option value="" disabled selected>Selecione uma opção</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <label>Categoria</label>
</div>

<div class="file-field input-field">
    <div class="btn">
        <span>Carregar Imagem</span>
        <input type="file" name="image">
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
    </div>
</div>


