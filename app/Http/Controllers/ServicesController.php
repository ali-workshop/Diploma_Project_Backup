<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreServicesRequest;
use App\Http\Requests\UpdateServicesRequest;

class ServicesController extends Controller
{
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

        $new_service = new Service();
        $new_service->name = $request->name;
        $new_service->price = $request->price;
        $new_service->description = $request->description;
        $new_service->img = $request->img;

        $new_service->save();

        return redirect()->route('services.index');
        
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
        $service->img = $request->img;

        $service->save();
        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index');
    }
}
