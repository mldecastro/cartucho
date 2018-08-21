<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic;

class ServiceController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRole(['admin']);

        $services = Service::where('deleted', '=', 'N')->orderBy('id', 'DESC')->paginate(5);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => '', 'title' => 'Serviços']
        ];

        return view('admin.services.index', compact('services', 'breadcrumbs'));
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
            ['url' => route('services.index'), 'title' => 'Serviços'],
            ['url' => '', 'title' => 'Cadastrar']
        ];

        return view('admin.services.create', compact('breadcrumbs'));
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
            'image' => 'required|image'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $name = time() . '.' . $image->getClientOriginalExtension();
            $url = 'images/uploads/services/';

            $image->move($url, $name);

            $croppedImage = ImageManagerStatic::make($url . $name)->resize(77, 51)
                ->save($url . 'cropped' . $name);

            $imageModel = Image::create(['url' => $url . $name]);
            $imageModel->file()->create(['url' => $url . 'cropped' . $name, 'size' => 'service']);
            $imageModel->service()->create(['name' => $request->name]);
        }

        return redirect()->route('services.index')
            ->with('success', 'Serviço cadastrado com sucesso.');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRole(['admin']);

        $service = Service::find($id);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => route('services.index'), 'title' => 'Serviços'],
            ['url' => '', 'title' => 'Atualizar']
        ];

        return view('admin.services.edit', compact('service', 'breadcrumbs'));
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

        $service = Service::find($id);
        $service->update($request->all());

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image'
            ]);

            $image = $request->image;
            $name = time() . '.' . $image->getClientOriginalExtension();
            $url = 'images/upload/services/';

            $image->move($url, $name);

            $croppedImage = ImageManagerStatic::make($url . $name)->resize(77, 51)
                ->save($url . 'cropped' . $name);

            $imageModel = Image::create(['url' => $url . $name]);
            $imageModel->file()->create(['url' => $url . 'cropped' . $name, 'size' => 'service']);

            $service->update(['image_id' => $imageModel->id]);
        }

        return redirect()->route('services.index')
            ->with('success', 'Serviço atualizado com sucesso.');
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

        Service::find($id)->update(['deleted' => 'Y']);

        return redirect()->route('services.index')
            ->with('success', 'Serviço deletado com sucesso.');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted(Request $request)
    {
        $request->user()->authorizeRole(['admin']);

        $services = Service::where('deleted', '=', 'Y')->orderBy('id', 'DESC')->paginate(5);
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => route('services.index'), 'title' => 'Serviços'],
            ['url' => '', 'title' => 'Deletados']
        ];

        return view('admin.services.deleted', compact('services', 'breadcrumbs'));
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

        Service::find($id)->update(['deleted' => 'N']);

        return redirect()->route('services.deleted')
            ->with('success', 'Serviço recuperado com sucesso.');
    }
}


