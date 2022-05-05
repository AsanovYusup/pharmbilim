@extends($layout)
@section('content')
@include('layouts.partials.breadcrumbs')
@include('layouts.partials.subheader')
@php
/**

* Varables Used
* @submitted_answers -- The answers submitted by the user
* @correct_answer_questions -- It contains overall correct answer questions id's
* @answer_status -- It will have a class if the answer is wrong
* @user_answers -- It will hold all the user answers specific to question
* @time_spent_correct_answers -- It will maintain the list of time to spend and time spent on
* question associated to question id
* @time_spent_wrong_answers -- It will maintain the list of time to spend and time spent on
* question associated to question id
* @time_spent_not_answers -- It will maintain the list of time to spend and time spent on
* question associated to question id
*/
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card answer_validation">

            <div class="card-header">
               <div class="row">
                   <div class="col-md-6">
                        @if($result_record->exam_status == 'pass')
                        @php
                            $status = '<span class="badge badge-succes">'.getPhrase('pass').'</span>';
                        @endphp
                        @else
                        @php
                            $status = '<span class="badge badge-danger">'.getPhrase('fail').'</span>';
                        @endphp
                        @endif
                    <h4 class="result-pf-text">{{getPhrase('result')}}: {!! $status !!}</h4>
                    
                   </div>
                   <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input is-valid" id="valid" checked="" disabled>
                                    <label class="custom-control-label text-success" for="valid">Правильные</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input is-invalid" id="invalid" checked="" disabled>
                                    <label class="custom-control-label text-danger" for="invalid">Неправильные</label>
                                </div>
                            </div>
                        </div>
                   </div>
               </div>
            </div>

            <div class="card-body">
                <div class="accordion accordion-clean" id="answer_accordion-1">

                    @php
                        $submitted_answers = [];
                        $answers = (array)json_decode($result_record->answers);
                        foreach ($answers as $key => $value) {
                            $submitted_answers[$key] = $value;
                        }
                        $correct_answer_questions = [];
                        $correct_answer_questions = (array)
                                                    json_decode($result_record->correct_answer_questions);
                        $time_spent_correct_answers =
                                getArrayFromJson($result_record->time_spent_correct_answer_questions);
                        $time_spent_wrong_answers = getArrayFromJson($result_record->time_spent_wrong_answer_questions);
                        $time_spent_not_answers = getArrayFromJson($result_record->time_spent_not_answered_questions);
                        $question_number =0;
                    @endphp

                    @foreach($questions as $question)
                    @php
                        $question_number++;
                        $user_answers   = FALSE;
                        $time_spent     = array();
                        //Pull User Answers for this question
                        if(array_key_exists($question->id, $submitted_answers)) {
                            $user_answers = $submitted_answers[$question->id];
                        }
                            //Pull Timing details for this question for correct answers
                        if(array_key_exists($question->id, $time_spent_correct_answers))
                            $time_spent = $time_spent_correct_answers[$question->id];
                            //Pull Timing details for this question for wrong answers
                        if(array_key_exists($question->id, $time_spent_wrong_answers))
                            $time_spent = $time_spent_wrong_answers[$question->id];
                            //Pull Timing details for this question which are not answered
                        if(array_key_exists($question->id, $time_spent_not_answers))
                            $time_spent = $time_spent_not_answers[$question->id];
                    @endphp

                    <div class="card" id="{{$question->id}}">

                        @php
                            $question_type = $question->question_type;
                            $subject_record = array();
                            foreach ($subjects as $subject) {
                                if($subject->id == $question->subject_id) {
                                    $subject_record = $subject;
                                    break;
                                }
                            }                            
                        @endphp
                        <div class="card-header">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#answer-{{$question->id}}" aria-expanded="false">
                                
                                @php
                                    $inject_data = array(
                                        'question'      => $question,
                                        'user_answers'  => $user_answers,
                                        'subject'      => $subject_record,
                                        'question_number' => $question_number,
                                        'time_spent'    => $time_spent,
                                    );
                                    $image_path = PREFIX.(new App\ImageSettings())
                                    ->getExamImagePath();
                                    $meta = (object)$inject_data;
                                    $question = $meta->question;
                                    $time_spent = $meta->time_spent;
                                    $timing_lable = 'label label-danger';
                                    if($question->time_to_spend > $time_spent->time_spent)
                                    {
                                    $timing_lable = 'label label-info';
                                    }

                                @endphp

                                <div class="info-card-text">
                                    <div class="text-gradient">
                                        Вопрос №{{$question_number}}.
                                    </div>
                                    <h4 class="mt-2 ">
                                        {!! $question->question !!}
                                    </h4>

                                </div>

                                <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-minus fs-xl"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-plus fs-xl"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="answer-{{$question->id}}" class="collapse" data-parent="#answer_accordion-1">
                            <div class="card-body">
                                @include('student.exams.results.'.$question_type.'-answers', $inject_data)
                                <div class="ml-auto align-self-start">
                                    <p class="question-text">
                                        <strong>{{getPhrase('time_limit')}}: </strong>
                                        {{ $question->time_to_spend }}
                                        {{ Lang::choice('секунда|секунды|секунд', $question->time_to_spend, [], 'ru') }}
                                    </p>
                                    <p class="question-text">
                                        <strong>{{getPhrase('time_taken')}}: </strong>
                                        <span class="{{$timing_lable}}">
                                            {{ $time_spent->time_spent }}
                                            {{ Lang::choice('секунда|секунды|секунд', $time_spent->time_spent, [], 'ru') }}
                                        </span>
                                    </p>
                                </div>
                                @if($question->explanation)
                                <div class="answer-status-container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="question-status">
                                                <strong>{{getPhrase('explanation')}}: </strong>
                                                <span class="language_l1"> {!! $question->explanation!!}</span>
                                                @if(isset($question->explanation_l2))
                                                <span class="language_l2" style="display: none;"> {!!
                                                    $question->explanation_l2!!}</span>
                                                @else
                                                <span class="language_l2" style="display: none;"> {!! $question->explanation!!}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</div>

@stop
@section('footer_scripts')
@include('student.exams.results.scripts.js-scripts')
@stop