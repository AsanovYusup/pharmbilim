@extends('layouts.student.studentlayout')

@section('content')



    <?php







    $exam_id = 0;

    $resume_exam_link = '';

    $series_slug = 0;

    $pay_exam_slug = '';

    $user = Auth::user();

    $quiz_data = null;

    $series_quiz_slug = null;

    $series_exam_link = null;

    $series_quiz_data = null;



    if (session()->has('exam_id')) {


        $my_time = session()->get('active_time');

        $current_time = time();


        $time1 = date("H:i", $my_time);

        $time2 = date("H:i", $current_time);

        $time3 = date("H:i", strtotime($time1 . " +1 minutes"));


        if ($time2 == $time1 || $time3 > $time2) {


            $exam_id = session()->get('exam_id');

            $quiz_data = App\Quiz::where('id', '=', $exam_id)->first();

            $is_purchased = isItemPurchased($quiz_data->id, "exam", $user->id);


            if (!$is_purchased && $quiz_data->is_paid == 1) {


                $pay_exam_slug = $quiz_data->slug;


            } else {


                $resume_exam_link = URL_STUDENT_TAKE_EXAM . $quiz_data->slug;

            }


        } else {


            $exam_id = 0;

            $resume_exam_link = '';

            $pay_exam_slug = '';

        }


    } elseif (session()->has('exam_series_slug')) {


        $my_time = session()->get('active_time');

        $current_time = time();


        $time1 = date("H:i", $my_time);

        $time2 = date("H:i", $current_time);

        $time3 = date("H:i", strtotime($time1 . " +1 minutes"));


        if ($time2 == $time1 || $time3 > $time2) {


            $slug = session()->get('exam_series_slug');

            $exam_series = App\ExamSeries::where('slug', '=', $slug)->first();

            $is_purchased = isItemPurchased($exam_series->id, "combo", $user->id);


            if ($is_purchased && session()->has('series_quiz_slug')) {


                $series_quiz_slug = session()->get('series_quiz_slug');

                $series_quiz_data = App\Quiz::where('slug', '=', $series_quiz_slug)->first();

                $series_exam_link = URL_STUDENT_TAKE_EXAM . $series_quiz_slug;


            } else {


                $series_slug = $slug;

            }


        } else {


            $series_slug = 0;

        }


    } else {


        $exam_id = 0;

        $resume_exam_link = '';

        $series_slug = 0;


    }







    ?>



    <input type="hidden" name="resume_exam_id" id="resume_exam_id" value="{{$exam_id}}">

    <input type="hidden" name="resume_exam_link" id="resume_exam_link" value="{{$resume_exam_link}}">

    <input type="hidden" name="series_slug" id="series_slug" value="{{$series_slug}}">

    <input type="hidden" name="pay_exam_slug" id="pay_exam_slug" value="{{$pay_exam_slug}}">

    <input type="hidden" name="series_quiz_slug" id="series_quiz_slug" value="{{$series_quiz_slug}}">

    <input type="hidden" name="series_exam_link" id="series_exam_link" value="{{$series_exam_link}}">











    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">

                    <ol class="breadcrumb">


                        <li>{{ $title}}</li>

                    </ol>

                </div>

            </div>






            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped table-hover text-center"
                               style="background-color:#fff;">
                            <caption>Видео</caption>
                            <thead style="background-color: #438afe; color:#ffffff;">
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    Категория
                                </td>
                                <td>
                                    Название
                                </td>
                                <td>
                                    Дата начала
                                </td>
                                <td>
                                    Дата окончания
                                </td>
                                <td>
                                    Баллы
                                </td>
                                <td>
                                    Действия
                                </td>
                            </tr>
                            </thead>
                            <tbody>


                            @if($user_settings['lms'] ?? null)
                                @foreach($user_settings['lms'] as $lms)
                                    <tr>
                                        <td>
                                            <img src="/public/uploads/lms/categories/{{ $lms['image'] }}" alt="" width="50px">
                                        </td>
                                        <td>
                                            {{ $lms['category'] }}
                                        </td>
                                        <td>
                                            {{ $lms['name'] }}
                                        </td>
                                        <td>
                                            {{ $lms['start_date'] }}
                                        </td>
                                        <td>
                                            {{ $lms['end_date'] }}
                                        </td>
                                        <td>
                                            {{ $lms['points'] }}
                                        </td>
                                        <td>
                                            <a href="/learning-management/series/{{ $lms['slug_series'] }}/{{ $lms['slug_content'] }}">Смотреть</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>Тут пока пусто</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped table-hover text-center"
                               style="background-color:#fff;">
                            <caption>Опросники</caption>
                            <thead style="background-color: #438afe; color:#ffffff;">
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    Категория
                                </td>
                                <td>
                                    Название
                                </td>
                                <td>
                                    Дата начала
                                </td>
                                <td>
                                    Дата окончания
                                </td>
                                <td>
                                    Баллы
                                </td>
                                <td>
                                    Действия
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($user_settings['quiz'] ?? null)
                                @foreach($user_settings['quiz'] as $key => $quiz)
                                    <tr>
                                        <td>
                                            <img src="/public/uploads/exams/categories/{{ $quiz['image'] }}" alt="" width="50px">
                                        </td>
                                        @if($key == 2)
                                            <td>
                                                {{ $quiz['category'] }}
                                            </td>
                                        @else
                                            <td>
                                                {{ $quiz['category'] }}
                                            </td>
                                        @endif
                                        <td>
                                            {{ $quiz['name'] }}
                                        </td>
                                        <td>
                                            {{ $quiz['start_date'] }}
                                        </td>
                                        <td>
                                            {{ $quiz['end_date'] }}
                                        </td>
                                        <td>
                                            {{ $quiz['points'] }}
                                        </td>
                                        <td>
                                            <a href="/exams/student/quiz/take-exam/{{ $quiz['slug'] }}">Пройти</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>Тут пока пусто</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>


        <!-- <div class="row">



