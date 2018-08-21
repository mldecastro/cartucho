<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRole(['admin']);

        $categories = Category::where('deleted', '=', 'N')->orderBy('id', 'DESC')->paginate(5);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => '', 'title' => 'Categorias']
        ];

        return view('admin.categories.index', compact('categories', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRole(['admin']);

        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => route('categories.index'), 'title' => 'Categorias'],
            ['url' => '', 'title' => 'Cadastrar']
        ];

        return view('admin.categories.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRole(['admin']);

        $this->validate($request, [
            'name' => 'required'
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('categories.index')
            ->with('success', 'Categoria cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProducts(Request $request, $id)
    {
        $request->user()->authorizeRole(['admin']);

        $category = Category::find($id);
        $products = $category->products()->orderBy('id', 'DESC')->paginate(5);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => route('categories.index'), 'title' => 'Categorias'],
            ['url' => '', 'title' => $category->name]
        ];

        return view('admin.categories.products', compact('products', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRole(['admin']);

        $category = Category::find($id);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => route('categories.index'), 'title' => 'Categorias'],
            ['url' => '', 'title' => 'Atualizar']
        ];

        return view('admin.categories.edit', compact('category', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->user()->authorizeRole(['admin']);

        $this->validate($request, [
            'name' => 'required'
        ]);

        Category::find($id)->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Categoria atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRole(['admin']);

        Category::find($id)->update(['deleted' => 'Y']);

        return redirect()->route('categories.index')
            ->with('success', 'Categoria deletada com sucesso.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted(Request $request)
    {
        $request->user()->authorizeRole(['admin']);

        $categories = Category::where('deleted', '=', 'Y')->orderby('id', 'DESC')->paginate(5);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => route('categories.index'), 'title' => 'Categorias'],
            ['url' => '', 'title' => 'Deletadas']
        ];

        return view('admin.categories.deleted', compact('categories', 'breadcrumbs'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function recovery(Request $request, $id)
    {
        $request->user()->authorizeRole(['admin']);

        Category::find($id)->update(['deleted' => 'N']);

        return redirect()->route('categories.index')
            ->with('success', 'Categoria recuperada com sucesso.');
    }
}


