<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\ApartmentSubscription;
use App\Models\Subscription;
use Illuminate\Http\Request;
use DateTime;

class SubscriptionController extends Controller
{
    //funzione che restiuisce il form di abbonamento
    public function subsForm(Request $request, $id)
    {
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

        return view("subsForm", compact(["data", "token", "apartmentID"]));
    }

    //funzione richiamata al submit del form di pagamento
    public function subsAdd(Request $request)
    {
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

            $sub = Subscription::where("price", $request->amount)->get();
            $subDuration = $sub[0]->duration;

            $apartment = Apartment::find($request->apartmentID);

            $subs = ApartmentSubscription::where('apartment_id', $apartment->id)->orderBy('created_at', 'DESC')->get();

            //controlli se l'appartamento ha mai avuto delle subs
            if (count($subs)) {
                //Recuperi la data di sub più recente
                $lastSubExpDate = $subs[0]->expiration_date;

                $today = date("Y-m-d");
                $today_dt = new DateTime($today);
                $expire_dt = new DateTime($lastSubExpDate);

                //controllo che la data sia maggiore della data di oggi per vedere se è scaduta
                if ($expire_dt >= $today_dt) {
                    //Sommo la durata della sub alla data più recente per cumularla
                    $new_exp_date = date("Y-m-d: H:i:s", strtotime($lastSubExpDate . "+{$subDuration} hours"));
                }
            } else {
                //Se la data dell'ultima sub è passata, creo la nuova data sommando la durata alla data attuale
                $new_exp_date = date("Y-m-d: H:i:s", strtotime("+{$subDuration} hours"));
            }

            $apartment->subscriptions()->attach($sub, ["expiration_date" => $new_exp_date]);
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