<?php $ids = [];?>

        @for($i=0; $i<count($chart_data); $i++)

            <?php

            $newid = 'myChart' . $i;

            $ids[] = $newid; ?>



                    <div class="col-md-6">

                        <div class="panel panel-primary dsPanel">

                            <div class="panel-body" >







                    <canvas id="{{$newid}}" width="100" height="60"></canvas>

   </div>

     </div>

 </div>



@endfor -->


        </div>

    </div>

    <!-- /.container-fluid -->

    </div>

    <!-- /#page-wrapper -->



@stop



@section('footer_scripts')

    @include('common.chart', array($chart_data,'ids' =>$ids));



    <script>


        window.onload = function () {


            var exam_id = $('#resume_exam_id').val();

            exam_link = $('#resume_exam_link').val();

            series_exam_link = $('#series_exam_link').val();

            var series_slug = $('#series_slug').val();

            var pay_exam_slug = $('#pay_exam_slug').val();


            if (series_exam_link) {

                showInstructions(series_exam_link);

            } else if (pay_exam_slug) {

                window.location.href = "{{ URL_PAYMENTS_CHECKOUT.'exam/'}}" + pay_exam_slug;

            } else if (series_slug != 0) {

                window.location.href = "{{ URL_PAYMENTS_CHECKOUT.'combo/'}}" + series_slug;

            } else if (exam_id > 0) {

                showInstructions(exam_link);

            }

        }


        function startMyExam() {

            showInstructions(exam_link);

        }


        function startMySeriesExam() {

            showInstructions(series_exam_link);

        }


        function showInstructions(url) {


            width = screen.availWidth;

            height = screen.availHeight;


            window.open(url, '_blank', "height=" + height + ",width=" + width + ", toolbar=no, top=0,left=0,location=no,menubar=no, directories=no, status=no, menubar=no, scrollbars=yes,resizable=no");


            runner();

        }


        function runner() {

            url = localStorage.getItem('redirect_url');

            if (url) {

                localStorage.clear();

                window.location = url;

            }

            setTimeout(function () {

                runner();

            }, 500);

        }

    </script>



@stop