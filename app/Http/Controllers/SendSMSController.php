<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
 
 
class SendSMSController extends Controller
{
    public function index()
    {
        $basic  = new \Vonage\Client\Credentials\Basic("d46e5fed", "HiSyN8vuJ3OJw3iF");
        $client = new \Vonage\Client($basic); 
        
        $response = $client->message()->send([
            'to' => '8801318948051',
            'from' => 'Rajiur',
            'text' => 'A text message sent using the Nexmo SMS API'
        ]);
        
 
        dd('message send successfully');
    }
}