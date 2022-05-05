<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use \Auth;
use App\User;
use Socialite;
use Exception;
use DB;

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

    //use AuthenticatesUsers;
	use AuthenticatesUsers {
		logout as performLogout;
	}

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $dbuser = '';
    protected $provider = '';
    protected $validator = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);		
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
            'username' => 'required|max:255|unique:users',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|phone|max:15|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        $type = 'student';
        if($data['is_student'])
            $type = 'parent';
        
        $role = getRoleData($type);
      
        $user           = new User();
        $user->name     = $data['name'];
        $user->username     = $data['username'];

        $user->email    = $data['email'];
        $user->phone    = $data['phone'];
        $user->password = bcrypt($data['password']);
        $user->role_id  = $role;
        $user->slug     = $user->makeSlug($user->name);
      
        $user->save();

        $user->roles()->attach($user->role_id);
        try{ 
            $this->sendPushNotification($user);
        sendEmail('registration', array('user_name'=>$user->name, 'username'=>$data['username'], 'to_email' => $user->email, 'password'=>$data['password']));

          }
         catch(Exception $ex)
        {
            
        }
      
        flash('success','record_added_successfully', 'success');

        $options = array(
                            'name' => $user->name,
                            'image' => getProfilePath($user->image),
                            'slug' => $user->slug,
                            'role' => getRoleData($user->role_id),
                        );
        pushNotification(['owner','admin'], 'newUser', $options);
         return $user;
    }



      public function sendPushNotification($user)
     {
        if(getSetting('push_notifications', 'module')) {
          if(getSetting('default', 'push_notifications')=='pusher') {
              $options = array(
                    'name' => $user->name,
                    'image' => getProfilePath($user->image),
                    'slug' => $user->slug,
                    'role' => getRoleData($user->role_id),
                );

            pushNotification(['owner','admin'], 'newUser', $options);
          }
          else {
            $this->sendOneSignalMessage('New Registration');
          }
        }
     }

      //this view the login page  	
     public function getLogin($layout_type = '')
    {   
         

        try{

         session()->put("layout_number",$layout_type);

         $data['active_class']       = 'login';
         $data['title']              = getPhrase('login');
         $rechaptcha_status          = getSetting('enable_rechaptcha','recaptcha_settings');
         $data['rechaptcha_status']  = $rechaptcha_status;

        // return view('auth.login',$data);

         $view_name = getTheme().'::auth.login';

        return view($view_name, $data);

        }catch (Exception $e) {

              return redirect( URL_UPDATE_DATABASE );
           }
    }


    /**
     * This is method is override from Authenticate Users class
     * This validates the user with username or email with the sent password
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postLogin(Request $request)
    {
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        if($rechaptcha_status == 'yes'){
             $columns = array(
            'g-recaptcha-response' => 'required|captcha',
            );
              $messsages = array(
            'g-recaptcha-response.required'=>'Введите капчу',
            );
              $this->validate($request,$columns,$messsages);
         }

        $request->phone = preg_replace('/[^0-9]/','' ,$request->phone);

        $login_status = FALSE;
        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
                $login_status = TRUE;
        }

        if(!$login_status)
        {
             $message = getPhrase("Неверные данные логин или пароль");
             session()->flash('error', $message);
             return redirect()->back();
        }

        if($login_status){
            $user = Auth::user();
            if($user->is_verified == 0){
                Auth::logout();
                session()->flash('error', 'Ваш аккаунт не верифицирован');
                return redirect()->back();
            }
            if($user->login_enabled == 0){
                Auth::logout();
                $message = getPhrase("Ваш аккаунт был заблокирован администратором");
                session()->flash('error', $message);
                return redirect()->back();
            }
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
                // dd($login_status);
                return redirect(PREFIX);
            }
    }


   


     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($logintype)
    {

       // if(!getSetting($logintype.'_login', 'module'))
        $checker = 'google_plus';
        
        if($logintype=='facebook')
            $checker=$logintype;

        if(!getSetting($checker.'_login', 'module'))
        {
            flash('Ooops..!', $logintype.'_login_is_disabled','error');
             return redirect(PREFIX);
        }
        $this->provider = $logintype;
        return Socialite::driver($this->provider)->redirect();
 
    }

     /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($logintype)
    {

        try{
        $user = Socialite::driver($logintype);

        
        if(!$user)
        {
            return redirect(PREFIX);
        }
            
        $user = $user->user();

        
         if($user)
         {
             
            if($this->checkIsUserAvailable($user)) {
                Auth::login($this->dbuser, true);
                flash('Успешно', 'Можете авторизироваться', 'success');
                return redirect(PREFIX);    
            }
            flash('Ошибка', 'Ошибка авторизации', 'error');
            return redirect(PREFIX);
         }
     }
         catch (Exception $ex)
         {
            return redirect(PREFIX);
         }
    }

    public function checkIsUserAvailable($user)
    {
        
        $id         = $user->getId();
        $nickname   = $user->getNickname();
        $name       = $user->getName();
        $email      = $user->getEmail();
        $phone      = $user->getPhone();
        $avatar     = $user->getAvatar();
 
        $this->dbuser = User::where('email', '=',$email)->first();
        
        if($this->dbuser) {
            //User already available return true
            return TRUE;
        }
        
        $newUser = array(
                            'name' => $name,
                            'email'=>$email,
                            'phone'=>$phone,
                        );
        $newUser = (object)$newUser;

        $userObj = new User();
       $this->dbuser = $userObj->registerWithSocialLogin($newUser);
       $this->dbuser = User::where('slug','=',$this->dbuser->slug)->first();
       // $this->sendPushNotification($this->dbuser);
       return TRUE;
     
    }

    public function socialLoginCancelled(Request $request)
    {
         return redirect(PREFIX);
    }

    public function confirmIndex($code = null)
    {
    	$arr = session()->all();
    	if (isset($arr['var'])) {
    		$data['session'] = $arr['var'];
    	}
    
        $data['active_class']   = 'confirm';
        $data['title']  = getPhrase('confirm');

        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;
        
        $view_name = getTheme().'::auth.confirm';

        return view($view_name, $data);       
    }

    public function confirmUser(Request $request)
    {
        $arr = $request->session()->all();

        if (isset($_POST['post'])) {

            $var = $arr['var'];
            $link = $arr['link'];
            $sms = $arr['sms'];

            $record = User::where('activation_code', $link)->orderBy('id', 'DESC')->first();
            $record->activation_code = mt_rand(11111, 99999);
            $record->save();

            new \App\Http\SmsSend($var, $record->activation_code, $sms);

            flash('Успешно','На ваш номер, был повторно отправлен код активации', 'overlay');

        }elseif ($record = null) {
             flash('Ошибка','Ошибка', 'error');
             return redirect()->back();
        }

        $record = User::where('activation_code', $request->code)->orderBy('id', 'DESC')->first();


        if (isset($record)) {
             if($record->is_verified == 1){

            $data['active_class']   = 'confirm';
            $data['title']  = getPhrase('confirm');

            $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
            $data['rechaptcha_status']  = $rechaptcha_status;
            
            $view_name = getTheme().'::auth.confirm';

            $error = $record->is_verified;

            $var = $record->id;

            return view($view_name, $data, compact('error','var'));

            }
            elseif ( $record->is_verified  = 1) {

                $record->save();

                $data['active_class']   = 'confirm';
                $data['title']  = getPhrase('confirm');

                $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
                $data['rechaptcha_status']  = $rechaptcha_status;
                
                $view_name = getTheme().'::auth.confirm';

                $error = $record->is_verified;

                $var = $record->id;

                return view($view_name, $data, compact('error','var'));
            }
        }
        else{
            
            $message = getPhrase("Неверный код активации");
            flash('Ошибка', $message, 'error');
            return redirect()->back();
        }


    }

    public function isValidRecord($record)
    {
      
      if ($record === null) {

            flash('Ooops...!', 'account_is_not_existed_please_contact_your_admin', 'error');
             return redirect(URL_HOME);
        }
    }


    public function authenticate(Request $request)
    {   
        
        $response = [];
        $response['status'] = 0;
        $response['message'] = 'Email/Password is incorrect';
        $user_object = null;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // return redirect(PREFIX);
            $user_object = Auth::user();                
        } 
        else if(Auth::attempt(['username' => $request->email, 'password' => $request->password]))

        {


            $user_object = Auth::user();

              
        }

        if($user_object)
        {
            if($user_object->role_id==6)
            {
                $response['message'] = 'Parent login is not allowed';
                return $response;
            }
              if ($request->device_id) {
                    $user_object->device_id = $request->device_id;
                    $user_object->save();
                }


                $user['id'] = $user_object->id;
                $user['name'] = $user_object->name;
                $user['email'] = $user_object->email;
                $user['phone'] = $user_object->phone;
                $user['image'] = $user_object->image;
                $login_status = TRUE;
                $response['status'] = 1;
                $response['user'] = $user;
                $response['message'] = 'Login Success';
        }
        
        return $response;
    }
}
