<?php
    
namespace App\Http\Controllers\AuthAdmin;


use App\Admin;
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
    protected $redirectTo = '/admin';
    protected $guard = 'admin';

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
        return view('admin.register');
    }

    public function postRegister(Request $request, Admin $admin)
    {
        $validator = validator($request->all(), [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|min:3|max:200',
            'password' => 'required|min:6|max:20',
        ]);

       if ($validator->fails()) {
           return redirect('admin/register')
                    ->withErrors($validator)
                    ->withInput();
       }

        $getemail = $request->get('email');
        $query = Admin::where('emailAdmin', $getemail)->first();

        if ($query == null) {
            $admin->nameAdmin = $request->get('name');
            $admin->emailAdmin = $getemail;
            $admin->password = bcrypt($request->get('password'));
            $admin->save();

            Session::flash('flash_success', 'anda berhasil registrasi');
            return redirect('admin/login');

        } else {
            Session::flash('flash_exist_data', 'email yang anda gunakan sudah ada');
            return redirect('admin/register');
        }
        
    }

    public function showLogin()
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
       $validator = validator($request->all(), [
            'email' => 'required|email|min:3|max:200',
            'password' => 'required|min:6|max:20',
        ]);

       if ($validator->fails()) {
           return redirect('admin/login')
                    ->withErrors($validator)
                    ->withInput();
       }

       $credential = [
                'emailAdmin'=> $request->get('email'), 
                'password' => $request->get('password'),
                ];

        if ( auth('admin')->attempt($credential)) {

            Session::flash('flash_success', 'anda berhasil login');
            return redirect('admin');
        
        } else {
            return redirect('admin/login')
                    ->withErrors(['errors' => 'login invalid'])
                    ->withInput();
        }
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect('admin/login');
    }
}
