<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\ApartmentSubscription;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

//Da gestire l'autenticazione

class ApartmentController extends Controller
{

    public function index(){
        $apartments = Db::table("apartments")
            ->where("user_id",Auth::id())->get();
        
            return view("apartment.index", compact("apartments") );
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   

        $data = $request->all();
        // $data = $request->validate(
        //     [
        //         //'user_id' => 'required|exists:user,id',
        //         'title' => 'required|string',
        //         'address' => 'required|string',
        //         //'latitude' => 'required|nullable',
        //         //'longitude' => 'required|nullable',
        //         'cover_img' => 'file|image|nullable',
        //         'description' => 'string|max:1000',
        //         'rooms_qty' => 'required|integer',
        //         'beds_qty' => 'required|integer',
        //         'bathrooms_qty' => 'required|integer',
        //         'mq' => 'integer',
        //         'daily_price' => 'required|decimal:2',
        //         'visible' => 'nullable|boolean',
        //         'services' => 'nullable|array',
        //     ]
        // );

    

        if (key_exists('cover_img', $data)) {
            $path = Storage::put('apartment-img', $data['cover_img']);
        }

        

        $apartment = Apartment::create(
            [
                ...$data,
                'cover_img' => $path ?? null,
                'user_id' => Auth::id(),
                'latitude' => 20.34566,
                'longitude' => 92.34466,
            ]
        );

        if ($request->has("services")) {
            $apartment->services()->attach($data["services"]);
        }

        
    }

    public function show($id){
        $apartment = Apartment::findOrFail($id);

        return view("apartment.show", compact("apartment"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $apartment = Apartment::findOrFail($id);

        return view("apartment.edit", compact("apartment"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        // $data = $request->validate(
        //     [
        //         'user_id' => 'exists:users,id',
        //         'title' => 'string',
        //         'address' => 'string',
        //         'latitude' => 'nullabke',
        //         'longitude' => 'nullable',
        //         'cover_img' => 'file|image|nullable',
        //         'description' => 'string|max:1000',
        //         'rooms_qty' => 'integer',
        //         'beds_qty' => 'integer',
        //         'bathrooms_qty' => 'integer',
        //         'mq' => 'integer',
        //         'daily_price' => 'decimal:2',
        //         'visible' => 'nullable|boolean',
        //         'services' => 'nullable|array',
        //     ]
        // );


        if (key_exists('cover_img', $data)) {
            $path = Storage::put('apartment-img', $data['cover_img']);
        }

        $apartment = Apartment::findOrFail($id);


        $apartment->update([
            ...$data,
            'user_id' => Auth::id(),
            'latitude' => 20.34566,
            'longitude' => 92.34466,
            //"cover_img" => $path ?? $apartment->cover_img,
        ]);

         if ($request->has("services")) {
             $apartment->services()->sync($data["services"]);
         }

        return redirect()->route("apartment.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apartment = Apartment::findOrFail($id);

        if ($apartment->cover_img) {
            Storage::delete($apartment->cover_img);
        }

        $apartment->services()->detach();

        $apartment->delete();
    }

    public function add_subscription(Request $request, string $id)
    {

        $data = $request->validate([
            "subscription_id" => "exists:subscriptions,id"
        ]);

        // Per provare senza dati passati dal front-end
        // $id = 1;
        // $data = [];
        // $data["subscription_id"] = 6;

        $duration = DB::table("subscriptions")->select("duration")
            ->where("id", $data["subscription_id"])
            ->get();
    
        $exp_date = date("Y-m-d: H:i:s", strtotime("+{$duration[0]->duration} hours"));

        $apartment = Apartment::findOrFail($id);
        $apartment->subscriptions()->attach($data["subscription_id"]);

        DB::table("apartment_subscription")
            ->where("subscription_id", $data["subscription_id"])
            ->where("apartment_id", $id)
            ->update(["expiration_date" => $exp_date]);
    }
}
