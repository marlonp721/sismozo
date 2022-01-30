<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Modules\Security\Entities\Params;
use App\Modules\Security\Entities\User;
use App\Modules\Security\Entities\Event_Logs;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest')->except('logout');
    }

    public function username() {
      return 'username';
    }

    protected function credentials(Request $request)
    {

      /*quitar password lo haremos en login la verificacion*/

      return array_merge(
        $request->only($this->username(), 'password'),
        ['status' => 1]
      );
    }

      /*public function login(Request $request)
    {
        
        $this->validateLogin($request);

        
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

      
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    
      }*/

      public function login(Request $request)
      {

        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
          $this->fireLockoutEvent($request);
          return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
          $event_logs =new Event_Logs();
          $event_logs->user_id        = auth()->user()->id;
          $event_logs->type_log       = Event_Logs::TYPE_LOG;
          $event_logs->element        = Event_Logs::ELEMENT_LOGIN;
          $event_logs->action         = Event_Logs::ACTION_LOGIN;
          $event_logs->description    = 'Ingreso : "'.date('d/m/Y H:i:s').'"';

          try{

           $event_logs->save();

         }catch (\Exception $e) {
          abort(500);
        }
        return $this->sendLoginResponse($request);
      }
      $this->incrementLoginAttempts($request);
      return $this->sendFailedLoginResponse($request);
    }

    public function validateLogin(Request $request)
    {
      $request->validate([
        $this->username() => 'required|string',
        'password' => 'required|string',
        // recaptchaFieldName() => recaptchaRuleName(),
      ]);
    }



  }
