<?php
namespace App\Http\Controllers;
use \App;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LmsCategory;
use App\LmsContent;
use App\LmsSeries;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Image;
use ImageSettings;
use File;
use Response;
class StudentLmsController extends Controller
{
     public function __construct()
    {
    	$this->middleware('auth');
    }

     /**
     * Listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
      if(checkRole(getUserGrade(2)))
      {
        return back();
      }
        $data['active_class']       = 'lms';
        $data['title']              = getPhrase('lms').' '.getPhrase('categories');
        $data['layout']              = getLayout();
        $data['categories']         = [];
        $user = Auth::user();
        $interested_categories      = null;
        if($user->settings)
        {
          $interested_categories =  json_decode($user->settings)->user_preferences;
        }
        
        if($interested_categories)    {
         if(count($interested_categories->lms_categories))
        $data['categories']         = Lmscategory::
                                      whereIn('id',(array) $interested_categories->lms_categories)
                                      ->paginate(getRecordsPerPage());
        }
        
        $data['user'] = $user;
        // return view('student.lms.categories', $data);

              $view_name = getTheme().'::student.lms.categories';
        return view($view_name, $data);

    }

    public function viewCategoryItems($slug)
    {
        $record = LmsCategory::getRecordWithSlug($slug); 

        
        if($isValid = $this->isValidRecord($record))
          return redirect($isValid); 

         $data['active_class']       = 'lms';
         $data['user']               = Auth::user();
        $data['title']              = getPhrase('lms').' '.getPhrase('series');
        $data['layout']             = getLayout();
        $data['series']             = LmsSeries::where('lms_category_id','=',$record->id)
                                        ->where('start_date','<=',date('Y-m-d'))
                                        ->where('end_date','>=',date('Y-m-d'))        
                                        ->paginate(getRecordsPerPage());
        // return view('student.lms.lms-series-list', $data);



            $view_name = getTheme().'::student.lms.lms-series-list';
        return view($view_name, $data);
    }

    /**
     * This method displays the list of series available
     * @return [type] [description]
     */
    public function series()
    {
        if(checkRole(getUserGrade(2)))
      {
        return back();
      }

        $data['active_class']       = 'lms';
        $data['title']              = getPhrase('series');
        $data['layout']             = getLayout();
        $data['series']             = [];

    $user = Auth::user();
    $interested_categories      = null;
    if($user->settings)
    {
      $interested_categories =  json_decode($user->settings)->user_preferences;
    }
    if($interested_categories){
    if(count($interested_categories->lms_categories))
        $data['series']             = LmsSeries::
                                        where('start_date','<=',date('Y-m-d'))
                                        ->where('end_date','>=',date('Y-m-d'))
                                        ->whereIn('lms_category_id',(array) $interested_categories->lms_categories)
                                        ->paginate(getRecordsPerPage());
    }
    $data['user']               = $user;

    // return view('student.lms.lms-series-list', $data);

      $view_name = getTheme().'::student.lms.lms-series-list';
        return view($view_name, $data);
        
    }

