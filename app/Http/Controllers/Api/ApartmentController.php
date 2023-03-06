<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$apartments = Apartment::paginate(20);
        
        $apartments = Apartment::with('images' ,'services')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

            

        return response()->json($apartments);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        $apartment->load('services', 'images');

        return response()->json($apartment);
    }
}
