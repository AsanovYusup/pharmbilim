<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App;
use Auth;
use App\User;

use SMS;
use DB;
use Artisan;

// use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['active_class'] = 'dashboard';
        /**
         * Check the role of user
         * Redirect the user as per the eligiblity
         */
        $user = getUserRecord();
        $data['layout'] = getLayout();
        $data['title'] = getPhrase('dashboard');
        $role = getRole();

        if ($role == 'admin' || $role == 'owner') {

//            Artisan::call('view:clear');

            $roles = App\Role::get()->pluck('id');
            $dataset = [];
            $labels = [];
            $bgcolor = [];
            $border_color = [];
            foreach ($roles as $key => $value) {
                $color_number = rand(0, 999);
                $labels[] = ucfirst(getRoleData($value));
                $dataset[] = App\User::where('role_id', '=', $value)->get()->count();
                $bgcolor[] = getColor('', $color_number);
                $border_color[] = getColor('background', $color_number);
            }


            $dataset_label[] = 'lbl';

            $chart_data['type'] = 'pie';
            //horizontalBar, bar, polarArea, line, doughnut, pie
            $chart_data['data'] = (object)array(
                'labels' => $labels,
                'dataset' => $dataset,
                'dataset_label' => $dataset_label,
                'bgcolor' => $bgcolor,
                'border_color' => $border_color
            );

            $data['chart_data'][] = (object)$chart_data;
            $data['chart_heading'] = getPhrase('user_statistics');

            $data['payments_chart_data'] = (object)$this->getPaymentStats();
            $data['payments_monthly_data'] = (object)$this->getPaymentMonthlyStats();
            $data['demanding_quizzes'] = (object)$this->getDemandingQuizzes();
            $data['demanding_paid_quizzes'] = (object)$this->getDemandingQuizzes('paid');

            $data['layout'] = getLayout();

            //   $data['right_bar']          = FALSE;

            // $data['right_bar_path']     = 'common.right-bar-chart';
            $data['right_bar_data'] = array('chart_data' => $data['chart_data']);
            $data['ids'] = array('myChart0');

            // return view('admin.dashboard', $data);

            $view_name = getTheme() . '::admin.dashboard';

            return view($view_name, $data);

        } else if ($role == 'parent' || $role == 'parent_region' || $role == 'parent_pharm') {

            $user = getUserWithSlug();
            $data['user'] = $user;
            $data['latest_quizzes'] = $this->getLatestQuizzes();
            $data['latest_series'] = $this->getLatestLmsSeries();

            $count_children = [];

            $array = [];

            $auth_user = Auth::user();

            $user_settings = json_decode($auth_user->settings);

            $user_quiz = $user_settings->user_preferences->quiz_categories;
            $user_lms = $user_settings->user_preferences->lms_categories;

            foreach ($user_quiz as $user_q) {
                $user_quizzes = DB::table('quizzes')
                    ->join('quizcategories', 'quizcategories.id', '=', 'quizzes.category_id')
                    ->where('quizcategories.id', $user_q)
                    ->where('start_date', '<=', date('Y-m-d'))
                    ->where('end_date', '>=', date('Y-m-d'))
                    ->select('category', 'title', 'start_date', 'end_date', 'points', 'quizzes.slug', 'quizcategories.image')
                    ->get();

                foreach ($user_quizzes as $user_quiz) {
                    $array['quiz'][] = [
                        'category' => $user_quiz->category,
                        'name' => $user_quiz->title,
                        'start_date' => $user_quiz->start_date,
                        'end_date' => $user_quiz->end_date,
                        'points' => $user_quiz->points,
                        'slug' => $user_quiz->slug,
                        'image' => $user_quiz->image
                    ];
                }

            }

            if (count($user_lms)) {
                $user_lm = DB::table('lmsseries')
                    ->join('lmsseries_data', 'lmsseries_data.lmsseries_id', '=', 'lmsseries.id')
                    ->join('lmscontents', 'lmscontents.id', '=', 'lmsseries_data.lmscontent_id')
                    ->where('start_date', '<=', date('Y-m-d'))
                    ->where('end_date', '>=', date('Y-m-d'))
                    ->whereIn('lms_category_id', (array)$user_lms)
                    ->get();

                foreach ($user_lm as $lms) {
                    $lms_category = DB::table('lmscategories')->where('id', $lms->lms_category_id)->first();

                    $slug_series = DB::table('lmsseries')
                        ->join('lmsseries_data', 'lmsseries_data.lmsseries_id', '=', 'lmsseries.id')
                        ->join('lmscontents', 'lmscontents.id', '=', 'lmsseries_data.lmscontent_id')
                        ->where('lmscontents.id', $lms->id)
                        ->select('lmsseries.slug', 'lmscontents.image')
                        ->first();

                    $array['lms'][] = [
                        'category' => $lms_category->category,
                        'name' => $lms->title,
                        'start_date' => $lms->start_date,
                        'end_date' => $lms->end_date,
                        'points' => $lms->points,
                        'slug_series' => $slug_series->slug,
                        'slug_content' => $lms->slug,
                        'image' => $lms_category->image
                    ];
                }
            }


            $data['user_settings'] = $array;

            $alluser = DB::table('users')->where('parent_id', $user->id)->get();

            $roles = DB::table('users')
                ->where('parent_id', $user->id)
                ->groupBy('role_id')
                ->select('role_id')
                ->get();

            $count = 0;

            foreach ($alluser as $all) {
                foreach ($roles as $role) {
                    $role_name = getRole($all->id);
                    if ($all->role_id == $role->role_id)
                        $count += 1;
                    $count_children[$role_name] = $count;
                }

            }

            $data['children'] = $count_children;
            // return view('parent.dashboard', $data);
            $view_name = getTheme() . '::parent.dashboard';
            return view($view_name, $data);
        } else if ($role == 'student' || $role == 'doctor') {

            $user = Auth::user();

            $array = [];

            $user_settings = json_decode($user->settings);

            if ($user_settings) {
                $user_quiz = $user_settings->user_preferences->quiz_categories;
                $user_lms = $user_settings->user_preferences->lms_categories;

                foreach ($user_quiz as $user_q) {
                    $user_quizzes = DB::table('quizzes')
                        ->join('quizcategories', 'quizcategories.id', '=', 'quizzes.category_id')
                        ->where('quizcategories.id', $user_q)
                        ->where('start_date', '<=', date('Y-m-d'))
                        ->where('end_date', '>=', date('Y-m-d'))
                        ->select('category', 'title', 'start_date', 'end_date', 'points', 'quizzes.slug', 'quizcategories.image')
                        ->get();

                    foreach ($user_quizzes as $user_quiz) {
                        $array['quiz'][] = [
                            'category' => $user_quiz->category,
                            'name' => $user_quiz->title,
                            'start_date' => $user_quiz->start_date,
                            'end_date' => $user_quiz->end_date,
                            'points' => $user_quiz->points,
                            'slug' => $user_quiz->slug,
                            'image' => $user_quiz->image
                        ];
                    }

                }

                if (count($user_lms)) {
                    $user_lm = DB::table('lmsseries')
                        ->join('lmsseries_data', 'lmsseries_data.lmsseries_id', '=', 'lmsseries.id')
                        ->join('lmscontents', 'lmscontents.id', '=', 'lmsseries_data.lmscontent_id')
                        ->where('start_date', '<=', date('Y-m-d'))
                        ->where('end_date', '>=', date('Y-m-d'))
                        ->whereIn('lms_category_id', (array)$user_lms)
                        ->get();

                    foreach ($user_lm as $lms) {
                        $lms_category = DB::table('lmscategories')->where('id', $lms->lms_category_id)->first();

                        $slug_series = DB::table('lmsseries')
                            ->join('lmsseries_data', 'lmsseries_data.lmsseries_id', '=', 'lmsseries.id')
                            ->join('lmscontents', 'lmscontents.id', '=', 'lmsseries_data.lmscontent_id')
                            ->where('lmscontents.id', $lms->id)
                            ->select('lmsseries.slug', 'lmsseries.image')
                            ->first();

                        $array['lms'][] = [
                            'category' => $lms_category->category,
                            'name' => $lms->title,
                            'start_date' => $lms->start_date,
                            'end_date' => $lms->end_date,
                            'points' => $lms->points,
                            'slug_series' => $slug_series->slug,
                            'slug_content' => $lms->slug,
                            'image' => $lms_category->image
                        ];
                    }
                }


                $data['user_settings'] = $array;
            }

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


            // return view('student.dashboard', $data);
            $view_name = getTheme() . '::student.dashboard';
            return view($view_name, $data);
        }

    }

    public function getLatestQuizzes()
    {
        $user = Auth::user();
        $interested_categories = null;
        if ($user->settings) {
            $interested_categories = json_decode($user->settings)->user_preferences;
        }
        $quizzes = [];

        if ($interested_categories) {
            if (count($interested_categories->quiz_categories))

                $quizzes = App\Quiz::whereIn('category_id',
                    (array)$interested_categories->quiz_categories)
                    ->where('start_date', '<=', date('Y-m-d'))
                    ->where('end_date', '>=', date('Y-m-d'))
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
        }


        return $quizzes;
    }

    public function getLatestLmsSeries()
    {
        $user = Auth::user();
        $interested_categories = null;
        if ($user->settings) {
            $interested_categories = json_decode($user->settings)->user_preferences;
        }
        $series = [];

        if ($interested_categories) {
            if (count($interested_categories->lms_categories))

                $series = App\LmsSeries::whereIn('lms_category_id',
                    (array)$interested_categories->lms_categories)
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
        }


        return $series;
    }

    public function getPaymentStats()
    {
        $paymentObject = new App\Payment();
        $payment_data = (object)$paymentObject->getSuccessFailedCount();


        $payment_dataset = [$payment_data->success_count, $payment_data->cancelled_count, $payment_data->pending_count];
        $payment_labels = [getPhrase('success'), getPhrase('cancelled'), getPhrase('pending')];
        $payment_dataset_labels = [getPhrase('total')];

        $payment_bgcolor = [getColor('', 4), getColor('', 9), getColor('', 18)];
        $payment_border_color = [getColor('background', 4), getColor('background', 9), getColor('background', 18)];

        $payments_stats['data'] = (object)array(
            'labels' => $payment_labels,
            'dataset' => $payment_dataset,
            'dataset_label' => $payment_dataset_labels,
            'bgcolor' => $payment_bgcolor,
            'border_color' => $payment_border_color
        );
        $payments_stats['type'] = 'bar';
        $payments_stats['title'] = getPhrase('overall_statistics');

        return $payments_stats;
    }

    /**
     * This method returns the overall monthly summary of the payments made with status success
     * @return [type] [description]
     */
    public function getPaymentMonthlyStats()
    {

        $paymentObject = new App\Payment();
        $payment_data = (object)$paymentObject->getSuccessMonthlyData();


        $payment_dataset = [];
        $payment_labels = [];
        $payment_dataset_labels = [getPhrase('total')];
        $payment_bgcolor = [];
        $payment_border_color = [];


        foreach ($payment_data as $record) {
            $color_number = rand(0, 999);;
            $payment_dataset[] = $record->total;
            $payment_labels[] = $record->month;
            $payment_bgcolor[] = getColor('', $color_number);
            $payment_border_color[] = getColor('background', $color_number);

        }

        $payments_stats['data'] = (object)array(
            'labels' => $payment_labels,
            'dataset' => $payment_dataset,
            'dataset_label' => $payment_dataset_labels,
            'bgcolor' => $payment_bgcolor,
            'border_color' => $payment_border_color
        );
        $payments_stats['type'] = 'line';
        $payments_stats['title'] = getPhrase('payments_reports_in') . ' ' . getCurrencyCode();

        return $payments_stats;
    }

    public function getDemandingQuizzes($type = '')
    {
        $quizResultObject = new App\QuizResult();

        $usage = $quizResultObject->getQuizzesUsage($type);

        $summary_dataset = [];
        $summary_labels = [];
        $summary_dataset_labels = [getPhrase('total')];
        $summary_bgcolor = [];
        $summary_border_color = [];


        foreach ($usage as $record) {
            $color_number = rand(0, 999);;
            $summary_dataset[] = $record->total;
            $summary_labels[] = $record->quiz_title;
            $summary_bgcolor[] = getColor('', $color_number);
            $summary_border_color[] = getColor('background', $color_number);

        }

        $quiz_stats['data'] = (object)array(
            'labels' => $summary_labels,
            'dataset' => $summary_dataset,
            'dataset_label' => $summary_dataset_labels,
            'bgcolor' => $summary_bgcolor,
            'border_color' => $summary_border_color
        );
        $quiz_stats['type'] = 'doughnut';
        $quiz_stats['title'] = getPhrase('demanding_quizzes');
        if ($type != '')
            $quiz_stats['title'] = getPhrase('demanding') . '' . getPhrase('quizzes');

        return $quiz_stats;
    }

    public function testLanguage($value = '')
    {

        dd($language_phrases = (array)session('language_phrases'));

        $tr = new TranslateClient(); // Default is from 'auto' to 'en'
        $tr->setSource('en'); // Translate from English
        $tr->setTarget('te'); // Translate to Georgian
        echo $tr->translate('Hello World');


        //  $url = urlencode("https://www.googleapis.com/language/translate/v2?q=Select Role&target=hi&source=en&key=AIzaSyAhYkPKPhQ0MA4iWuU0HuoDUZqQKLU16yY");
        //  $returned_content =  json_decode(file_get_contents($url), true);
        // dd($returned_content);
    }


}
