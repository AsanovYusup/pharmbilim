<?php

namespace App\Http\Controllers\Auth;


use App\User;
use \Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
         return Validator::make($data, [
            'username' => 'max:255|unique:users',
            'name' => 'required|max:255',
            'email' => 'email|max:255|unique:users',
            'phone' => 'required|phone|max:15|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
	

    public function postRegisterConfirm(Request $request)
    {

        $user = User::where('id', $request->id)->first();

        $columns = array(
            'password' => 'bail|min:5',
            'password_confirmation'=>'bail|min:5|same:password',
            );

        $this->validate($request,$columns);
        $password             = $request->password;
        $user->password       = bcrypt($password);
        $user->save();

        $login_status = FALSE;
        if (Auth::attempt(['id' => $request->id,'password' => $request->password ])) {
                return redirect('users/edit/'.$user->slug);
                $login_status = TRUE;
        } 

        if($login_status) {     
            if(checkRole(getUserGrade(7)))  {
               if(!getSetting('parent', 'module')) {
                return redirect(URL_PARENT_LOGOUT);
               }
            } 
        }

        /**
         * The logged in user is student/admin/owner
         */
        if($login_status)
        {  
            $layout_num  = session()->get('layout_number');
            // dd($layout_num);
            return redirect(PREFIX);
        }  
       
    }

	public function getRegister( $role = 'user' )
	{        
        $data['active_class']   = 'register';
		$data['title'] 	= getPhrase('register');
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;
        $view_name = getTheme().'::auth.register';
        return view($view_name, $data);
	}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postRegister(Request $request)
     {
        $request->phone = preg_replace('/[^0-9]/','' ,$request->phone);
        $phone_check = User::where('slug', $request->phone)->first();
        if($phone_check){
            session()->flash('error','Пользователь с таким номером уже существует! Попробуйте восстановить пароль, или регистрацию с другим номером!');
            return redirect(URL_USERS_REGISTER);
        }
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        if ( $rechaptcha_status  == 'yes') {
           $columns = array(
                        'name'     => 'bail|max:20|',
                        'username' => 'bail|max:20',
                        'email'    => 'bail|unique:users,email',
                        'phone'    => 'bail|required|unique:users,phone',
                        'password' => 'bail|min:5',
                        'password_confirmation'=>'bail|min:5|same:password',
                        'g-recaptcha-response' => 'required|captcha',
                        );
            $messsages = array(
                        'g-recaptcha-response.required'=>'Please Select Captcha',                   
                        );

            $this->validate($request,$columns,$messsages);
            }
             else {
                $columns = array(
                            'name'     => 'bail|max:20|',
                            'username' => 'bail|max:20',
                            'email'    => 'bail|unique:users,email',
                            'phone'    => 'bail|required|unique:users,phone',
                            'password' => 'bail|min:5',
                            'password_confirmation'=>'bail|min:5|same:password',
                            );
                $messsages = array(
                            'required' => 'Заполните номер телефона',
                            'unique'   => 'Такой номер телефона уже существует'                   
                     );           
                  $this->validate($request,$columns,$messsages);

            }
        

        $user           = new User();
        $name           = $request->name;
        $user->name     = $name;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->phone    = $request->phone;

        if (isset($request->password)) {
            $password               = $request->password;
            $user->password         = bcrypt($password);
        }
        
        $user->role_id         = $request->ac_role;
        $user->activation_code = mt_rand(11111, 99999);
        $link = $user->activation_code;
        $slug = $user->phone;
        $user->slug = $slug;
        $user->login_enabled  = 1;
        $user->save();
        $user->roles()->attach($user->role_id);
        $sms = "Код подтверждения";
        $phone = '996'.preg_replace('~[^0-9]+~','',$user->phone);
        try 
        {
            if (!env('DEMO_MODE')) {
             new \App\Http\SmsSend($phone, $link, $sms);
             session(['var' => $phone]);
             session(['link' => $link]);
             session(['sms' => $sms]);
            }

        }
        catch(Exception $ex)
        {
         
        }
        session()->flash('success','На ваш телефон был отправлен код активации');
        return redirect( URL_USERS_CONFIRM );
     }

    // /**
    //  * Create a new user instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return User
    //  */
    // protected function create(array $data)
    // {
	// 	$name = $data['first_name'] . ' ' . $data['last_name'];
	// 	$user    = new User();
	// 	$user->name     = $name;
    //     $user->first_name     = $data['first_name'];
    //     $user->last_name    = $data['last_name'];
	// 	$user->email     = $data['email'];
    //     $user->phone     = $data['phone'];
    //     $user->password = bcrypt($data['password']);
    //     if( $data['role'] == 'vendor' ) {
	// 		$user->role_id  = VENDOR_ROLE_ID;
	// 	} else {
	// 		$user->role_id  = USER_ROLE_ID;
	// 	}
    //     $user->slug     = $user->makeSlug($user->name);
	// 	$user->confirmation_code = str_random(30);
	// 	$link = URL_USERS_CONFIRM.'/'.$user->confirmation_code;
	// 	$user->save();
	// 	$user->roles()->attach($user->role_id);
	// 	try{
    //     sendEmail('registration', array('user_name'=>$user->email, 'username'=>$user->email, 'to_email' => $user->email, 'password'=>$data['password'], 'confirmation_link' => $link));
    //       }
    //      catch(Exception $ex)
    //     {
            
    //     }
	// 	flash('Success','You Have Registered Successfully. Please Check Your Email Address To Activate Your Account', 'success');
	// 	return $user;
    // }
	
	// /**
    //  * Create a new user instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return User
    //  */
    // protected function register(Request $request)
    // {
	// 	$data = array(
	// 		'first_name' => $request->first_name,
	// 		'last_name' => $request->last_name,
	// 		'email' => $request->email,
    //         'phone' => $request->phone,
	// 		'password' => $request->password,
	// 		'role' => $request->role,			
	// 	);
	// 	$name = $data['first_name'] . ' ' . $data['last_name'];
	// 	$user    = new User();
	// 	$user->name     = $name;
    //     $user->first_name     = $data['first_name'];
    //     $user->last_name    = $data['last_name'];
	// 	$user->email     = $data['email'];
    //     $user->phone     = $data['phone'];
    //     $user->password = bcrypt($data['password']);
    //     if( $data['role'] == 'vendor' ) {
	// 		$user->role_id  = VENDOR_ROLE_ID;
	// 	} else {
	// 		$user->role_id  = USER_ROLE_ID;
	// 	}
    //     $user->slug     = $user->makeSlug($user->name);
	// 	$user->confirmation_code = str_random(30);
	// 	$link = URL_USERS_CONFIRM . '/' . $user->confirmation_code;
	// 	$user->save();
	// 	$user->roles()->attach($user->role_id);
	// 	try{
    //     sendEmail('registration', array('user_name'=>$user->email, 'username'=>$user->email, 'to_email' => $user->email, 'password'=>$data['password'], 'confirmation_link' => $link));
    //       }
    //      catch(Exception $ex)
    //     {
            
    //     }
	// 	flash('success','You Have Registered Successfully. Please Check Your Email Address To Activate Your Account', 'success');
	// 	return redirect( URL_USERS_LOGIN );
    // }




    public function studentOnlineRegistration()
    {
        return view('auth.student-online-registration');
    }
}
