<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
//use Illuminate\View\View;
use Illuminate\Validation\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    // public function create(): View
    // {
    //     return view('auth.register');
    // }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreUserRequest $request): JsonResponse
    {

        // $validator = Validator::make($request->all(), [
        //     'name' => ['required', 'string', 'max:255'], 
        //     'mobile' => ['required', 'number', 'max:13'],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],           
        // ]);

        // $validator = $request->validate([
        //     'name' => ['required', 'string', 'max:255'],           
        //     'mobile' =>  ['required', 'number', 'max:13'],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

     
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }
     
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');



        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],           
        //     'mobile' =>  ['required', 'number', 'max:13'],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'mobile' => $request->mobile,           
        //     'password' => Hash::make($request->password),
        // ]);

        // event(new Registered($user));

        // Auth::login($user);

        // // return redirect(RouteServiceProvider::HOME);
        // return redirect(RouteServiceProvider::ADMIN_HOME);
        
    }
}
