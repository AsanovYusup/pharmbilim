<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App;
use App\Http\Requests;
use App\User;
use App\Pharm;
use App\GeneralSettings as Settings;
use Image;
use App\Quiz;
use ImageSettings;
use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Excel;
use Input;
use File;
use App\OneSignalApp;
use Exception;
use Carbon\Carbon;

class UsersController extends Controller
{

    public $excel_data = array();

    public function __construct()
    {
        $currentUser = \Auth::user();

        $this->middleware('auth');

    }


    public function events()
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }


        $record = DB::table('events')->get();

        $data['record'] = $record;

        $data['layout'] = getLayout();
        $data['active_class'] = 'events';
        $data['heading'] = "События";
        $data['title'] = "События";

        $view_name = getTheme() . '::users.events';
        return view($view_name, $data);


    }

    public function editEvents($slug)
    {
        $record = DB::table('events')->where('slug', $slug)->first();

        $data['record'] = $record;

        $data['layout'] = getLayout();
        $data['active_class'] = 'events';
        $data['heading'] = "События";
        $data['title'] = "События";

        $view_name = getTheme() . '::users.add-edit-events';
        return view($view_name, $data);

    }

    public function updateEvents(Request $request, $slug)
    {
        DB::table('events')->where('slug', $slug)->update(['date' => $request->date, 'title' => $request->title, 'description' => $request->description, 'url' => $request->url, 'slug' => $slug]);

        $record = DB::table('events')->get();

        $record = json_encode($record);

        $filename = 'public/data.json';

        file_put_contents($filename, $record);

        flash('', 'Ваши данные успешно добавлены', 'success');
        return redirect(URL_EVENTS);
    }

    public function deleteEvents($slug)
    {

        DB::table('events')->where('slug', $slug)->delete();

        $record = DB::table('events')->get();

        $record = json_encode($record);

        $filename = 'public/data.json';

        file_put_contents($filename, $record);

        $response['status'] = 1;
        $response['message'] = getPhrase('record_deleted_successfully');
        return json_encode($response);
    }

    public function addEvents()
    {

        $data['record'] = FALSE;
        $data['layout'] = getLayout();
        $data['active_class'] = 'events';
        $data['heading'] = getPhrase('add_events');
        $data['title'] = getPhrase('add_events');

        $view_name = getTheme() . '::users.add-edit-events';
        return view($view_name, $data);
    }

    public function storeEvents(Request $request)
    {

        $rand = str_random(5);

        $slug = $request->title;
        $slug = Str::slug($slug . $rand);

        $old = 'public/data.json';

        $old = file_get_contents($old);

        $old = json_decode($old);

        $result = array([
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'slug' => $slug
        ]);

        if ($old) {
            $result = array_merge($old, $result);
            $result = json_encode($result);
        } else {
            $result = json_encode($result);
        }

        DB::table('events')->insert(['date' => $request->date, 'title' => $request->title, 'description' => $request->description, 'url' => $request->url, 'slug' => $slug]);

        $filename = 'public/data.json';

        file_put_contents($filename, $result);
        flash('', 'Ваши данные успешно добавлены', 'success');
        return redirect(URL_EVENTS);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($role = 'student')
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['records'] = FALSE;
        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        $data['heading'] = getPhrase('users');
        $data['title'] = getPhrase('users');
        // return view('users.list-users', $data);

        $view_name = getTheme() . '::users.list-users';
        return view($view_name, $data);
    }

    public function exportData()
    {

        $quiz_dont = [];
        $result123 = [];
//     $users_dont_exam = DB::table('users')
//            ->whereNotExists(function ($query) {
//                $query->select(DB::raw(1))
//                      ->from('quizresults')
//                      ->whereRaw('quizresults.user_id = users.id');
//            })
//            ->get();

        // $user = new User();

        $region = DB::table('region_name')->get();
        $times = DB::table('lms_points')->get();


        $user = User::all()->where('role_id', '<>', '1')->where('role_id', '<>', '2');


        // $customer_array[] = array('Регион', 'Аптека', 'ФИО', 'Тема', 'Балл', 'Попытка');
        $users_array[] = array(
            'Регион', 
            'ФИО', 
            'Телефон', 
            'Аптека', 
            'Компания', 
            'Специальность', 
            'Роль', 
            'Статус', 
            'Дата регистрации'
        );
        $svodka[] = array(
            'Регион', 
            'ФИО', 
            'Телефон', 
            'Аптека', 
            'Компания', 
            'Роль', 
            'Статус', 
            'Дата регистрации', 
            'Тема', 
            'Макс. результат', 
            'Кол-во попыток'
        );
        $notest[] = array(
            'Регион', 
            'ФИО', 
            'Телефон', 
            'Аптека', 
            'Компания', 
            'Роль', 
            'Статус', 
            'Дата регистрации', 
            'Тема'
        );
        $percentage[] = array(
            'Регион', 
            'Компания', 
            'Всего работников аптек зарегистрировано', 
            'Всего прошли тестирование', 
            '% прохождения', 
            'Не прошли'
        );

        $time[] = array(
            'ФИО', 
            'Телефон', 
            'Видео', 
            'Количество просмотренных минут', 
            'Кредит часы'
        );

        foreach ($user as $value) {

            $role = getRoleData($value->role_id);

            $roles = DB::table('roles')->where('name', $role)->select('display_name')->first();

            if ($value->login_enabled == 1) {
                $status = 'Активный';
            } else {
                $status = 'Неактивный';
            }

            $reg_date = mb_substr($value->created_at, 0, 10);

            $users_array[] = array(
                'Регион' => $value->region,
                'ФИО' => $value->name,
                'Телефон' => intval($value->phone),
                'Аптека' => $value->pharm,
                'Компания' => $value->company,
                'Специальность' => $value->college_place,
                'Роль' => $roles->display_name,
                'Статус' => $status,
                'Дата регистрации' => $reg_date
            );

            $result = DB::table('quizresults')
            ->join('quizzes', 'quizresults.quiz_id', '=', 'quizzes.id')
            ->where('quizresults.user_id', '=', $value->id)
            ->groupBy('quizzes.id')
            ->get();

            // dd($result);

            $res123 = [];
            $q123 = [];
            $result123 = DB::table('quizresults')
            ->orderBy('created_at', 'desk')
           
            ->join('quizzes', 'quizresults.quiz_id', '=', 'quizzes.id')
            
            ->where('quizresults.user_id', '=', $value->id)
            ->select('quiz_id', 'title','quizresults.created_at')
            
            ->groupBy('quizzes.id')
            
            
            ->get();
            // $result123;
            $quiz123 = DB::table('quizzes')
            ->orderBy('created_at', 'desk')
            ->select('id', 'title','created_at')
            ->take(5)
            ->get();
            // dd($quiz123);
            foreach ($result123 as $res) {
                $res123[$res->quiz_id] = $res->title;
            }
            foreach ($quiz123 as $quiz) {
                $q123[$quiz->id] = $quiz->title;
            }
            $finish = array_diff($q123, $res123);


            foreach ($finish as $fin) {

                $notest[] = array(
                    'Регион' => $value->region,
                    'ФИО' => $value->name,
                    'Телефон' => intval($value->phone),
                    'Аптека' => $value->pharm,
                    'Компания' => $value->company,
                    'Роль' => $roles->display_name,
                    'Статус' => $status,
                    'Дата регистрации' => $reg_date,
                    'Тема' => $fin
                );
            }

            

            foreach ($result as $res) {

                $max_result = DB::table('quizresults')
                ->where('quiz_id', $res->id)
                ->where('user_id', $res->user_id)
                    ->max('percentage');

                $co = DB::table('quizresults')
                ->where('quiz_id', $res->id)
                ->where('user_id', $res->user_id)
                    ->get();

                $svodka[] = array(
                    'Регион' => $value->region,
                    'ФИО' => $value->name,
                    'Телефон' => intval($value->phone),
                    'Аптека' => $value->pharm,
                    'Компания' => $value->company,
                    'Роль' => $roles->display_name,
                    'Статус' => $status,
                    'Дата регистрации' => $reg_date,
                    'Тема' => $res->title,
                    'Макс. результат' => intval($max_result),
                    'Кол-во попыток' => count($co)
                );
            }

        }
        

        // $result = DB::table('quizresults')
        // ->join('quizzes', 'quizresults.quiz_id', '=', 'quizzes.id')
        //     ->groupBy('quizresults.id')
        //     ->get();
       


        // foreach ($region as $reg) {

        //     $count = '';

        //     $us = User::where('region', $reg->region_name)->where('company', $reg->company)->get();

        //     $users = DB::table('users')->where('users.company', $reg->company)->where('users.region', $reg->region_name)->join('quizresults', 'users.id', '=', 'quizresults.user_id')->groupBy('quizresults.user_id')->get();

        //     $finaly = count($us) - count($users);

        //     if (count($users) == count($us)) {
        //         $percent = 0;
        //     } elseif ($users == null) {
        //         $count_us = 1;
        //         $percent = (count($users) / count($us)) * 100;
        //     }

        //     $percentage[] = array(
        //         'Регион' => $reg->region_name,
        //         'Компания' => $reg->company,
        //         'Всего работников аптек зарегистрировано' => count($us),
        //         'Всего прошли тестирование' => count($users),
        //         '% прохождения' => intval($percent),
        //         'Не прошли' => $finaly);
        // }

        foreach ($times as $tm) {

            $usn = User::where('id', $tm->user_id)->first();
            if(isset($usn)){
               $time[] = array(
                    'ФИО' => $usn->name,
                    'Телефон' => $usn->phone,
                    'Видео' => $tm->name,
                    'Количество просмотренных минут' => $tm->time,
                    'Кредит часы' => $tm->points
                ); 
            }
        }


///
        Excel::create('Отчет', function ($excel) use ($users_array, $svodka, $time, $notest) {
            // $excel->setTitle('Выгрузка');
            // $excel->sheet('Выгрузка', function($sheet) use($customer_array){
            //   $sheet->fromArray($customer_array, null, 'A1', false, false);
            // });

            $excel->setTitle('Всего сотрудников');
            $excel->sheet('Всего сотрудников', function ($sheet) use ($users_array) {
                $sheet->fromArray($users_array, null, 'A1', false, false);
            });

            $excel->setTitle('Сводная');
            $excel->sheet('Сводная', function ($sheet) use ($svodka) {
                $sheet->fromArray($svodka, null, 'A1', false, false);
            });

            $excel->setTitle('Непрошедшие');
            $excel->sheet('Непрошедшие', function ($sheet) use ($notest) {
                $sheet->fromArray($notest, null, 'A1', false, false);
            });

            $excel->setTitle('Время просмотра видео');
            $excel->sheet('Время просмотра видео', function ($sheet) use ($time) {
                $sheet->fromArray($time, null, 'A1', false, false);
            });
        })->download('xlsx');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexUnsorted($role = 'student')
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['records'] = FALSE;
        $data['layout'] = getLayout();
        $data['active_class'] = 'users-unsort';
        $data['heading'] = getPhrase('users_unsorted');
        $data['title'] = getPhrase('users_unsorted');
        // return view('users.list-users', $data);

        $view_name = getTheme() . '::users.list-users-unsorted';
        return view($view_name, $data);
    }


    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */

    public function getDatatable(Request $request, $slug = '')
    {
        $records = array();

        if ($slug == '') {

            $parent = getUserRecord($slug);

            if ($request->order){

                $columns = $request->columns;

                foreach ($columns as $key => $col){
                    if ($request->order[0]['column'] == $key){
                        $records = User::join('roles', 'users.role_id', '=', 'roles.id')
                            ->select(['users.id', 'users.name', 'users.created_at', 'phone', 'company', 'college_place', 'region', 'pharm', 'parent_id', 'second_parent', 'roles.display_name', 'login_enabled', 'role_id',
                                'slug', 'users.updated_at'])
                            ->orderBy($col['name'], $request->order[0]['dir']);
                    }
                }
            }else{
                $records = User::join('roles', 'users.role_id', '=', 'roles.id')
                    ->select(['users.id', 'users.name', 'users.created_at', 'phone', 'company', 'college_place', 'region', 'pharm', 'parent_id', 'second_parent', 'roles.display_name', 'login_enabled', 'role_id',
                        'slug', 'users.updated_at'])
                    ->orderBy('users.updated_at', 'desc');
            }

        } else {

            $role = App\Role::getRoleId($slug);

            $records = User::join('roles', 'users.role_id', '=', 'roles.id', 'roles.id', '=', $role->id)
                ->select(['name', 'phone', 'company', 'college_place', 'region', 'pharm', 'parent_id', 'second_parent', 'roles.display_name', 'login_enabled', 'role_id', 'slug', 'users.updated_at'])
                ->orderBy('users.updated_at', 'desc');

        }
        return Datatables::of($records)
            ->addColumn('action', function ($records) {


        $link_data = '<div class="col text-center"><div class="btn-group">
        <button type="button" class="btn btn-xs btn-success btn-icon rounded waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <i class="fal fa-cog"></i>
               </button>
               <div class="dropdown-menu">
                   <a class="dropdown-item" href="' . URL_USERS_EDIT . $records->slug . '">' . getPhrase("edit") . '</a>
                   <a class="dropdown-item" href="' . URL_USERS_ATTEMPTS . $records->slug . '">' . getPhrase("edit_attempts") . '</a>
                   <a class="dropdown-item" href="' . URL_USERS_SETTINGS . $records->slug . '">' . getPhrase("add_categories") . '</a>
                   <div class="dropdown-divider"></div>';


                if (getRoleData($records->role_id) == 'student' || getRoleData($records->role_id) == 'parent' || getRoleData($records->role_id) == 'parent_pharm' || getRoleData($records->role_id) == 'doctor') {

                    $link_data .= ' <a class="dropdown-item" href="' . URL_USERS_UPDATE_PARENT_DETAILS . $records->slug . '">' . getPhrase("update_parent") . '</a>';
                }
                $temp = '';

                //Show delete option to only the owner user
                if (checkRole(getUserGrade(1)) && $records->id != \Auth::user()->id) {

                    $temp = '<a class="dropdown-item" href="javascript:void(0);" onclick="deleteRecord(\'' . $records->slug . '\');">' . getPhrase("delete") . '</a>';


                    $temp .= '<a class="dropdown-item" href="javascript:void(0);" onclick="accountStatus(\'' . $records->slug . '\');">' . getPhrase("status") . '</a>';

                }

                $temp .= '</div></div></div>';


                $link_data .= $temp;
                return $link_data;
            })
            ->editColumn('name', function ($records) {
                if (getRoleData($records->role_id) == 'student' || getRoleData($records->role_id) == 'parent' || getRoleData($records->role_id) == 'parent_region' || getRoleData($records->role_id) == 'parent_pharm' || getRoleData($records->role_id) == 'doctor')
                    return '<a href="' . URL_USER_DETAILS . $records->slug . '">' . ucfirst($records->name) . '</a>';

                return ucfirst($records->name);
            })
            ->editColumn('image', function ($records) {
                return '<img src="' . getProfilePath($records->image) . '"  />';
            })
            ->editColumn('created_at', function ($records) {

                $records = explode(' ', $records->created_at);

                $data = explode('-', $records[0]);

                $date = $data[2] . '.' . $data[1] . '.' . $data[0];

                return $date;
            })
            ->editColumn('parent_id', function ($records) {

                if ($records->parent_id == null) {
                    return $records->parent_id;
                } elseif ($records->second_parent !== null) {
                    $parent_record = getUserRecord($records->parent_id);
                    $second = getUserRecord($records->second_parent);
                    return '1)' . $parent_record['name'] . '<br>' .
                        '2)' . $second['name'];
                } else {
                    $parent_record = getUserRecord($records->parent_id);
                    return $parent_record['name'];
                }

            })
            ->editColumn('login_enabled', function ($records) {

                return ($records->login_enabled == 1) ? '<i class="fal fa-check-square text-success"></i>' : '<i class="fal fa-times-square text-danger"></i>';
            })
            ->removeColumn('role_id')
            ->removeColumn('slug')
            ->removeColumn('updated_at')
            ->removeColumn('second_parent')
            // ->addAction('action',['printable' => false])


            ->make();
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */

    public function getDatatableUnsorted(Request $request, $slug = '')
    {

        $records = array();

        if ($slug == '') {

            $parent = getUserRecord($slug);
            if ($request->order){

                $columns = $request->columns;

                foreach ($columns as $key => $col){
                    if ($request->order[0]['column'] == $key){
                        $records = User::join('roles', 'users.role_id', '=', 'roles.id')
                            ->select(['users.id', 'users.name', 'company', 'region', 'pharm', 'roles.display_name', 'login_enabled', 'role_id',
                                'slug', 'users.updated_at'])->whereNull('parent_id')->where('role_id', '<>', '1')->where('role_id', '<>', '2')->where('role_id', '<>', '7')
                            ->orderBy($col['name'], $request->order[0]['dir']);
                    }
                }
            }else {
                $records = User::join('roles', 'users.role_id', '=', 'roles.id')
                    ->select(['users.id', 'users.name', 'company', 'region', 'pharm', 'roles.display_name', 'login_enabled', 'role_id',
                        'slug', 'users.updated_at'])
                    ->whereNull('parent_id')
                    ->where('role_id', '<>', '1')
                    ->where('role_id', '<>', '2')
                    ->where('role_id', '<>', '7')
                    ->orderBy('users.updated_at', 'desc');
            }

        } else {

            $role = App\Role::getRoleId($slug);

            $records = User::join('roles', 'users.role_id', '=', 'roles.id', 'roles.id', '=', $role->id)
                ->select(['name', 'company', 'region', 'pharm', 'roles.display_name', 'login_enabled', 'role_id', 'slug', 'users.updated_at'])
                ->whereNull('parent_id')
                ->where('role_id', '<>', '1')
                ->where('role_id', '<>', '2')
                ->orderBy('users.updated_at', 'desc');

        }

        return Datatables::of($records)
            ->addColumn('action', function ($records) {
                $link_data = '<div class="col text-center"><div class="btn-group">
        <button type="button" class="btn btn-xs btn-success btn-icon rounded waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <i class="fal fa-cog"></i>
               </button>
               <div class="dropdown-menu">
                   <a class="dropdown-item" href="' . URL_USERS_EDIT . $records->slug . '">' . getPhrase("edit") . '</a>
                   <a class="dropdown-item" href="' . URL_USERS_SETTINGS . $records->slug . '">' . getPhrase("add_categories") . '</a>
                   <div class="dropdown-divider"></div>';


                if (getRoleData($records->role_id) == 'student' || getRoleData($records->role_id) == 'parent_region' || getRoleData($records->role_id) == 'parent_pharm') {

                    $link_data .= ' <a class="dropdown-item" href="' . URL_USERS_UPDATE_PARENT_DETAILS . $records->slug . '">' . getPhrase("update_parent") . '</a>';
                }
                $temp = '';

                //Show delete option to only the owner user
                if (checkRole(getUserGrade(1)) && $records->id != \Auth::user()->id) {

                    $temp = '<a class="dropdown-item" href="javascript:void(0);" onclick="deleteRecord(\'' . $records->slug . '\');">' . getPhrase("delete") . '</a>';


                    $temp .= '<a class="dropdown-item" href="javascript:void(0);" onclick="accountStatus(\'' . $records->slug . '\');">' . getPhrase("status") . '</a>';

                }

                $temp .= '</div></div></div>';
                $link_data .= $temp;
                return $link_data;
            })
            ->editColumn('name', function ($records) {
                return '<a href="' . URL_USER_DETAILS . $records->slug . '">' . ucfirst($records->name) . '</a>';

                return ucfirst($records->name);
            })
            ->editColumn('image', function ($records) {
                return '<img src="' . getProfilePath($records->image) . '"  />';
            })
            ->editColumn('created_at', function ($records) {
                return substr($records->created_at, 0, 10);
            })
            ->editColumn('login_enabled', function ($records) {

                return ($records->login_enabled == 1) ? '<i class="fal fa-check-square text-success"></i>' : '<i class="fal fa-times-square text-danger"></i>';
            })
            ->removeColumn('role_id')
            ->removeColumn('slug')
            ->removeColumn('updated_at')
            // ->addAction('action',['printable' => false])


            ->make();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        if (!checkRole(getUserGrade(4))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['record'] = FALSE;
        $data['active_class'] = 'users';

        // $data['roles']        = $this->getUserRoles();
        $roles = \App\Role::select('display_name', 'id', 'name')->get();
        $final_roles = [];
        foreach ($roles as $role) {

            if (!checkRole(getUserGrade(1))) {

                if (!(strtolower($role->name) == 'admin' || strtolower($role->name) == 'owner'))
                    $final_roles[$role->id] = $role->display_name;
            } else
                $final_roles[$role->id] = $role->display_name;
        }
        $data['roles'] = $final_roles;
        $data['title'] = getPhrase('add_user');
        if (checkRole(['parent']))
            $data['active_class'] = 'children';
        $data['layout'] = getLayout();

        // return view('users.add-edit-user', $data);

        $view_name = getTheme() . '::users.add-edit-user';
        return view($view_name, $data);
    }


    public function confirmActivate(Request $request)
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

            flash('Успешно', 'На ваш номер, был повторно отправлен код активации', 'overlay');

        } elseif ($record = null) {
            flash('Ошибка', 'Ошибка', 'error');
            return redirect()->back();
        }

        $record = User::where('activation_code', $request->code)->orderBy('id', 'DESC')->first();


        if (isset($record)) {
            if ($record->is_verified == 1) {

                $data['records'] = FALSE;
                $data['layout'] = getLayout();
                $data['active_class'] = 'users';
                $data['heading'] = getPhrase('users');
                $data['title'] = getPhrase('users');
                // return view('users.list-users', $data);

                $view_name = getTheme() . '::users.list-users';

                if (checkRole(['parent'])) {
                    $user = getUserWithSlug();
                    $data['user'] = $user;
                    $view_name = getTheme() . '::parent.list-users';
                }

                return view($view_name, $data);

            } elseif ($record->is_verified = 1) {

                $record->save();

                $data['records'] = FALSE;
                $data['layout'] = getLayout();
                $data['active_class'] = 'users';
                $data['heading'] = getPhrase('users');
                $data['title'] = getPhrase('users');
                // return view('users.list-users', $data);

                $view_name = getTheme() . '::users.list-users';

                if (checkRole(['parent'])) {
                    $user = getUserWithSlug();
                    $data['user'] = $user;
                    $view_name = getTheme() . '::parent.list-users';
                }

                return view($view_name, $data);
            }
        } else {

            $message = getPhrase("Неверный код активации");
            flash('Ошибка', $message, 'error');
            return redirect()->back();
        }

    }

    public function activate()
    {

        if (!checkRole(getUserGrade(4))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['record'] = FALSE;
        $data['active_class'] = 'users';

        // $data['roles']        = $this->getUserRoles();
        $roles = \App\Role::select('display_name', 'id', 'name')->get();
        $final_roles = [];
        foreach ($roles as $role) {

            if (!checkRole(getUserGrade(1))) {

                if (!(strtolower($role->name) == 'admin' || strtolower($role->name) == 'owner'))
                    $final_roles[$role->id] = $role->display_name;
            } else
                $final_roles[$role->id] = $role->display_name;
        }
        $data['roles'] = $final_roles;
        $data['title'] = getPhrase('activate');
        if (checkRole(['parent']))
            $data['active_class'] = 'children';
        $data['layout'] = getLayout();

        // return view('users.add-edit-user', $data);

        $view_name = getTheme() . '::users.activate-user';
        return view($view_name, $data);

    }


    /**
     * This method returns the roles based on the user type logged in
     * @param  [type] $roles [description]
     * @return [type]        [description]
     */
    public function getUserRoles()
    {
        $roles = \App\Role::pluck('display_name', 'id');

        return array_where($roles, function ($key, $value) {
            if (!checkRole(getUserGrade(1))) {
                if (!($value == 'Admin' || $value == 'Owner'))
                    return $value;
            } else
                return $value;
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $columns = array(
            'name' => 'bail|required|',
            'email' => 'bail|unique:users,email',
            'phone' => 'bail|unique:users,phone',
            'image' => 'bail|mimes:png,jpg,jpeg|max:2048',
            'password' => 'bail|required|min:5',
            'password_confirmation' => 'bail|required|min:5|same:password',
        );
        

        if (checkRole(getUserGrade(2)))
            $columns['role_id'] = 'bail|required';


        $this->validate($request, $columns);

        $role_id = getRoleData('student');

        if ($request->role_id)
            $role_id = $request->role_id;

        $user = new User();
        $name = $request->name;
        $user->name = $name;
        $user->email = $request->email;
        $password = $request->password;
        $user->password = bcrypt($password);


        if (checkRole(['parent']))
            $user->parent_id = getUserWithSlug()->id;

        $user->role_id = $role_id;
        $user->login_enabled = 1;
        $user->phone = $request->phone;
        $user->address = $request->address;

        $user->activation_code = mt_rand(11111, 99999);
        $link = $user->activation_code;
        $slug = $user->phone;
        $user->slug = $slug;

        $user->save();


        $sms = "Код подтверждения";

        $phone = '996' . preg_replace('~[^0-9]+~', '', $user->phone);


        if (!env('DEMO_MODE')) {
            $user->roles()->attach($user->role_id);
            $this->processUpload($request, $user);
        }
        $message = getPhrase('record_added_successfully_with_password ');
        $exception = 0;
        try {
            if (!env('DEMO_MODE')) {
                new \App\Http\SmsSend($phone, $link, $sms);

                session(['var' => $phone]);
                session(['link' => $link]);
                session(['sms' => $sms]);

            }

            //$this->sendPushNotification($user);
        } catch (Exception $ex) {
            $message = getPhrase('record_added_successfully_with_password ');
            $message .= getPhrase('\ncannot_send_email_to_user, please_check_your_server_settings');
            $exception = 1;
        }

        $flash = app('App\Http\Flash');
        $flash->create('Success...!', $message, 'success', 'flash_overlay', FALSE);


        if (checkRole(['parent']))
            return redirect('users/activate');

        return redirect('users/activate');
    }


    public function sendPushNotification($user)
    {
        if (getSetting('push_notifications', 'module')) {
            if (getSetting('default', 'push_notifications') == 'pusher') {
                $options = array(
                    'name' => $user->name,
                    'image' => getProfilePath($user->image),
                    'slug' => $user->slug,
                    'role' => getRoleData($user->role_id),
                );

                pushNotification(['owner', 'admin'], 'newUser', $options);
            } else {
                $this->sendOneSignalMessage('New Registration');
            }
        }
    }

    /**
     * This method sends the message to admin via One Signal
     * @param string $message [description]
     * @return [type]          [description]
     */
    public function sendOneSignalMessage($new_message = '')
    {
        $gcpm = new OneSignalApp();

        $message = array(
            "en" => $new_message,
            "title" => 'New Registration',
            "icon" => "myicon",
            "sound" => "default"
        );
        $data = array(
            "body" => $new_message,
            "title" => "New Registration",
        );

        $gcpm->setDevices(env('ONE_SIGNAL_USER_ID'));
        $response = $gcpm->sendToAll($message, $data);
    }


    

    public function isValidRecord($record)
    {
        if ($record === null) {
            flash('Ooops...!', getPhrase("page_not_found"), 'error');
            return $this->getRedirectUrl();
        }

        return FALSE;
    }

    public function getReturnUrl()
    {
        return URL_USERS;
    }

    /**
     * Display the specified resource.
     *
     * @param unique string  $slug
     * @return Response
     */
    public function show($slug)
    {
        //
    }


    public function region()
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['records'] = FALSE;
        $data['layout'] = getLayout();
        $data['active_class'] = 'company';
        $data['heading'] = getPhrase('company');
        $data['title'] = getPhrase('company');

        $data['company'] = DB::table('company_name')->get();

        // return view('users.list-users', $data);

        $view_name = getTheme() . '::users.list-company';
        return view($view_name, $data);
    }


    public function addLocation(Request $request)
    {

        $date = date("Y-m-d H:i:S");

        $dslug = str_random(10);

        $company = $request->company_name;
        $company_slug = Str::slug($company . $dslug);

        $pharm = $request->pharm_name;
        $pharm_slug = Str::slug($pharm . $dslug);

        $region = $request->region_name;
        $region_slug = Str::slug($region . $dslug);

        if (!empty($company)) {

            $company_exist = DB::table('company_name')->where('company_name', $company)->first();

            if (empty($company_exist)) {
                DB::table('company_name')->insert(['company_name' => $company, 'company_display_name' => $company, 'slug' => $company_slug, 'created_at' => $date, 'updated_at' => $date]);
            }
        }

        if (!empty($pharm)) {

            $pharm_exist = DB::table('pharm_name')->where('pharm_name', $pharm)->where('region', $region)->where('company', $company)->first();

            if (empty($pharm_exist)) {
                DB::table('pharm_name')->insert(['pharm_name' => $pharm, 'pharm_display_name' => $pharm,
                    'region' => $region, 'company' => $company, 'slug' => $pharm_slug, 'created_at' => $date, 'updated_at' => $date]);
            }

        }

        if (!empty($region)) {

            $region_exist = DB::table('region_name')->where('region_name', $region)->where('company', $company)->first();

            if (empty($region_exist)) {
                DB::table('region_name')->insert(['region_name' => $region, 'region_display_name' => $region, 'company' => $company, 'slug' => $region_slug, 'created_at' => $date, 'updated_at' => $date]);
            }
        }


        flash('', 'Ваши данные успешно добавлены', 'success');
        return redirect(URL_USERS_REGION);

    }

    public function editLocation($slug)
    {

        if (!checkRole(getUserGrade(4))) {
            prepareBlockUserMessage();
            return back();
        }

        $company = DB::table('company_name')->where('slug', '=', $slug)->first();

        $pharm = DB::table('pharm_name')->where('slug', '=', $slug)->first();

        $region = DB::table('region_name')->where('slug', '=', $slug)->first();

        if (!empty($company)) {
            $data['record'] = $company;
        } elseif (!empty($pharm)) {
            $data['record'] = $pharm;
        } elseif (!empty($region)) {
            $data['record'] = $region;
        }

        $data['active_class'] = 'users';

        $data['title'] = getPhrase('edit_location');
        if (checkRole(['parent']))
            $data['active_class'] = 'children';
        $data['layout'] = getLayout();

        // return view('users.add-edit-user', $data);

        $view_name = getTheme() . '::users.add-location';
        return view($view_name, $data);
    }

    public function updateLocation(Request $request, $slug)
    {
        $dslug = str_random(10);

        $company = $request->company_name;
        $company_slug = Str::slug($company . $dslug);

        $pharm = $request->pharm_name;
        $pharm_slug = Str::slug($pharm . $dslug);

        $region = $request->region_name;
        $region_slug = Str::slug($region . $dslug);

        $date = date("Y-m-d H:i:S");

        if (!empty($company)) {

            $user = new User();

            $company123 = DB::table('company_name')
                ->where('slug', $slug)
                ->first();

            $user = User::where('company', $company123->company_name)
                ->update(['company' => $company]);

            DB::table('pharm_name')
                ->where('company', $company123->company_name)
                ->update(['company' => $company]);

            DB::table('region_name')
                ->where('company', $company123->company_name)
                ->update(['company' => $company]);

            DB::table('company_name')
                ->where('slug', $slug)
                ->update(['company_name' => $company, 'company_display_name' => $company, 'slug' => $company_slug, 'updated_at' => $date]);

        } elseif (!empty($pharm)) {

            $user = new User();

            $pharm123 = DB::table('pharm_name')
                ->where('slug', $slug)
                ->first();

            $user = User::where('region', $pharm123->region)
                ->where('company', $pharm123->company)
                ->where('pharm', $pharm123->pharm_name)
                ->update(['pharm' => $pharm]);

            DB::table('pharm_name')
                ->where('slug', $slug)
                ->where('region', $pharm123->region)
                ->where('company', $pharm123->company)
                ->update(['pharm_name' => $pharm, 'pharm_display_name' => $pharm, 'slug' => $pharm_slug, 'updated_at' => $date]);
        } elseif (!empty($region)) {

            $user = new User();

            $region123 = DB::table('region_name')
                ->where('slug', $slug)
                ->first();

            $user = User::where('region', $region123->region_name)->update(['region' => $region]);

            DB::table('pharm_name')
                ->where('region', $region123->region_name)
                ->update(['region' => $region]);

            DB::table('region_name')
                ->where('slug', $slug)
                ->update(['region_name' => $region, 'region_display_name' => $region, 'slug' => $region_slug, 'updated_at' => $date]);
        }

        flash('', 'Ваши данные успешно обновлены', 'success');
        return redirect(URL_USERS_REGION);
    }

    public function deleteLocation($slug)
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $company = DB::table('company_name')->where('slug', $slug)->first();
        $region = DB::table('region_name')->where('slug', $slug)->first();
        $pharm = DB::table('pharm_name')->where('slug', $slug)->first();

        $record = User::where('slug', $slug)->first();


        DB::table('company_name')->where('slug', $slug)->delete();
        DB::table('region_name')->where('slug', $slug)->delete();
        DB::table('pharm_name')->where('slug', $slug)->delete();

        $response['status'] = 1;
        $response['message'] = getPhrase('record_deleted_successfully');
        return json_encode($response);
    }

    public function settingsLocation($slug)
    {

        $company = DB::table('company_name')->where('slug', $slug)->first();
        $region = DB::table('region_name')->where('slug', $slug)->first();
        $pharm = DB::table('pharm_name')->where('slug', $slug)->first();

        if (!empty($company)) {
            $record = $company;
        }

        if (!empty($region)) {
            $record = $region;
        }

        if (!empty($pharm)) {
            $record = $pharm;
        }


        $data['record'] = $record;
        $data['quiz_categories'] = App\QuizCategory::get();
        $data['lms_category'] = App\LmsCategory::get();

        // dd($data);
        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        $data['heading'] = getPhrase('settings');
        $data['title'] = getPhrase('settings');
        // flash('success','record_added_successfully', 'success');
        // return view('users.account-settings', $data);

        $view_name = getTheme() . '::users.location-settings';
        return view($view_name, $data);

    }


    public function updateSettingsLocation(Request $request, $slug)
    {

        $company = DB::table('company_name')->where('slug', $slug)->first();
        $region = DB::table('region_name')->where('slug', $slug)->first();
        $pharm = DB::table('pharm_name')->where('slug', $slug)->first();

        if (!empty($company)) {
            $record = $company;
        }

        if (!empty($region)) {
            $record = $region;
        }

        if (!empty($pharm)) {
            $record = $pharm;
        }

        $options = [];

        if ($record->settings) {
            $options = (array)json_decode($record->settings)->user_preferences;

        }


        $options['quiz_categories'] = [];
        $options['lms_categories'] = [];
        if ($request->has('quiz_categories')) {
            foreach ($request->quiz_categories as $key => $value)
                $options['quiz_categories'][] = $key;
        }
        if ($request->has('lms_categories')) {
            foreach ($request->lms_categories as $key => $value)
                $options['lms_categories'][] = $key;
        }

        $record->settings = json_encode(array('user_preferences' => $options));


        $user = new User();

        if (!empty($company)) {
            $company = DB::table('company_name')->where('slug', $record->slug)->update(['settings' => $record->settings]);
            $user = User::where('company', $record->company_name)->get();
            // dd($user);
            foreach ($user as $com) {

                if ($request->has('quiz_categories')) {
                    

                    foreach ($request->quiz_categories as $key => $value)

                        $exams = DB::table('quizzes')->where('category_id', $key)->get();
                    
                    foreach ($exams as $exam) {

                        $db = DB::table('quizzes_attempts')->where('quizzes_id', $exam->id)->where('users_id', $com->id)->first();
                        // dd($db);
                        if (!$db) {
                            DB::table('quizzes_attempts')->insert(['quizzes_id' => $exam->id, 'users_id' => $com->id, 'attempts' => $exam->attempts]);
                        }

                    }

                }
                $com->settings = $record->settings;
                $com->save();
            }

        }

        if (!empty($region)) {
            $region = DB::table('region_name')->where('slug', $record->slug)->update(['settings' => $record->settings]);
            $user = User::where('region', $record->region_name)->get();
            foreach ($user as $reg) {

                if ($request->has('quiz_categories')) {

                    foreach ($request->quiz_categories as $key => $value)

                        $exams = DB::table('quizzes')->where('category_id', $key)->get();

                    foreach ($exams as $exam) {

                        $db = DB::table('quizzes_attempts')->where('quizzes_id', $exam->id)->where('users_id', $com->id)->first();

                        if (!$db) {
                            DB::table('quizzes_attempts')->insert(['quizzes_id' => $exam->id, 'users_id' => $com->id, 'attempts' => $exam->attempts]);
                        }

                    }

                }

                $reg->settings = $record->settings;
                $reg->save();
            }
        }

        if (!empty($pharm)) {
            $pharm = DB::table('pharm_name')->where('slug', $record->slug)->update(['settings' => $record->settings]);
            $user = User::where('pharm', $record->pharm_name)->get();
            foreach ($user as $pharm) {

                if ($request->has('quiz_categories')) {

                    foreach ($request->quiz_categories as $key => $value)

                        $exams = DB::table('quizzes')->where('category_id', $key)->get();

                    foreach ($exams as $exam) {

                        $db = DB::table('quizzes_attempts')->where('quizzes_id', $exam->id)->where('users_id', $com->id)->first();

                        if (!$db) {
                            DB::table('quizzes_attempts')->insert(['quizzes_id' => $exam->id, 'users_id' => $com->id, 'attempts' => $exam->attempts]);
                        }

                    }

                }

                $pharm->settings = $record->settings;
                $pharm->save();
            }
        }


        flash('', 'Данные успешно обновлены', 'success');
        return redirect(URL_USERS_REGION);

    }

    public function createLocation()
    {

        if (!checkRole(getUserGrade(4))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['record'] = FALSE;
        $data['active_class'] = 'users';

        $data['title'] = getPhrase('add_location');
        if (checkRole(['parent']))
            $data['active_class'] = 'children';
        $data['layout'] = getLayout();

        // return view('users.add-edit-user', $data);

        $view_name = getTheme() . '::users.add-location';
        return view($view_name, $data);
    }

    public function regionDetails($slug)
    {
        // $record = User::where('company',$slug)->orWhere('pharm', $slug)->orWhere('region', $slug)->get();

        $record = DB::table('region_name')->where('company', $slug)->get();

        $data['record'] = $record;
        $data['slug'] = $slug;

        $data['title'] = getPhrase('region');
        $data['layout'] = getLayout();
        $data['active_class'] = 'users';

        $view_name = getTheme() . '::users.region-details';
        return view($view_name, $data);

    }

    public function companyDetails($slug)
    {

        $region = DB::table('region_name')->where('id', $slug)->first();

        $company = $region->company;
        $region = $region->region_name;

        $pharm = DB::table('pharm_name')->where('company', $company)->where('region', $region)->get();

        $data['record'] = $pharm;
        $data['title'] = getPhrase('pharm');
        $data['layout'] = getLayout();
        $data['active_class'] = 'pharm';

        $view_name = getTheme() . '::users.pharm-details';
        return view($view_name, $data);
    }

    public function userDetails($slug)
    {

        $pharm = DB::table('pharm_name')->where('id', $slug)->first();

        $pharm_name = $pharm->pharm_name;
        $region = $pharm->region;
        $company = $pharm->company;

        $user = new User();

        $record = User::where('pharm', $pharm_name)->where('region', $region)->where('company', $company)->get();

        $data['record'] = $record;
        $data['title'] = getPhrase('users');
        $data['layout'] = getLayout();
        $data['active_class'] = 'users';

        $view_name = getTheme() . '::users.pharm-details-users';
        return view($view_name, $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param unique string  $slug
     * @return Response
     */
    public function edit($slug)
    {
        $record = User::where('slug', $slug)->get()->first();
        // dd($record);

        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);
        /**
         * Validate the non-admin user wether is trying to access other user profile
         * If so return the user back to previous page with message
         */

        if (!isEligible($slug))
            return back();


        /**
         * Make sure the Admin or staff cannot edit the Admin/Owner accounts
         * Only Owner can edit the Admin/Owner profiles
         * Admin can edit his own account, in that case send role type admin on condition
         */

        $UserOwnAccount = FALSE;
        if (\Auth::user()->id == $record->id)
            $UserOwnAccount = TRUE;

        if (!$UserOwnAccount) {
            $current_user_role = getRoleData($record->role_id);

            if ((($current_user_role == 'admin' || $current_user_role == 'owner'))) {
                if (!checkRole(getUserGrade(1))) {
                    prepareBlockUserMessage();
                    return back();
                }
            }
        }

        $data['record'] = $record;

        // dd($_POST);
        // $data['roles']              = $this->getUserRoles();

        $roles = \App\Role::select('display_name', 'id', 'name')->get();
        $final_roles = [];
        foreach ($roles as $role) {

            if (!checkRole(getUserGrade(1))) {

                if (!(strtolower($role->name) == 'admin' || strtolower($role->name) == 'owner'))
                    $final_roles[$role->id] = $role->display_name;
            } else
                $final_roles[$role->id] = $role->display_name;
        }
        $data['roles'] = $final_roles;


        $pharm = DB::table('pharm_name')->select('pharm_display_name', 'pharm_name')->get();

        if ($_GET['company'] ?? null) {

            $region = DB::table('region_name')->where('company', $_GET['company'])->get();


            return response()->json($region);

        }

        // dd($_GET);
        // if ($_GET ?? null) {

        //     $pharm = DB::table('pharm_name')->where('region', $_GET['region'])->where('company', $_GET['com'])->get();

        //     return response()->json($pharm);

        // }

        $company = DB::table('company_name')->select('company_display_name', 'company_name')->get();

        $region = DB::table('region_name')->select('region_display_name', 'region_name')->get();

        $final_pharm = [];

        $final_company = [];

        $final_region = [];

        // Company //
        foreach ($company as $val) {
            $final_company[$val->company_name] = $val->company_display_name;
        }
        $data['company'] = $final_company;

        $data['selected_company'] = $record->company;

        foreach ($final_company as $key => $value) {
            if ($key == $record->company) {
                $data['selected_company_id'] = $value;
            }

        }

        // End Company //


        // Region //
        foreach ($region as $val) {
            $final_region[$val->region_name] = $val->region_display_name;
        }
        $data['region'] = $final_region;

        $data['selected_region'] = $record->region;

        foreach ($final_region as $key => $value) {
            if ($key == $record->region) {
                $data['selected_region_id'] = $value;
            }

        }

        // End Region //


        // Pharm //
        foreach ($pharm as $val) {
            $final_pharm[$val->pharm_name] = $val->pharm_display_name;
        }
        $data['pharm'] = $final_pharm;

        $data['selected_pharm'] = $record->pharm;

        foreach ($final_pharm as $key => $value) {
            if ($key == $record->pharm) {
                $data['selected_pharm_id'] = $value;
            }

        }

        // $selected_pharm_id = $data['selected_pharm_id'];
        // return view('students.select-student', ['students'=> $students]);
        // End Pharm //


        if ($record->parent_id !== null) {
            $parent = getUserRecord($record->parent_id);
            $record->parent = $parent->name ?? null;
        }


        if ($UserOwnAccount && checkRole(['admin']))
            $data['roles'][getRoleData('admin')] = 'Admin';

        $data['active_class'] = 'users';
        $data['title'] = getPhrase('edit_user');
        $data['layout'] = getLayout();
        // dd($data);
        // return view('users.add-edit-user', $data);

        $view_name = getTheme() . '::users.add-edit-user';
        return view($view_name, $data);
        // dd($data);
    }

    protected function processUpload(Request $request, User $user)
    {
        if (env('DEMO_MODE')) {
            return 'demo';
        }

        if ($request->hasFile('image')) {

            $imageObject = new ImageSettings();

            $destinationPath = $imageObject->getProfilePicsPath();
            $destinationPathThumb = $imageObject->getProfilePicsThumbnailpath();

            $fileName = $user->id . '.' . $request->image->guessClientExtension();;
            $request->file('image')->move($destinationPath, $fileName);
            $user->image = $fileName;

            Image::make($destinationPath . $fileName)->fit($imageObject->getProfilePicSize())->save($destinationPath . $fileName);

            Image::make($destinationPath . $fileName)->fit($imageObject->getThumbnailSize())->save($destinationPathThumb . $fileName);
            $user->save();
        }

        if ($request->hasFile('verify_images')) {
            $imageObject = new ImageSettings();
            $destinationPath = $imageObject->getProfilePicsPath();
            $fdocs = $request->file('verify_images');
            $allowedfileExtension=['pdf','jpg','png','docx'];

            foreach($fdocs as $key => $docs  ){
                $extension = $docs->getClientOriginalExtension();
                $filename = $user->id.'-'.uniqid('img_').'.'.$extension;
                $docs->move($destinationPath, $filename);
                // $check=in_array( $extension, $allowedfileExtension);
                $userdocs[$key]['filename'] = $filename;                    
            } 
            if(!$user->field_of_interest){
                $user->field_of_interest =  str_replace("'", "\'", json_encode($userdocs));
                $user->save();
            }else {
                $userdata[] = json_decode($user->field_of_interest); //old
                foreach($userdata[0] as $key => $docs  ){
                    $userdata1[$key]['filename'] = $docs->filename;  
                }
                $updata = array_merge( $userdocs, $userdata1);
                $user->field_of_interest =  str_replace("'", "\'", json_encode($updata));
                $user->save();
            }

            return redirect(URL_USERS_EDIT . $user->slug);
            

        }
            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        // dd(Input::all());
        $record = User::where('slug', $slug)->get()->first();
        if (checkRole(getUserGrade(9))) {
            $required = 'required';
         }else{
             $required = '';
         }
        

        $validation = [
            'name' => 'required',
            'company' => 'required',
            'whatsapp_phone' => 'required',
            'verify_images' => $required,
        ];

        // if (!isEligible($slug))
        //     return back();

        // if (checkRole(getUserGrade(2)))
        //     $validation['role_id'] = 'bail|required|integer';


        $this->validate($request, $validation);
       

        $name = $request->name;
        $previous_role_id = $record->role_id;
        



        // if ($role == 5) {
        //  $parent = User::where('region', $request->region)
        //  ->where('company', $request->company)
        //  ->where('pharm', $request->pharm)
        //  ->where('role_id', 8)->first();
        //  $record->parent_id = $parent->id ?? null;
        // }
        // if ($role == 8) {
        //  $parent = User::where('region', $request->region)
        //  ->where('company', $request->company)
        //  // ->where('pharm', $request->pharm)
        //  ->where('role_id', 7)->first();
        //  $record->parent_id = $parent->id ?? null;
        // }
        // if ($role == 7) {
        //  $parent = User::where('region', $request->region)
        //  // ->where('company', $request->company)
        //  // ->where('pharm', $request->pharm)
        //  ->where('role_id', 6)->first();
        //  $record->parent_id = $parent->id ?? null;
        // }

        $setting = DB::table('company_name')->where('company_name', $request->company)->first();
        
        

        if (isset($setting->settings)) {
            $asd = json_decode($setting->settings);

            if (isset($asd->user_preferences->quiz_categories)) {
                foreach ($asd->user_preferences->quiz_categories as $key => $value) {

                    $exams = DB::table('quizzes')->where('category_id', $value)->get();

                    foreach ($exams as $exam) {

                        $db = DB::table('quizzes_attempts')->where('quizzes_id', $exam->id)->where('users_id', $record->id)->first();

                        if (!$db) {
                            DB::table('quizzes_attempts')->insert(['quizzes_id' => $exam->id, 'users_id' => $record->id, 'attempts' => $exam->attempts]);
                        }

                    }
                }
            }

        }

        $record->name = $name;

        $record->settings = $setting->settings ?? null;
        $record->company = $request->company;
        $record->region = $request->region;
        $record->pharm = $request->pharm;
        $record->email = $request->email;
        // $record->parent_id = $request->parent_id;
        // $record->slug = $request->phone;
        $record->whatsapp_phone = $request->whatsapp_phone;
        // $record->created_at = $request->created_at;
        
        if(checkRole(getUserGrade(9)))
        $record->college_place = $request->college_place;
        
        // dd($record->name);

        if (checkRole(getUserGrade(2))){
            $record->role_id = $request->role_id;
            $record->phone = $request->phone;
            $record->slug = $request->phone;
        }
        
        // $record->address = $request->address;
        $record->save();
        if ($request->password) {
            $password = $request->password;
            $record->password = bcrypt($password);
            $record->save();
        }


        if (checkRole(getUserGrade(2))) {
            /**
             * Delete the Roles associated with that user
             * Add the new set of roles
             */

            if (!env('DEMO_MODE')) {
                DB::table('role_user')
                    ->where('user_id', '=', $record->id)
                    ->where('role_id', '=', $previous_role_id)
                    ->delete();

                $record->roles()->attach($request->role_id);
            }
        }
        if (!env('DEMO_MODE')) {
            $this->processUpload($request, $record);
        }
        flash('', 'Ваши данные успешно обновлены', 'success');
        // return redirect('users/edit/'.$record->slug);

        if (checkRole(getUserGrade(2))) {
            return redirect(URL_USERS);
        } else {
            return redirect(URL_USERS_EDIT . $record->slug);
        }

        return redirect(URL_USERS_EDIT . $record->slug);
        
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param unique string  $slug
     * @return Response
     */
    /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean
     */
    public function delete($slug)
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $record = User::where('slug', $slug)->first();

        $attempts = DB::table('quizzes_attempts')->where('users_id', $record->id)->delete();

        /**
         * Check if any exams exists with this category,
         * If exists we cannot delete the record
         */
        if (!env('DEMO_MODE')) {
            $imageObject = new ImageSettings();

            $destinationPath = $imageObject->getProfilePicsPath();
            $destinationPathThumb = $imageObject->getProfilePicsThumbnailpath();

            $this->deleteFile($record->image, $destinationPath);
            $this->deleteFile($record->image, $destinationPathThumb);
            $record->delete();
        }
        $response['status'] = 1;
        $response['message'] = getPhrase('record_deleted_successfully');
        return json_encode($response);

    }

    public function deleteFile($record, $path, $is_array = FALSE)
    {
        if (env('DEMO_MODE')) {
            return;
        }

        $files = array();
        $files[] = $path . $record;
        File::delete($files);
    }


    public function listUsers($role_name)
    {
        $role = App\Role::getRoleId($role_name);

        $users = User::where('role_id', '=', $role->id)->get();

        $users_list = array();

        foreach ($users as $key => $value) {
            $r = array('id' => $value->id, 'text' => $value->name, 'image' => $value->image);
            array_push($users_list, $r);
        }
        return json_encode($users_list);
    }

    public function details($slug)
    {
        $record = User::where('slug', $slug)->get()->first();
        $user = getUserWithSlug();
        $data['user'] = $record;
        // dd($record);
        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);

        /**
         * Validate the non-admin user wether is trying to access other user profile
         * If so return the user back to previous page with message
         */

        // if(!isEligible($slug))
        //   return back();

        $data['record'] = $record;

        $user = $record;
        //Overall performance Report
        $resultObject = new App\QuizResult();
        $records = $resultObject->getOverallSubjectsReport($user);
        $color_correct = getColor('background', rand(0, 999));
        $color_wrong = getColor('background', rand(0, 999));
        $color_not_attempted = getColor('background', rand(0, 999));
        $correct_answers = 0;
        $wrong_answers = 0;
        $not_answered = 0;

        foreach ($records as $record) {
            $record = (object)$record;
            $correct_answers += $record->correct_answers;
            $wrong_answers += $record->wrong_answers;
            $not_answered += $record->not_answered;

        }

        $labels = [getPhrase('correct'), getPhrase('wrong'), getPhrase('not_answered')];
        $dataset = [$correct_answers, $wrong_answers, $not_answered];
        $dataset_label[] = 'lbl';
        $bgcolor = [$color_correct, $color_wrong, $color_not_attempted];
        $border_color = [$color_correct, $color_wrong, $color_not_attempted];
        $chart_data['type'] = 'pie';
        //horizontalBar, bar, polarArea, line, doughnut, pie
        $chart_data['title'] = getphrase('overall_performance');

        $chart_data['data'] = (object)array(
            'labels' => $labels,
            'dataset' => $dataset,
            'dataset_label' => $dataset_label,
            'bgcolor' => $bgcolor,
            'border_color' => $border_color
        );

        $data['chart_data'][] = (object)$chart_data;

        //Best scores in each quizzes
        $records = $resultObject->getOverallQuizPerformance($user);
        $labels = [];
        $dataset = [];
        $bgcolor = [];
        $bordercolor = [];

        foreach ($records as $record) {
            $color_number = rand(0, 999);
            $record = (object)$record;
            $labels[] = $record->title;
            $dataset[] = $record->percentage;
            $bgcolor[] = getColor('background', $color_number);
            $bordercolor[] = getColor('border', $color_number);
        }

        $labels = $labels;
        $dataset = $dataset;
        $dataset_label = getPhrase('performance');
        $bgcolor = $bgcolor;
        $border_color = $bordercolor;
        $chart_data['type'] = 'bar';
        //horizontalBar, bar, polarArea, line, doughnut, pie
        $chart_data['title'] = getPhrase('best_performance_in_all_quizzes');

        $chart_data['data'] = (object)array(
            'labels' => $labels,
            'dataset' => $dataset,
            'dataset_label' => $dataset_label,
            'bgcolor' => $bgcolor,
            'border_color' => $border_color
        );

        $data['chart_data'][] = (object)$chart_data;

        $data['ids'] = array('myChart0', 'myChart1');
        $data['title'] = getPhrase('user_details');
        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        if (checkRole(['parent']))
            $data['active_class'] = 'children';


        //   $data['right_bar']          = TRUE;

        // $data['right_bar_path']     = 'student.exams.right-bar-performance-chart';
        // $data['right_bar_data']     = array('chart_data' => $data['chart_data']);

        // return view('users.user-details', $data);

        $view_name = getTheme() . '::users.user-details';
        return view($view_name, $data);

    }


    public function getDatatableDetails($slug)
    {
        $records = array();
        $user = getUserWithSlug($slug);

        $records = User::select(['name', 'phone', 'image', 'slug', 'id'])->where('parent_id', '=', $user->id)->get();


        return Datatables::of($records)
            ->addColumn('action', function ($records) {
                $buy_package = '';

                if (!isSubscribed('main', $records->slug) == 1)
                    // $buy_package =    '<li><a href="'.URL_SUBSCRIBE.$records->slug.'"><i class="fa fa-credit-card"></i>'.getPhrase("buy_package").'</a></li>';


                    return '<div class="dropdown more">
      <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="mdi mdi-dots-vertical"></i>
      </a>
      <ul class="dropdown-menu" aria-labelledby="dLabel">
      <li><a href="' . URL_USERS_EDIT . $records->slug . '"><i class="fa fa-pencil"></i>' . getPhrase("edit") . '</a></li>

      </ul>
      </div>';
            })
            ->editColumn('name', function ($records) {
                return '<a href="' . URL_USER_DETAILS . $records->slug . '" title="' . $records->name . '">' . ucfirst($records->name) . '</a>';
            })
            ->editColumn('image', function ($records) {
                return '<img src="' . getProfilePath($records->image) . '"  />';
            })
            ->removeColumn('slug')
            ->removeColumn('id')
            ->make();
    }


    /**
     * This method will show the page for change password for user
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function changePassword($slug)
    {

        $record = User::where('slug', $slug)->get()->first();

        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);
        /**
         * Validate the non-admin user wether is trying to access other user profile
         * If so return the user back to previous page with message
         */

        if (!isEligible($slug))
            return back();

        $data['record'] = $record;
        $data['active_class'] = 'profile';
        $data['title'] = getPhrase('change_password');
        $data['layout'] = getLayout();
        // return view('users.change-password.change-view', $data);

        $view_name = getTheme() . '::users.change-password.change-view';
        return view($view_name, $data);
    }

    /**
     * This method updates the password submitted by the user
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function updatePassword(Request $request)
    {


        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $credentials = $request->only(
            'old_password', 'password', 'password_confirmation'
        );
        $user = \Auth::user();


        if (Hash::check($credentials['old_password'], $user->password)) {
            $password = $credentials['password'];
            $user->password = bcrypt($password);
            $user->save();
            flash('', 'Пароль успешно изменен', 'success');
            return redirect(URL_USERS_CHANGE_PASSWORD . $user->slug);

        } else {

            flash('Ошибка', 'Неверный Пароль');
            return redirect()->back();
        }
    }

    /**
     * Display a Import Users page
     *
     * @return Response
     */
    public function importUsers($role = 'student')
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['records'] = FALSE;
        $data['active_class'] = 'users';
        $data['heading'] = getPhrase('users');
        $data['title'] = getPhrase('import_users');
        $data['layout'] = getLayout();
        // return view('users.import.import', $data);

        $view_name = getTheme() . '::users.import.import';
        return view($view_name, $data);
    }

    public function readExcel(Request $request)
    {

        $columns = array(
            'excel' => 'bail|required',
        );

        $this->validate($request, $columns);

        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        $success_list = [];
        $failed_list = [];

        try {
            if (Input::hasFile('excel')) {
                $path = Input::file('excel')->getRealPath();
                $data = Excel::load($path, function ($reader) {
                })->get();

                $user_record = array();
                $users = array();
                $isHavingDuplicate = 0;
                if (!empty($data) && $data->count()) {

                    foreach ($data as $key => $value) {

                        foreach ($value as $record) {
                            unset($user_record);

                            $user_record['username'] = $record->username;
                            $user_record['name'] = $record->name;
                            $user_record['email'] = $record->email;

                            $user_record['password'] = $record->password;
                            $user_record['phone'] = $record->phone;
                            $user_record['address'] = $record->address;
                            $user_record['role_id'] = STUDENT_ROLE_ID;

                            $user_record = (object)$user_record;
                            $failed_length = count($failed_list);
                            if ($this->isRecordExists($record->username, 'username')) {

                                $isHavingDuplicate = 1;
                                $temp = array();
                                $temp['record'] = $user_record;
                                $temp['type'] = 'Record already exists with this name';
                                $failed_list[$failed_length] = (object)$temp;
                                continue;
                            }

                            if ($this->isRecordExists($record->email, 'email')) {
                                $isHavingDuplicate = 1;
                                $temp = array();
                                $temp['record'] = $user_record;
                                $temp['type'] = 'Record already exists with this email';
                                $failed_list[$failed_length] = (object)$temp;
                                continue;
                            }

                            $users[] = $user_record;

                        }

                    }
                    if ($this->addUser($users))
                        $success_list = $users;
                }
            }


            $this->excel_data['failed'] = $failed_list;
            $this->excel_data['success'] = $success_list;

            flash('success', 'record_added_successfully', 'success');
            $this->downloadExcel();

        } catch (Exception $e) {
            if (getSetting('show_foreign_key_constraint', 'module')) {

                flash('oops...!', $e->errorInfo, 'error');
            } else {
                flash('oops...!', 'improper_sheet_uploaded', 'error');
            }

            return back();
        }

        // URL_USERS_IMPORT_REPORT
        $data['failed_list'] = $failed_list;
        $data['success_list'] = $success_list;
        $data['records'] = FALSE;
        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        $data['heading'] = getPhrase('users');
        $data['title'] = getPhrase('report');

        // return view('users.import.import-result', $data);

        $view_name = getTheme() . '::users.import.import-result';
        return view($view_name, $data);

    }

    public function getFailedData()
    {
        return $this->excel_data;
    }

    public function downloadExcel()
    {

        Excel::create('users_report', function ($excel) {
            $excel->sheet('Failed', function ($sheet) {
                $sheet->row(1, array('Reason', 'Name', 'Username', 'Email', 'Password', 'Phone', 'Address'));
                $data = $this->getFailedData();
                $cnt = 2;
                // dd($data['failed']);
                foreach ($data['failed'] as $data_item) {
                    $item = $data_item->record;
                    $sheet->appendRow($cnt++, array($data_item->type, $item->name, $item->username, $item->email, $item->password, $item->phone, $item->address));
                }
            });

            $excel->sheet('Success', function ($sheet) {
                $sheet->row(1, array('Name', 'Username', 'Email', 'Password', 'Phone', 'Address'));
                $data = $this->getFailedData();
                $cnt = 2;
                foreach ($data['success'] as $data_item) {
                    $item = $data_item;
                    $sheet->appendRow($cnt++, array($item->name, $item->username, $item->email, $item->password, $item->phone, $item->address));
                }

            });

        })->download('xlsx');

        return TRUE;
    }

    /**
     * This method verifies if the record exists with the email or user name
     * If Exists it returns true else it returns false
     * @param  [type]  $value [description]
     * @param string $type [description]
     * @return boolean        [description]
     */
    public function isRecordExists($record_value, $type = 'email')
    {
        return User::where($type, '=', $record_value)->get()->count();
    }

    public function addUser($users)
    {
        foreach ($users as $request) {
            $user = new User();
            $name = $request->name;
            $user->name = $name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);

            $user->role_id = $request->role_id;
            $user->login_enabled = 1;
            $user->slug = $user::makeSlug($name);
            $user->phone = $request->phone;
            $user->address = $request->address;

            $user->activation_code = str_random(30);
            $link = URL_USERS_CONFIRM . $user->activation_code;

            $user->save();

            $user->roles()->attach($user->role_id);

            if (!env('DEMO_MODE')) {
                try {

                    $user->notify(new \App\Notifications\NewUserRegistration($user, $user->email, $request->password, $link));


                } catch (Exception $e) {
                    // dd($e->getMessage());
                }
            }

        }
        return true;
    }


    public function settingsAttempts($slug)
    {
        $array = '';

        $record = User::where('slug', $slug)->first();

        $attempts = DB::table('quizzes_attempts')->where('users_id', $record->id)->get();

        $data['array'] = $attempts;

        $data['user'] = $record;

        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        $data['heading'] = getPhrase('account_settings');
        $data['title'] = getPhrase('account_settings');

        $view_name = getTheme() . '::users.attempts';

        return view($view_name, $data);
    }

    public function addAttempts($slug, $user)
    {

        $record = DB::table('quizzes_attempts')->where('id', $slug)->first();

        $data['record'] = $record;

        $data['user'] = $user;

        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        $data['heading'] = getPhrase('account_settings');
        $data['title'] = getPhrase('account_settings');

        $view_name = getTheme() . '::users.add-attempts';

        return view($view_name, $data);
    }

    public function updateAttempts(Request $request, $slug, $user)
    {
        $record = DB::table('quizzes_attempts')->where('id', $slug)->update(['attempts' => $request->attempts]);

        flash('', 'Данные успешно обновлены', 'success');
        return redirect(URL_USERS_ATTEMPTS . $user);
    }

    /**
     * This method shows the user preferences based on provided user slug and settings available in table.
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function settings($slug)
    {
        $record = User::where('slug', $slug)->first();

        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);
        /**
         * Validate the non-admin user wether is trying to access other user profile
         * If so return the user back to previous page with message
         */

        if (!isEligible($slug))
            return back();


        /**
         * Make sure the Admin or staff cannot edit the Admin/Owner accounts
         * Only Owner can edit the Admin/Owner profiles
         * Admin can edit his own account, in that case send role type admin on condition
         */

        $UserOwnAccount = FALSE;
        if (\Auth::user()->id == $record->id)
            $UserOwnAccount = TRUE;

        if (!$UserOwnAccount) {
            $current_user_role = getRoleData($record->role_id);

            if ((($current_user_role == 'admin' || $current_user_role == 'owner'))) {
                if (!checkRole(getUserGrade(1))) {
                    prepareBlockUserMessage();
                    return back();
                }
            }

        }


        $data['record'] = $record;
        $data['quiz_categories'] = App\QuizCategory::get();
        $data['lms_category'] = App\LmsCategory::get();

        // dd($data);
        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        $data['heading'] = getPhrase('account_settings');
        $data['title'] = getPhrase('account_settings');
        // flash('success','record_added_successfully', 'success');
        // return view('users.account-settings', $data);

        $view_name = getTheme() . '::users.account-settings';
        return view($view_name, $data);

    }

    /**
     * This method updates the user preferences based on the provided categories
     * All these settings will be stored under Users table settings field as json format
     * @param Request $request [description]
     * @param  [type]  $slug    [description]
     * @return [type]           [description]
     */
    public function updateSettings(Request $request, $slug)
    {

        $record = User::where('slug', $slug)->first();

        $exams = [];

        if ($request->has('quiz_categories')) {

            foreach ($request->quiz_categories as $key => $value) {
                $exams[] = DB::table('quizzes')->where('category_id', $key)->get();
            }


            foreach ($exams as $exam) {

                if (count($exam) > 0) {
                    foreach ($exam as $ex) {
                        $db1 = DB::table('quizzes_attempts')->where('quizzes_id', $ex->id)->where('users_id', $record->id)->first();

                        if (!$db1) {
                            DB::table('quizzes_attempts')->insert(['quizzes_id' => $ex->id, 'users_id' => $record->id, 'attempts' => $ex->attempts]);
                        }
                    }
                } else {
                    $db = DB::table('quizzes_attempts')->where('quizzes_id', $exam->id)->where('users_id', $record->id)->first();

                    if (!$db) {
                        DB::table('quizzes_attempts')->insert(['quizzes_id' => $exam->id, 'users_id' => $record->id, 'attempts' => $exam->attempts]);
                    }
                }

            }


        }


        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);
        /**
         * Validate the non-admin user wether is trying to access other user profile
         * If so return the user back to previous page with message
         */

        if (!isEligible($slug))
            return back();


        /**
         * Make sure the Admin or staff cannot edit the Admin/Owner accounts
         * Only Owner can edit the Admin/Owner profiles
         * Admin can edit his own account, in that case send role type admin on condition
         */

        $UserOwnAccount = FALSE;
        if (\Auth::user()->id == $record->id)
            $UserOwnAccount = TRUE;

        if (!$UserOwnAccount) {
            $current_user_role = getRoleData($record->role_id);

            if ((($current_user_role == 'admin' || $current_user_role == 'owner'))) {
                if (!checkRole(getUserGrade(1))) {
                    prepareBlockUserMessage();
                    return back();
                }
            }
        }

        $options = [];
        if ($record->settings) {
            $options = (array)json_decode($record->settings)->user_preferences;

        }

        $options['quiz_categories'] = [];
        $options['lms_categories'] = [];
        if ($request->has('quiz_categories')) {
            foreach ($request->quiz_categories as $key => $value)
                $options['quiz_categories'][] = $key;
        }
        if ($request->has('lms_categories')) {
            foreach ($request->lms_categories as $key => $value)
                $options['lms_categories'][] = $key;
        }

        $record->settings = json_encode(array('user_preferences' => $options));

        $child = User::where('parent_id', $record->id)->get();


        foreach ($child as $val) {

            $child1 = User::where('parent_id', $val->id)->get();

            foreach ($child1 as $val1) {

                $child2 = User::where('parent_id', $val1->id)->get();

                foreach ($child2 as $val2) {
                    $val2->settings = $record->settings;
                    $val2->save();
                }

                $val1->settings = $record->settings;
                $val1->save();

            }


            $val->settings = $record->settings;
            $val->save();
        }
        $record->save();

        flash('', 'Данные успешно обновлены', 'success');
        return redirect(URL_USERS);
    }


    public function viewParentDetails($slug)
    {
        if (!checkRole(getUserGrade(4))) {
            prepareBlockUserMessage();
            return back();
        }

        $record = User::where('slug', '=', $slug)->first();

        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);


        if ($record->role_id) {
            $first = User::where('role_id', '8')->orWhere('role_id', '7')->orWhere('role_id', '6')->get();
            $second = User::where('role_id', '8')->orWhere('role_id', '7')->orWhere('role_id', '6')->get();
        }
        // elseif ($record->role_id == '8') {
        //   $arr = User::where('role_id', '7')->get();
        // }
        // elseif ($record->role_id == '7') {
        //   $arr = User::where('role_id', '6')->get();
        // }


        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        $data['record'] = $record;

        $data['heading'] = getPhrase('parent_details');
        $data['title'] = getPhrase('parent_details');


        $data['parent'] = array_pluck($first, 'name', 'id');

        $data['second'] = array_pluck($second, 'name', 'id');


        // return view('users.parent-details', $data);

        $view_name = getTheme() . '::users.parent-details';
        return view($view_name, $data);
    }

    public function updateParentDetails(Request $request, $slug)
    {

        if (!checkRole(getUserGrade(4))) {
            prepareBlockUserMessage();
            return back();
        }

        $user = User::where('slug', '=', $slug)->first();
        $parent = User::where('id', '=', $request->parent)->first();


        if (!empty($request->second)) {
            $second = User::where('id', '=', $request->second)->first();
            $data = json_decode($second->settings);
            $data1 = json_decode($parent->settings);

            $finish['quiz_categories'] = [];
            $finish['lms_categories'] = [];
            $finish['quiz_categories'] = array_values(array_unique(array_merge($data->user_preferences->quiz_categories, $data1->user_preferences->quiz_categories)));
            $finish['lms_categories'] = array_values(array_unique(array_merge($data->user_preferences->lms_categories, $data1->user_preferences->lms_categories)));
            $array = json_encode(array('user_preferences' => $finish));

            $user->settings = $array;

            $user->parent_id = $request->parent;
            $user->second_parent = $request->second;
            $user->save();

        } else {
            $user->settings = $parent->settings;
            $role_id = getRoleData('parent');
            $message = '';
            $hasError = 0;

            $user->parent_id = $request->parent;

            $user->save();
        }


        flash('', 'Данные успешно обновлены', 'success');
        return redirect(URL_USERS);
    }

    public function getParentsOnSearch(Request $request)
    {
        $term = $request->search_text;
        $role_id = getRoleData('parent');
        $records = App\User::
        where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('username', 'LIKE', '%' . $term . '%')
            ->orWhere('phone', 'LIKE', '%' . $term . '%')
            ->groupBy('id')
            ->havingRaw('role_id=' . $role_id)
            ->select(['id', 'role_id', 'name', 'username', 'email', 'phone'])
            ->get();
        return json_encode($records);
    }


    /**
     * Course listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function SubscribedUsers()
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['active_class'] = 'users';
        $data['title'] = getPhrase('subscribed_users');
        // return view('exams.quizcategories.list', $data);

        $view_name = getTheme() . '::users.subscribeduser';
        return view($view_name, $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function SubscribersData()
    {

        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $records = array();


        $records = App\UserSubscription::select(['email', 'created_at'])
            ->orderBy('updated_at', 'desc');


        return Datatables::of($records)
            ->make();

    }


    public function changeStatus($slug)
    {
        if (!checkRole(getUserGrade(1))) {
            prepareBlockUserMessage();
            return back();
        }

        $record = User::where('slug', $slug)->first();

        /**
         * Check if any exams exists with this category,
         * If exists we cannot delete the record
         */
        if (!env('DEMO_MODE')) {


            $previous_status = $record->login_enabled;
            if ($previous_status)
                $record->login_enabled = 0;
            else
                $record->login_enabled = 1;

            $record->save();


            $message = getPhrase('status_successfully_changed');

        }


        $response['status'] = 1;
        $response['message'] = $message;
        return json_encode($response);
    }

}
