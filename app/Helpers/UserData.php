<?php 

namespace App\Helpers;

 
use Illuminate\Support\Facades\DB;
 

class UserData
{ 

        public static function getUserFrToken($request)
        { 
                $access_token = $request->header('Authorization');

                $auth_header = explode(' ', $access_token);
                $token = $auth_header[1];
                $token_parts = explode('.', $token);
                $token_header = $token_parts[1];
                $token_header_json = base64_decode($token_header);
                $token_header_array = json_decode($token_header_json, true);
                $token_id = $token_header_array['jti'];
                $data =  DB::table('oauth_access_tokens')->where('id', $token_id)->select('user_id')->first();

                return  Self::getUserData($data->user_id);
        }

        private static function getUserData($user_id)
        {
                return  DB::table('users as u')->where('u.id', $user_id)->select('u.id','u.name','u.email','u.mobile')->first();
        }




        public static function sendMail($template_name,$name=null,$company_name=null,$user_email=null, $user_password=null)
        {

                $query = DB::table('email_templates')->where('name', $template_name)->select('subject', 'message')->first();

                $message = $query->message;
                $subject = $query->subject;

                $replacements = [
                        '{user_name}' => $name,
                        '{company_name}' => $company_name,
                        '{user_email}' => $user_email,
                        '{user_password}' => $user_password,
                ];

                // Replace placeholders with actual values
                $updatedMessage = str_replace(array_keys($replacements), array_values($replacements), $message);

                // Output the updated message
             $collect =    collect(['message'=>$updatedMessage,'subject'=>$subject]);
             return  $collect;
        }


       
}
