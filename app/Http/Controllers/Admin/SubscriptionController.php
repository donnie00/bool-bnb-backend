<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    //funzione che restiuisce il form di abbonamento
    public function subsForm(Request $request, $id ){
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $token = $gateway->ClientToken()->generate();

        $subs = Subscription::all()->toArray();

        $data = [
            ...$subs,
        ];

        $apartmentID = $id;

        return view("subsForm", compact(["data","token","apartmentID"]));
    }

    //funzione richiamata al submit del form di pagamento 
    public function subsAdd(Request $request){
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
    
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => 'Tony',
                'lastName' => 'Stark',
                'email' => 'tony@avengers.com',
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
    
        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);
            
            $subID = DB::table("subscriptions")->select("id")->where("price", $request->amount)->get()[0]->id;

            
            $apartment = Apartment::find($request->apartmentID);
            $apartment->subscriptions()->attach($subID);

            return back()->with('success_message', 'Transaction successful. The ID is:' . $transaction->id);
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: ' . $result->message);
        }
    }
}
