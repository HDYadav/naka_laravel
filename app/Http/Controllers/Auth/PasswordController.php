<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }


    public function changePassword(PasswordRequest $passwordRequest )
    {
        // $validated = $request->validateWithBag('updatePassword', [
        //     'current_password' => ['required', 'current_password'],
        //     'password' => ['required', Password::defaults()],
        // ]);
        //dd($passwordRequest->password);

        // $request->user()->update([
        //     'password' => Hash::make($validated['password']),
        // ]); 


      $data =   $passwordRequest->user()->update([
            'password' => Hash::make($passwordRequest->password),
        ]);

        return response()->json([
            'sucess'   => true,
            'message'   => 'Password Updated Successfully',
            
        ], 201);


        
       //return response()->json(['password successfully updated'], 200);
    }

}
