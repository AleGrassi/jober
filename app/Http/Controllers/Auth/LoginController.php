<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\DataLayer;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        $dl = new DataLayer();
        $user_id = auth()->id();
        $dl->console_log($user_id);
        $user = $dl->find_user_by_id($user_id);
        $user_type = $user->user_type;

        if($user_type == 'worker'){
            $worker = $dl->find_worker_by_user_id($user_id);
            return $this->redirectTo = route('worker.show', ['worker' => $worker[0]->id]);
        }else{
            $company = $dl->find_company_by_user_id($user_id);
            return $this->redirectTo = route('company.show', ['company' => $company[0]->id]);
        }
    }
}
