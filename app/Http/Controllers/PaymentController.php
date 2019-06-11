<?php

namespace App\Http\Controllers;

use App\Notifications\InvoicePaid;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use PayPal\Api\PaymentExecution;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use Paypal\Api\Address;
use PayPal\Api\BillingInfo;
use PayPal\Api\Cost;
use PayPal\Api\Currency;
use PayPal\Api\InvoiceAddress;
use PayPal\Api\InvoiceItem;
use PayPal\Api\MerchantInfo;
use PayPal\Api\PaymentTerm;
use PayPal\Api\Phone;
use PayPal\Api\ShippingInfo;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Invoice;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
Use Alert;
use Session;
use App\PaymentPaypal;
use GuzzleHttp\Client;
use Auth;



class PaymentController extends Controller
{
    private $apiContext;
    private $secret;
    private $clientId;

    public function __construct()
    {
        if(config('paypal.settings.mode') == 'live')
        {
            $this->clientId = config('paypal.live_client_id');
            $this->secret = config('paypal.live_secret');
        }
        else
        {
            $this->clientId = config('paypal.sandbox_client_id');
            $this->secret = config('paypal.sandbox_secret');
        }
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->clientId,$this->secret));
        $this->apiContext -> setConfig(config('paypal.settings'));
    }

    function payWithPaypal(Request $request)
    {
        if($request->select_credit_wallet == env('PARENT_WALLET'))
        {
            alert()->error('Impossible to credit master wallet through Paypal')->showConfirmButton('Ok', '#3085d6');
            return \Redirect::back()->withStatus('Form submitted!');
        }
        $cprice = $request->input('CurrencyPrice');
        $clistMotto = $request->input('listMotto');
        $scPrice = $request->input('ScPrice');
        $description = $scPrice.' SC costs '.$cprice . ' '.$clistMotto;
        Session::put('selectedWallet', $request->select_credit_wallet);
        Session::put('ScPrice',$scPrice);
        //Créer un payeur
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        //Un item
        $item = new Item();
        $item->setName('SupCash') //ajouter le nom de l'item
            ->setCurrency($clistMotto)
            ->setQuantity(1)
            ->setSku(uniqid())
            ->setDescription($description)
            ->setSku(uniqid())
            ->setPrice($cprice);
        //liste des items
        $itemList = new ItemList();
        $itemList->setItems([$item]);
        //détails
        /*$details = new Details();
        $details->setTax(1.3);
        */

        //montant
        $amount = new Amount();
        $amount->setCurrency($clistMotto)
            ->setTotal($cprice);
//            ->setDetails($details);

        //transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($description)
            ->setInvoiceNumber(uniqid());

        //Redirection
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl('http://supbank.fr/status')
             ->setCancelUrl('http://supbank.fr/canceled');

        //Paiement
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try{
            $payment->create($this->apiContext);
        }catch (\Exception $exception){
            alert()->error('Impossible to buy as much Supcash')->showConfirmButton('Ok', '#3085d6');
            return \Redirect::back()->withStatus('Form submitted!');
        }
            $paymentlink =  $payment->getApprovalLink();
        return redirect($paymentlink);
    }

    public function status(Request $request)
    {
        if(empty($request->input('PayerID')) || empty($request->input('token')))
        {
            alert()->error('Payment failed','Please try again')->showConfirmButton('Ok', '#3085d6');
            return redirect()->back();
        }
        $paymentId = $request->get('paymentId');
        $payment = Payment::get($paymentId,$this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));

        $result = $payment->execute($execution,$this->apiContext);
        $invoice_number = $payment->transactions[0]->invoice_number; //Numéro de facture : $invoice_number
        $currencyInvoice = $payment->transactions[0]->amount->currency;
        $num_transaction = $result->transactions[0]->related_resources[0]->sale->id;
        $user = Auth::user();
        if($result->getState() == 'approved')
        {
            $client = new Client();
            $response = $client->post('xcvbn.co:11180/getSolde.php', [
                'form_params' => [
                    'idWallet' => config('app.wallet_parent_id')
                ]
            ]);
            $wallet_parent_currency = json_decode($response->getBody()->getContents());

            if((Session::get('ScPrice')) < $wallet_parent_currency) //Si la transaction est possible
            {
                include(app_path() . '/traduire.php');
                $signature = json_decode(traduireSign(config('app.wallet_parent_id'),Session::get('selectedWallet'),Session::get('ScPrice'),(Session::get('ScPrice')/1000)));
                $signature = $signature->signature;

                $client->post('xcvbn.co:11180/createTransaction.php', [
                    'form_params' => [
                        'emmeteur' => config('app.wallet_parent_id'),
                        'recepteur'=>Session::get('selectedWallet'),
                        'signature' => $signature,
                        'taxe' => Session::get('ScPrice')/1000,
                        'montant' =>Session::get('ScPrice')
                    ]
                ]);
                //Créer une facture et l'envoyer à l'utilisateur
                $invoice = $this->generateInvoice(Session::get('ScPrice'),$currencyInvoice);
                $user->notify(new InvoicePaid($invoice->getId()));

                //Créer un enregistrement pour la facture en bdd
                $paymentPaypal = PaymentPaypal::create([
                    'id_user' => Auth::id(),
                    'reference' => $num_transaction,
                    'bill' => $invoice_number,
                    'bill_number' => $invoice->number,
                    'amount_sc' => Session::get('ScPrice'),

                ]);
                $paymentPaypal->save();
                Session::forget('selectedWallet');
                Session::forget('ScPrice');
                alert()->success('Purchase made successfuly')->showConfirmButton('Ok', '#3085d6');
                return \Redirect::back()->withStatus('Form submitted!');

            }
            else
            {
                Session::forget('selectedWallet');
                Session::forget('ScPrice');
                alert()->error('Unable to buy as much Supcash')->showConfirmButton('Ok', '#3085d6');
                return \Redirect::back()->withStatus('Form submitted!');

            }
        }
        Session::forget('selectedWallet');
        Session::forget('ScPrice');
        alert()->error('Payment went wrong','Please try again')->showConfirmButton('Ok', '#3085d6');
        return redirect()->back();
    }
    public function canceled()
    {
        Session::forget('selectedWallet');
        Session::forget('ScPrice');
        alert()->error('Payment canceled','Please try again')->showConfirmButton('Ok', '#3085d6');
        return redirect()->back();
    }

    public function generateInvoice($scQuantity,$setCurrency)
    {
        $valueInvoice = $setCurrency == "EUR" ? 36 : 41;
        $invoice = new Invoice();
// ### Invoice Info
// Fill in all the information that is
// required for invoice APIs
        $invoice
            ->setMerchantInfo(new MerchantInfo())
            ->setBillingInfo(array(new BillingInfo()))
            ->setNote("SupBank Invoice ".date("F j, Y, g:i a"))
            ->setPaymentTerm(new PaymentTerm())
            ->setShippingInfo(new ShippingInfo());
// ### Merchant Info
// A resource representing merchant information that can be
// used to identify merchant
        $invoice->getMerchantInfo()
            ->setEmail("hamzanacirifarid-facilitator@gmail.com")
            ->setFirstName("Supbank")
            ->setLastName("Team")
            ->setbusinessName("SupBank")
            ->setPhone(new Phone())
            ->setAddress(new Address());
        $invoice->getMerchantInfo()->getPhone()
            ->setCountryCode("0033")
            ->setNationalNumber("5032141716");
// ### Address Information
// The address used for creating the invoice
        $invoice->getMerchantInfo()->getAddress()
            ->setLine1("15 Boulevard de la liberté")
            ->setCity("France")
            ->setState("FR")
            ->setPostalCode("59000")
            ->setCountryCode("FR");
// ### Billing Information
// Set the email address for each billing
        $billing = $invoice->getBillingInfo();
        $billing[0]
            ->setEmail(Auth::user()->email);
        $billing[0]->setBusinessName(Auth::user()->user_address);
// ### Items List
// You could provide the list of all items for
// detailed breakdown of invoice
        $items = array();
        $items[0] = new InvoiceItem();
        $items[0]
            ->setName("SupCash")
            ->setQuantity($scQuantity)
            ->setUnitPrice(new Currency());
        $items[0]->getUnitPrice()
            ->setCurrency($setCurrency)
            ->setValue($valueInvoice);
        $invoice->setItems($items);
// #
        $invoice->getPaymentTerm()
            ->setTermType("NO_DUE_DATE");

// ### Logo
// You can set the logo in the invoice by providing the external URL pointing to a logo
        $invoice->setLogoUrl('https://image.noelshack.com/fichiers/2019/22/4/1559222881-favicon.png');
// For Sample Purposes Only.
        $request = clone $invoice;
//        try {
        // ### Create Invoice
        // Create an invoice by calling the invoice->create() method
        // with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
        $invoice->create($this->apiContext);
//        } catch (Exception $ex) {
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//            ResultPrinter::printError("Create Invoice", "Invoice", null, $request, $ex);
//            exit(1);
//        }
// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//        ResultPrinter::printResult("Create Invoice", "Invoice", $invoice->getId(), $request, $invoice);
        $linkToSend = $invoice->links[1]->href;
        $invoiceId = $invoice->id;
        $client = new Client();


        $response = $client->post('https://api.sandbox.paypal.com/v1/oauth2/token', [
                'auth'    => [
                    $this->clientId,
                    $this->secret
                ],
                'form_params' => [
                    "grant_type"=>"client_credentials",
                ]
            ]
        );

        $jsonOauth = json_decode($response->getBody()->getContents());
        $accessToken = $jsonOauth->access_token;
        //Passer la facture de "brouillon" à "facture"
        $client->post($linkToSend, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]
        );

        //Passer la facture à l'état payée :

        $client->post('https://api.sandbox.paypal.com/v2/invoicing/invoices/'.$invoiceId.'/payments', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken
                ],

                'json' => [
                    'method'=>'PAYPAL',
                    'payment_date' =>date("Y-m-d"),
                    'amount' => [
                        'currency_code' => $setCurrency,
                        'value' => $invoice->total_amount->value,
                    ],

                ]
            ]
        );
        return $invoice;
    }

}

