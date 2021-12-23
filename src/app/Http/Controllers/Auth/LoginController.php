<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;


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
    // ゲストユーザー用のユーザーIDを定数として定義
    private const GUEST_USER_ID = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ソーシャルログインのメソッド
    public function redirectToProvider(string $provider)
    {
        // Socialiteのdirverメソッドに、外部のサービス名
        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback(Request $request, string $provider)
    {
        $providerUser = Socialite::driver($provider)->stateless()->user();

        $user = User::where('email', $providerUser->getEmail())->first();

        if ($user) {
            $this->guard()->login($user, true);
            return $this->sendLoginResponse($request);
        }
        return redirect()->route('register.{provider}', [
          'provider' => $provider,
          'email' => $providerUser->getEmail(),
          'token' => $providerUser->token,
      ]);
    }
    // ゲストログイン処理
    public function guestLogin()
    {
        // id=1 のゲストユーザー情報がDBに存在すれば、ゲストログインする
        if (Auth::loginUsingId(self::GUEST_USER_ID)) {
            return redirect('/')->with('flash_message', 'ゲストユーザーでログインしました。');
        }

        return redirect('/')->with('flash_message', 'ゲストユーザーでログインしました。');
    }
    
    protected function loggedOut(Request $request)
    {
      // ログアウト後WelComeページに遷移させる
      // session()->flash('flash_message', 'ログアウトしました。');
      // return view('welcome');
      session()->flash('flash_message', 'ログアウトしました。');
      return view('auth.register');
      
    }
}
