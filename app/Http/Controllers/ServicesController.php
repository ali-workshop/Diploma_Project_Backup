<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Traits\UploadImageTrait;
use App\Http\Requests\StoreServicesRequest;
use App\Http\Requests\UpdateServicesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServicesController extends Controller
{
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $services = Service::all();
            return view('Admin.pages.dashboard.services.index', compact('services'));
        } catch (\Exception $e) {
            Log::error('Error in ServicesController@index: ' . $e->getMessage());
            return redirect()->route('Admin.pages.dashboard.services.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
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
    // public function store(Request $request)
    // {

    //         // Check if there is an image in the session and use it if exist
    //         if ($request->session()->has('img')) {
    //             $img = $request->session()->get('img');
    //             $request->session()->put('img', $img);
            
    //         } elseif ($request->hasFile('img')) {
    //             // Store image in session to avoid re-upload if there's a validation error
    //             $img = $request->file('img');
    //             session()->put('img', $img);
    //         }

    //         $request->validate([
    //             'name' => 'required|string|max:100|regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9\s\-]+$/',
    //             'price' => 'required|numeric|between:0,9999.99',
    //             'description' => 'required|string|max:800|regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9\s\-]+$/',
    //             'img' => 'required|image|mimes:jpg,png,jpeg,gif',
    //         ]);
    //         dd($request);

    //         try {

    //         if ($request->session()->get('img')) {
    //             $path = $this->storeImage($request->session()->get('img'), 'services');
    //             if ($path) {
    //                 Service::create([
    //                     'name' => $request->name,
    //                     'price' => $request->price,
    //                     'description' => $request->description,
    //                     'img' => $path,
    //                 ]);

    //                 // Clearing the image from the session after saving the new service
    //                 $request->session()->forget('img');

    //                 return redirect()->route('services.index')->with('success', 'Service created successfully!');
    //             }
    //             return redirect()->back()->with('error', 'Failed! Image was not stored.');
    //         }   
    //     } catch (\Exception $e) {
    //         Log::error('Error in ServicesController@store: ' . $e->getMessage());
    //         return redirect()->route('services.index')
    //             ->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }

  
    // public function store(Request $request)
    // {
    //     // Validate request
    //     $request->validate([
    //         'name' => 'required|string|max:100|regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9\s\-]+$/',
    //         'price' => 'required|numeric|between:0,9999.99',
    //         'description' => 'required|string|max:800|regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9\s\-]+$/',
    //         'img' => 'required|image|mimes:jpg,png,jpeg,gif',
    //     ]);
    
    //     // Check for image in the session
    //     $imgPath = $request->session()->get('img_path', null);
    //     if ($request->hasFile('img')) {
    //         // Store image in session to avoid re-upload if there's a validation error
    //         $img = $request->file('img');
    //         $imgPath = $img->store('temporary', 'public'); // Store image temporarily
    //         $request->session()->put('img_path', $imgPath);
    //     }
    
    //     try {
    //         // Store the image permanently if available
    //         if ($imgPath) {
    //             $imgFullPath = storage_path('app/public/' . $imgPath); // Get full path for temporary image
    //             $permanentPath = $this->storeImage(new \Illuminate\Http\File($imgFullPath), 'services');
    //             if ($permanentPath) {
    //                 Service::create([
    //                     'name' => $request->name,
    //                     'price' => $request->price,
    //                     'description' => $request->description,
    //                     'img' => $permanentPath,
    //                 ]);
    
    //                 // Clear the image from the session after saving the new service
    //                 $request->session()->forget('img_path');
    
    //                 return redirect()->route('services.index')->with('success', 'Service created successfully!');
    //             }
    //             return redirect()->back()->with('error', 'Failed! Image was not stored.');
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error in ServicesController@store: ' . $e->getMessage());
    //         return redirect()->route('services.index')
    //             ->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }
    
//     public function store(Request $request)
// {
//     // Validate the form data
//     $validatedData = $request->validate([
//         'name' => 'required|string|max:100|regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9\s\-]+$/',
//         'price' => 'required|numeric|between:0,9999.99',
//         'description' => 'required|string|max:800|regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9\s\-]+$/',
//         'img' => 'required|image|mimes:jpg,png,jpeg,gif',
//     ]);

//     // Check if there is an image in the session and use it if it exists
//     if ($request->session()->has('temp_img')) {
//         $imgPath = $request->session()->get('temp_img');
//     } elseif ($request->hasFile('img')) {
//         // Store image in session to avoid re-upload if there's a validation error
//         $img = $request->file('img');
//         $imgPath = $img->storeAs('temp', time().'.'.$img->getClientOriginalExtension());
//         $request->session()->put('temp_img', $imgPath);
//     }

//     try {
//         if ($request->session()->get('temp_img')) {
//             $path = $this->storeImage($request->session()->get('temp_img'), 'services');
//             if ($path) {
//                 Service::create([
//                     'name' => $request->name,
//                     'price' => $request->price,
//                     'description' => $request->description,
//                     'img' => $path,
//                 ]);

//                 // Clearing the image from the session after saving the new service
//                 $request->session()->forget('temp_img');

//                 return redirect()->route('services.index')->with('success', 'Service created successfully!');
//             }
//             return redirect()->back()->with('error', 'Failed! Image was not stored.')->withInput();
//         }   
//     } catch (\Exception $e) {
//         Log::error('Error in ServicesController@store: ' . $e->getMessage());
//         return redirect()->route('services.index')
//             ->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
//     }
// }
public function store(StoreServicesRequest $request)
{
    try {
        // Store image in session before validation to avoid re-upload it if there is any validation error
        // if ($request->hasFile('img')) {
        //     $request->session()->put('img', $request->file('img'));
        // }

        $request->validated();
        $path = $this->storeImage($request->file('img'), 'services');

        if ($path) {
            Service::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'img' => $path,
            ]);
            // Clear the image from the session after save the new service
            // $request->session()->forget('img');
            
            return redirect()->route('services.index')->with('success', 'Service created successfully!');
        }
        return redirect()->back()->with('error', 'Failed!. Image was not stored');
    } catch (\Exception $e) {
        Log::error('Error in ServicesController@store: ' . $e->getMessage());
        return redirect()->route('services.index')->with('error', 'An error occurred: ' . $e->getMessage());
    }
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
        try {
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
                    return redirect()->back()->with('error', 'Failed to upload image.');
                }
            }
            $service->save();
            return redirect()->route('services.index')->with('success', 'Service updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error in ServicesController@update: ' . $e->getMessage());
            return redirect()->route('Admin.pages.dashboard.services.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        try {
            $this->deleteImage($service->img);
            $service->delete();

            return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error in ServicesController@destroy: ' . $e->getMessage());
            return redirect()->route('Admin.pages.dashboard.services.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
