<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRole(['admin']);

        $products = Product::where('deleted', '=', 'N')->orderBy('id', 'DESC')->paginate(5);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => '', 'title' => 'Produtos']
        ];

        return view('admin.products.index', compact('products', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRole(['admin']);

        $categories = Category::where('deleted', '=', 'N')->get();
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => route('products.index'), 'title' => 'Produtos'],
            ['url' => '', 'title' => 'Cadastrar']
        ];

        return view('admin.products.create', compact('categories', 'breadcrumbs'));
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
            'category_id' => 'required',
            'name' => 'required',
            'image' => 'required|image'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $name = time() . '.' . $image->getClientOriginalExtension();
            $url = 'images/uploads/products/';

            $image->move($url, $name);

            $croppedImage = ImageManagerStatic::make($url . $name)->resize(660, 660)
                ->save($url . 'cropped' . $name);

            $imageModel = Image::create(['url' => $url . $name]);
            $imageModel->file()->create(['url' => $url . 'cropped' . $name, 'size' => 'product']);
            $imageModel->product()->create(['category_id' => $request->category_id, 'name' => $request->name]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Produto cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        $categories = Category::where('deleted', '=', 'N')->get();
        $product = Product::find($id);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => route('products.index'), 'title' => 'Produtos'],
            ['url' => '', 'title' => 'Atualizar']
        ];

        return view('admin.products.edit', compact('categories', 'product', 'breadcrumbs'));
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

        $product = Product::find($id);
        $product->update($request->all());

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image'
            ]);

            $image = $request->image;
            $name = time() . '.' . $image->getClientOriginalExtension();
            $url = 'images/uploads/products/';

            $image->move($url, $name);

            $croppedImage = ImageManagerStatic::make($url . $name)->resize(660, 660)
                ->save($url . 'cropped' . $name);

            $imageModel = Image::create(['url' => $url . $name]);
            $imageModel->file()->create(['url' => $url . 'cropped' . $name, 'size' => 'product']);

            $product->update(['image_id' => $imageModel->id]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Produto atualizado com sucesso.');
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

        Product::find($id)->update(['deleted' => 'Y']);

        return redirect()->route('products.index')
            ->with('success', 'Produto deletado com sucesso.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted(Request $request)
    {
        $request->user()->authorizeRole(['admin']);

        $products = Product::where('deleted', '=', 'Y')->orderBy('id', 'DESC')->paginate(5);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => route('products.index'), 'title' => 'Produtos'],
            ['url' => '', 'title' => 'Deletados']
        ];

        return view('admin.products.deleted', compact('products', 'breadcrumbs'));
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

        Product::find($id)->update(['deleted' => 'N']);

        return redirect()->route('products.index')
            ->with('success', 'Produto recuperado com sucesso.');        
    }
}


