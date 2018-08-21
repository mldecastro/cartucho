<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRole(['admin']);

        $partners = Partner::where('deleted', '=', 'N')->orderBy('id', 'DESC')->paginate(5);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => '', 'title' => 'Parceiros']
        ];

        return view('admin.partners.index', compact('partners', 'breadcrumbs'));
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
            ['url' => route('partners.index'), 'title' => 'Parceiros'],
            ['url' => '', 'title' => 'Cadastrar']
        ];

        return view('admin.partners.create', compact('breadcrumbs'));
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
            'name' => 'required',
            'link' => 'required',
            'image' => 'required|image'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $name = time() . '.' . $image->getClientOriginalExtension();
            $url = 'images/uploads/partners/';

            $image->move($url, $name);

            $croppedImage = ImageManagerStatic::make($url . $name)->resize(77, 51)
                ->save($url . 'cropped' . $name);

            $imageModel = Image::create(['url' => $url . $name]);
            $imageModel->file()->create(['url' => $url . 'cropped' . $name, 'size' => 'partner']);
            $imageModel->partner()->create(['name' => $request->name, 'link' => $request->link]);
        }

        return redirect()->route('partners.index')
            ->with('success', 'Parceiro cadastrado com sucesso.');
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

        $partner = Partner::find($id);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => route('partners.index'), 'title' => 'Parceiros'],
            ['url' => '', 'title' => 'Atualizar']
        ];

        return view('admin.partners.edit', compact('partner', 'breadcrumbs'));
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
            'name' => 'required',
            'link' => 'required'
        ]);

        $partner = Partner::find($id);
        $partner->update($request->all());

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image'
            ]);

            $image = $request->image;
            $name = time() . '.' . $image->getClientOriginalExtension(77, 51);
            $url = 'images/upload/partners/';

            $image->move($url, $name);

            $croppedImage = ImageManagerStatic::make($url . $name)->resize()
                ->save($url . 'cropped' . $name);

            $imageModel = Image::create(['url' => $url . $name]);
            $imageModel->file()->create(['url' => $url . 'cropped' . $name, 'size' => 'partner']);

            $partner->update(['image_id' => $imageModel->id]);
        }

        return redirect()->route('partners.index')
            ->with('success', 'Parceiro atualizado com sucesso.');
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

        Partner::find($id)->update(['deleted' => 'Y']);

        return redirect()->route('partners.index')
            ->with('success', 'Parceiro deletado com sucesso.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted(Request $request)
    {
        $request->user()->authorizeRole(['admin']);

        $partners = Partner::where('deleted', '=', 'Y')->orderBy('id', 'DESC')->paginate(5);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => route('partners.index'), 'title' => 'Parceiros'],
            ['url' => '', 'title' => 'Deletados']
        ];

        return view('admin.partners.deleted', compact('partners', 'breadcrumbs'));
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

        Partner::find($id)->update(['deleted' => 'N']);

        return redirect()->route('partners.index')
            ->with('success', 'Parceiro recuperado com sucesso.');
    }
}


