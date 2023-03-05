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
        $apartments = DB::table("apartments")
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return response()->json($apartments);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $apartment = Apartment::findOrFail($id);

        return response()->json($apartment);
    }
}
