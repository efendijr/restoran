<?php
    
namespace App\Http\Controllers\AuthWarung;


use App\Warung;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/warung';
    protected $guard = 'warung';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => 'required|max:255',
    //         'email' => 'required|email|max:255|unique:users',
    //         'password' => 'required|min:6|confirmed',
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    // protected function create(array $data)
    // {
    //     return Admin::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => bcrypt($data['password']),
    //     ]);
    // }
    public function showRegister()
    {
        return view('warung.register');
    }

    public function postRegister(Request $request, Warung $warung)
    {
        $validator = validator($request->all(), [
            'nameWarung' => 'required|min:3|max:100',
            'emailWarung' => 'required|email|min:3|max:200',
            'passwordWarung' => 'required|min:6|max:20',
        ]);

       if ($validator->fails()) {
           return redirect('warung/register')
                    ->withErrors($validator)
                    ->withInput();
       }

        $getemail = $request->get('emailWarung');
        $query = Warung::where('emailWarung', $getemail)->first();

        if ($query == null) {
            $warung->nameWarung = $request->get('nameWarung');
            $warung->emailWarung = $getemail;
            $warung->password = bcrypt($request->get('password'));
            $warung->save();

            Session::flash('flash_success', 'anda berhasil registrasi');
            return redirect('warung/login');

        } else {
            Session::flash('flash_exist_data', 'email yang anda gunakan sudah ada');
            return redirect('warung/register');
        }
        
    }

    public function showLogin()
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }
        return view('warung.login');
    }

    public function postLogin(Request $request)
    {
       $validator = validator($request->all(), [
            'emailWarung' => 'required|email|min:3|max:200',
            'passwordWarung' => 'required|min:6|max:20',
        ]);

       if ($validator->fails()) {
           return redirect('warung/login')
                    ->withErrors($validator)
                    ->withInput();
       }

       $credential = [
                'emailWarung'=> $request->get('emailWarung'), 
                'passwordWarung' => $request->get('passwordWarung'),
                ];

        if ( auth('warung')->attempt($credential)) {

            Session::flash('flash_success', 'anda berhasil login');
            return redirect('warung');
        
        } else {
            return redirect('warung/login')
                    ->withErrors(['errors' => 'login invalid'])
                    ->withInput();
        }
    }

    public function logout()
    {
        auth('warung')->logout();
        return redirect('warung/login');
    }
}
