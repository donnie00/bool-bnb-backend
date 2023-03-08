<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function userInfo()
    {

        //Recupera l'utente dall'Auth
        $user = Auth::user();

        //Recupera tutti gli appartamenti di quell'utente e lo converte in array
        $userApartments = Apartment::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get()->toArray();

        $messages = [];
        $totalMessages = 0;

        foreach ($userApartments as $apartment) {

            $apartmentId = $apartment['id'];
            $apartmentTitle = $apartment['title'];

            $message = Message::where('apartment_id', $apartmentId)->get()->toArray();

            if (count($message)) {
                $messages[$apartmentTitle] = $message;
                $totalMessages += count($message);
            }
        }

        return view('Admin.dashboard', compact('user', 'userApartments', 'messages', 'totalMessages'));
    }

    public function userMessages()
    {
    }
}