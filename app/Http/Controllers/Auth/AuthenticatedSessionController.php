<?php

namespace App\Http\Controllers\Auth;

use RoyalApp;
use App\Models\User;
use Illuminate\View\View;
use App\libraries\RoyalApps;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
       
        // $request->authenticate();

        // $request->session()->regenerate();
        
        // calling Authentication api from royal apps endpoints
        $royal_apps= new RoyalApps();
        
        // calling login ending point
        $response=$royal_apps->login($request->only('email', 'password'));
        $this->storeUser($response,$request);
        if($response['status_code']==200){
        
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        return back()->with('message','please try again later login credentials are invalid');
    }
    public function storeUser($response,$request){
        $user=$response['response']->user;
        $is_user=User::where('email',$user->email)->first();
        if(empty($is_user)){
            $is_user = User::create([
                'name' => $user->first_name.' '. $user->last_name,
                'email' => $user->email,
                'password' => Hash::make($request->password),
                'token'=>$response['response']->token_key,
            ]);
            event(new Registered($is_user));
        }
        $is_user->token=$response['response']->token_key;
        $is_user->save();
        
        // $request->session()->regenerate();
        if($response['status_code']==200)
          Auth::login($is_user);
    
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
