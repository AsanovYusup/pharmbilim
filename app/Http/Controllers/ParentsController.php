<?php

namespace App\Http\Controllers;

use \App;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Yajra\Datatables\Datatables;
use DB;
use Excel;
use App\Quiz;

class ParentsController extends Controller
{
    public function __construct()
    {
        $currentUser = \Auth::user();


        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $user = getUserWithSlug();

        if (!checkRole(getUserGrade(7))) {
            prepareBlockUserMessage();
            return back();
        }

        if (!isEligible($user->slug))
            return back();

        $data['records'] = FALSE;
        $data['user'] = $user;
        $data['title'] = getPhrase('children');
        $data['active_class'] = 'children';
        $data['layout'] = getLayout();
        // return view('parent.list-users', $data);

        $view_name = getTheme() . '::parent.list-users';
        return view($view_name, $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */

    public function getDatatable($slug)
    {
        $records = array();
        $user = getUserWithSlug($slug);

        $records = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->select(['users.name', 'users.phone', 'users.company', 'users.region', 'users.pharm', 'roles.display_name', 'users.slug', 'users.id'])
            ->where('parent_id', '=', $user->id)
            ->orWhere('second_parent', '=', $user->id)
            ->get();


        return Datatables::of($records)
            ->addColumn('action', function ($records) {
                $buy_package = '';

                if (!isSubscribed('main', $records->slug) == 1)
                    // $buy_package =    '<li><a href="'.URL_SUBSCRIBE.$records->slug.'"><i class="fa fa-credit-card"></i>'.getPhrase("buy_package").'</a></li>';

                    return '<div class="col text-center"><div class="btn-group">
                        <button type="button" class="btn btn-xs btn-success btn-icon rounded waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fal fa-cog"></i>
                        </button>
                        <div class="dropdown-menu">
                           <a class="dropdown-item" href="' . URL_USERS_EDIT . $records->slug . '"><i class="fal fa-pencil"></i> ' . getPhrase("edit") . '</a>

                        </div>
                    </div></div>';
            })
            ->editColumn('name', function ($records) {
                return '<a class="dropdown-item" href="' . URL_USER_DETAILS . $records->slug . '" title="' . $records->name . '">' . ucfirst($records->name) . '</a>';
            })
            ->editColumn('image', function ($records) {
                return '<img src="' . getProfilePath($records->image) . '"  />';
            })
            ->removeColumn('slug')
            ->removeColumn('id')
            ->make();

    }

    public function exportData($slug)
    {
        $user = new User();
        $data = [];
        $res123 = [];
        $q123 = [];
        $users_dont_exam = [];
        $finish = [];
        $quiz123 = DB::table('quizzes')->select('id', 'title')->get();
        foreach ($quiz123 as $quiz){
            $q123[$quiz->id] = $quiz->title;
        }

        $user = User::where('slug', $slug)->first();

        $child = User::where('parent_id', $user->id)
            ->orWhere('second_parent', $user->id)
            ->get();


        foreach ($child as $chil) {

            $data[] = $chil;

            $result123 = DB::table('quizresults')
                ->join('quizzes', 'quizresults.quiz_id', '=', 'quizzes.id')
                ->where('quizresults.user_id', '=', $chil->id)
                ->groupBy('quizzes.id')
                ->select('quiz_id', 'title')
                ->get();

            foreach ($result123 as $res){
                $res123[$res->quiz_id] = $res->title;
            }

            $finish[$chil->id] = array_diff($q123, $res123);

            $children = User::where('parent_id', $chil->id)->get();

            foreach ($children as $val) {

                $data[] = $val;

                $result123 = DB::table('quizresults')
                    ->join('quizzes', 'quizresults.quiz_id', '=', 'quizzes.id')
                    ->where('quizresults.user_id', '=', $val->id)
                    ->groupBy('quizzes.id')
                    ->select('quiz_id', 'title')
                    ->get();

                foreach ($result123 as $res){
                    $res123[$res->quiz_id] = $res->title;
                }

                $finish[$val->id] = array_diff($q123, $res123);

                $children_user = User::where('parent_id', $val->id)->get();

                foreach ($children_user as $children_user_val) {
                    $data[] = $children_user_val;
                }


                # code...
            }
        }



        $region = DB::table('region_name')->groupBy('region_name')->where('region_name', $user->region)->get();

        $users_array[] = array('Регион', 'ФИО', 'Телефон', 'Аптека', 'Компания', 'Роль', 'Статус', 'Дата регистрации');
        $svodka[] = array('Регион','ФИО', 'Телефон', 'Аптека', 'Компания', 'Роль', 'Статус', 'Дата регистрации', 'Тема', 'Макс. результат', 'Кол-во попыток');
        $notest[] = array('Регион', 'ФИО', 'Телефон', 'Аптека', 'Компания', 'Роль', 'Статус', 'Дата регистрации', 'Тема');
        $percentage[] = array('Регион', 'Всего работников аптек зарегистрировано', 'Всего прошли тестирование', '% прохождения', 'Не прошли');


        foreach ($finish as $key => $fin) {

            $user = User::where('id', $key)->first();

            $reg_date = mb_substr($user->created_at, 0, 10);
            $role = getRoleData($user->role_id);

            $roles = DB::table('roles')->where('name', $role)->select('display_name')->first();

            if ($user->login_enabled == 1) {
                $status = 'Активный';
            }else{
                $status = 'Неактивный';
            }

            foreach ($fin as $f) {
                $notest[] = array(
                    'Регион' => $user->region,
                    'ФИО' => $user->name,
                    'Телефон' => intval($user->phone),
                    'Аптека' => $user->pharm,
                    'Компания' => $user->company,
                    'Роль' => $roles->display_name,
                    'Статус' => $status,
                    'Дата регистрации' => $reg_date,
                    'Тема' => $f
                );
            }



        }

        foreach ($data as $value) {

            $role = getRoleData($value->role_id);

            $roles = DB::table('roles')->where('name', $role)->select('display_name')->first();

            if ($value->login_enabled == 1) {
                $status = 'Активный';
            }else{
                $status = 'Неактивный';
            }

            $reg_date = mb_substr($value->created_at, 0, 10);

            $users_array[] = array(
                'Регион'   => $value->region,
                'ФИО'      => $value->name,
                'Телефон'  => intval($value->phone),
                'Аптека'   => $value->pharm,
                'Компания' => $value->company,
                'Роль'     => $roles->display_name,
                'Статус'   => $status,
                'Дата регистрации' => $reg_date
            );

            $result = DB::table('quizresults')
                ->join('quizzes', 'quizresults.quiz_id', '=', 'quizzes.id')
                ->where('quizresults.user_id', '=', $value->id)
                ->groupBy('quizzes.id')
                ->get();


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


        foreach ($region as $reg) {

            $count = '';

            $us = [];

            $users = [];

            $currentUser = \Auth::user();

            $users = DB::table('users')
                ->where('users.region', $reg->region_name)
                ->where('users.parent_id', $currentUser->id)
                ->join('quizresults', 'users.id', '=', 'quizresults.user_id')
                ->groupBy('quizresults.user_id')
                ->get();

            $us = User::where('region', $reg->region_name)
                ->where('parent_id', $currentUser->id)
                ->groupBy('id')
                ->get();

            foreach ($users as $user) {

                $users[] = $user;

                $child = DB::table('users')
                    ->where('users.region', $reg->region_name)
                    ->where('users.parent_id', $user->id)
                    ->join('quizresults', 'users.id', '=', 'quizresults.user_id')
                    ->groupBy('quizresults.user_id')
                    ->get();

                foreach ($child as $chil) {
                    $users[] = $chil;
                }
            }

            foreach ($us as $u) {

                $child = User::where('region', $reg->region_name)
                    ->where('parent_id', $u->id)
                    ->get();

                foreach ($child as $chil) {
                    $us[] = $chil;
                }
            }


            $finaly = count($us) - count($users);

            if (count($users) == count($us)) {
                $percent = 0;
            } elseif (count($users == null)) {
                $count_us = 1;
                $percent = (count($users) / count($us)) * 100;
            } else {

            }

            $percentage[] = array(
                'Регион' => $reg->region_name,
                'Всего работников аптек зарегистрировано' => count($us),
                'Всего прошли тестирование' => count($users),
                '% прохождения' => intval($percent),
                'Не прошли' => $finaly);
        }

///
        Excel::create('Отчет', function ($excel) use ($users_array, $svodka, $percentage, $notest) {
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

            $excel->setTitle('%');
            $excel->sheet('%', function ($sheet) use ($percentage) {
                $sheet->fromArray($percentage, null, 'A1', false, false);
            });
        })->download('xlsx');

    }

    public function childrenAnalysis()
    {

        $user = getUserWithSlug();

        if (!checkRole(getUserGrade(7))) {
            prepareBlockUserMessage();
            return back();
        }

        if (!isEligible($user->slug))
            return back();

        $data['records'] = FALSE;
        $data['user'] = $user;
        $data['title'] = getPhrase('children_analysis');
        $data['active_class'] = 'analysis';
        $data['layout'] = getLayout();
        // return view('parent.list-users', $data);

        $view_name = getTheme() . '::parent.list-users';
        return view($view_name, $data);
    }
}
