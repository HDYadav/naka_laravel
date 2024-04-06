<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Twilio\Rest\Client;

class UserOtp extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'otp', 'expire_at'];
   // public $timestamps = false;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendSMS($receiverNumber)
    {
        $message = "Login OTP is ".$this->otp;
    
        try {
            
            $receiverNumber = '+91'.$receiverNumber;
            
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $clientRespose= $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]); 
    
        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }
    
}
