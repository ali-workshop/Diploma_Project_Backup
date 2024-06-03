<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServicesRequest;
use App\Http\Requests\UpdateServicesRequest;
use App\Traits\UploadImageTrait;

class ServicesController extends Controller
{
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('Admin.pages.dashboard.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.pages.dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicesRequest $request)
    {
        $request->validated();
        $path = $this->storeImage($request->file('img'), 'services');

        if ($path) {
            Service::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'img' => $path,
            ]);
            return redirect()->route('services.index');
        }
        return redirect()->back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('Admin.pages.dashboard.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('Admin.pages.dashboard.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicesRequest $request, Service $service)
    {
        $request->validated();

        $service->name = $request->name;
        $service->price = $request->price;
        $service->description = $request->description;
  
        if ($request->hasFile('img')) {
            $path = $this->storeImage($request->file('img'), 'services');

            if ($path) {
                $this->deleteImage($service->img);
                $service->img = $path;
            } else {
                return redirect()->back();
            }
        }

        $service->save();
        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $this->deleteImage($service->img);
        $service->delete();

        return redirect()->route('services.index');
    }
}