      /**
     * This method displays all the details of selected exam series
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function viewItem($slug, $content_slug='')
    {
        $user = Auth::user();

        $record = LmsSeries::getRecordWithSlug($slug);

        if($isValid = $this->isValidRecord($record))
          return redirect($isValid);  
        $content_record = FALSE;
        if($content_slug) {
          $content_record = LmsContent::getRecordWithSlug($content_slug);
          if($isValid = $this->isValidRecord($content_record))
          return redirect($isValid);  
        }        
        
        if($content_record){
            if($record->is_paid) {
            if(!isItemPurchased( $record->id, 'lms'))
            {
                prepareBlockUserMessage();
                return back();
            }
        }
        }

        $data['active_class']       = 'lms';
        $data['pay_by']             = '';
        $data['title']              = $record->title;
        $data['item']               = $record;
        $data['content_record']     = $content_record;
    
        $data['layout']              = getLayout();

       // return view('student.lms.series-view-item', $data);

          $view_name = getTheme().'::student.lms.series-view-item';
        return view($view_name, $data);
    }

    public function verifyPaidItem($slug, $content_slug)
    {

      if(!checkRole(getUserGrade(5)))
      { 
        prepareBlockUserMessage();
        return back();
      }
        $record = LmsSeries::getRecordWithSlug($slug); 
        
        if($isValid = $this->isValidRecord($record))
          return redirect($isValid);  
       
          $content_record = LmsContent::getRecordWithSlug($content_slug);
          
          if($isValid = $this->isValidRecord($content_record))
          return redirect($isValid);  
     
         if($content_record){

            if($record->is_paid) {
              
            if(!isItemPurchased($record->id, 'lms'))
            {
                return back();
            }
            else{
             
             $pathToFile= "public/uploads/lms/content"."/".$content_record->file_path;
              
              return Response::download($pathToFile);

            }
          }

          else{
            $pathToFile= "public/uploads/lms/content"."/".$content_record->file_path;
              
              return Response::download($pathToFile);
          }
        }
        else{
          flash('Ooops','File Does Not Exit','overlay');
          return back();
        }


    }

    public function content(Request $request, $req_content_type)
    {
    	$content_type = $this->getRequestContentType($req_content_type);
    	$category = FALSE;

    	$query = LmsContent::where('content_type', '=', $content_type)
    						->where('is_approved',1);

    	if($request->has('category')){
    		$category = $request->category;
    		$category_record = Lmscategory::getRecordWithSlug($category);
    		$query->where('category_id',$category_record->id);
    	}
    	
    	$data['category'] = $category;
    	$data['content_type'] = $req_content_type;

    	$data['list'] = $query->get();
    	// dd($data['list']);
    	$data['active_class']       = 'lms';
        $data['title']              = $req_content_type;
        $data['categories']         = Lmscategory::all();
        // return view('student.lms.content-categories', $data);

              $view_name = getTheme().'::student.lms.content-categories';
        return view($view_name, $data);
    }

    public function getRequestContentType($type)
    {
    	if($type == 'video-course' || $type == 'video-courses')
    		return 'vc';
    	if($type == 'community-links')
    		return 'cl';
    	return 'sm';
    }

    public function getContentTypeFullName($type)
    {
    	if($type=='sm')
    		return 'study-materal';
    	if($type=='vc')
    		return 'video-courses';
    	return 'community-links';
    }

    public function showContent($slug)
    {

    	$record = Lmscontent::getRecordWithSlug($slug);
    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);


    	$data['active_class']       = 'lms';
	    $data['title']              = $record->title;
	    $data['category']           = $record->category;
	    $data['record']             = $record;
	    
	    $data['content_type'] 		= $this->getContentTypeFullName($record->content_type);
 		$data['series'] 			= array();
 		if($record->is_series){
 			$parent_id = $record->id;
 			
 			if($record->parent_id != 0)
 				$parent_id = $record->parent_id;
 			$data['series'] 		= LmsContent::where('parent_id', $parent_id)->get();
 		}
 		
		// return view('student.lms.show-content', $data); 

     $view_name = getTheme().'::student.lms.show-content';
        return view($view_name, $data);


    	 

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
    	return URL_LMS_CONTENT;
    }

    public function points(Request $request)
    {
        $user = Auth::user();
        
        $lms = DB::table('lmscontents')->where('slug', $request->slug)->first();
        // $record = DB::table('lms_points')->where('lms_id', $lms->id)->first();
        $category = DB::table('lmsseries')->where('slug', $request->category)->first();

        $date = date("Y-m-d");

        if ($category->end_date >= $date){
            $type = 'Открыто';
        }else{
            $type = 'Закрыто';
        }

        $checklms = DB::table('lms_points')->where('lms_id', $lms->id)->where('user_id', $user->id)->exists();
        if (!$checklms) {
          $datalms = [
            'lms_id' => $lms->id,
            'user_id' => $user->id,
            'category' => $category->lms_category_id,
            'name' => $lms->title,
            'type' => $type,
            'points' => $lms->points,
            'time' => $request->time
          ];
          DB::table('lms_points')->insert($datalms);

          $asd = DB::table('users')->where('id', $user->id)->first();
          $sum = $asd->points + $lms->points;

          DB::table('users')->where('id', $user->id)->update(['points' => $sum]);

          $data_history = [
              'user_id' => $user->id,
              'lms_points' => $lms->id,
              'points' => $lms->points,
              'type' => '+'
          ];
          DB::table('history_points')->insert($data_history);

        }else {
          $oldtime = DB::table('lms_points')->where('lms_id', $lms->id)->where('user_id', $user->id)->first();
          $newtime = $oldtime->time + $request->time;

          DB::table('lms_points')->where('lms_id', $lms->id)->where('user_id', $user->id)->update(['time' => $newtime]);
        }

        // if ($record == null){

        //     $data = [
        //         'category' => $category->title,
        //         'lms_id' => $lms->id,
        //         'user_id' => $user,
        //         'name' => $lms->title,
        //         'type' => $type,
        //         'points' => $lms->points
        //     ];

        //     $rec = DB::table('lms_points')->insert($data);

        //     $id = DB::getPdo()->lastInsertId();

        //     $data_history = [
        //         'user_id' => $user,
        //         'lms_points' => $id,
        //         'points' => $lms->points,
        //         'type' => '+'
        //     ];

        //     DB::table('history_points')->insert($data_history);

        //     $asd = DB::table('users')->where('id', $user)->first();

        //     $sum = $asd->points + $lms->points;

        //     DB::table('users')->where('id', $user)->update(['points' => $sum]);

        //     $response['status'] = 1;
        //     $response['message'] = 'ok';
        //     return json_encode($response);
        // }

    }

    public function updateTimer(Request $request)
    {
        $user = \Auth::user()->id;
        $lms = DB::table('lmscontents')->where('slug', $request->slug)->first();

        $time = str_replace('of', 'из', $request->time);

        DB::table('lms_points')->where('lms_id', $lms->id)->where('user_id', $user)->update(['time' => $time]);

        $response['status'] = 1;
        $response['message'] = 'time updated';
        return json_encode($response);

    }

    public function analysisLmsPoints($slug)
    {

        $user = DB::table('users')->where('slug', $slug)->first();
        $record = DB::table('lms_points')->where('user_id', $user->id)->get();
        $data['record'] = $record;
        $data['layout']      = getLayout();
        $data['active_class'] = 'lmspoints';
        $data['heading']      = "Анализ видео";
        $data['title']        = "Анализ видео";
        $view_name = getTheme().'::student.lms.analysis.list-lms-points';
        return view($view_name, $data);

    }

    public function analysisAllPoints($slug)
    {

        $user = DB::table('users')->where('slug', $slug)->first();
        $points = DB::table('history_points')->where('user_id', $user->id)->get();

        $arr = [];

        foreach ($points as $p){

            $lms = DB::table('lms_points')->where('lms_id', $p->lms_points)->first();

            if ($lms !== null){
                $arr[] = [
                    'category' => $lms->category,
                    'view' => 'Видео',
                    'name' => $lms->name,
                    'date' => $p->date,
                    'points' => $p->points,
                    'type' => $p->type
                ];
            }else{
                $quiz = DB::table('quizresults')->where('quiz_id', $p->exam_points)->first();

                $quizzes = DB::table('quizzes')->where('id', $quiz->quiz_id)->first();
                $quizzes_category = DB::table('quizcategories')->where('id', $quizzes->category_id)->first();

                $arr[] = [
                    'category' => $quizzes_category->category,
                    'view' => 'Опросник',
                    'name' => $quizzes->title,
                    'date' => $p->date,
                    'points' => $p->points,
                    'type' => $p->type
                ];
            }



        }

        $data['sum'] = $user->points;
        $data['record'] = $arr;
        $data['layout']      = getLayout();
        $data['active_class'] = 'lmspoints';
        $data['heading']      = "Кредит-часы";
        $data['title']        = "Кредит-часы";

        $view_name = getTheme().'::student.lms.analysis.all-points';
        return view($view_name, $data);

    }

    

}
