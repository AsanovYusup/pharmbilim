@extends('layouts.sitelayout')



@section('content')

    <!-- Hero Header -->

    <header class="hero-header"
            style="background: url({{IMAGE_PATH_SETTINGS.$home_back_image}}) center center no-repeat;">

        <div class="container">

            <div class="row">

                <div class="col-md-5">

                    <div class="hero-content">

                        <h1 class="cs-hero-title">{{$home_title}}</h1>

                        <div><a href="{{$home_link}}" class="btn btn-primary btn-hero"
                                target="_blank">{{getPhrase('get_started')}}</a></div>

                    </div>

                </div>

                <img src="{{IMAGE_PATH_SETTINGS.'maind.png'}}" id="header-img-doctor" alt="">

                <div class="col-md-7">


                <!-- <img src="{{IMAGE_PATH_SETTINGS.$home_image}}" alt="" class="animated fadeInUp img-responsive wow" data-wow-duration="900ms" data-wow-delay="300ms"  > -->


                    {{--   <img src="{{{{IMAGES}}hero-img1.png}}" alt="" class="animated fadeInUp hero-img1 wow" data-wow-duration="900ms" data-wow-delay="300ms">

                    <img src="{{IMAGES}}hero-img2.png" alt="" class="animated fadeInUp hero-img2 wow" data-wow-duration="900ms" data-wow-delay="600ms"> --}}


                </div>

            </div>

        </div>

    </header>

    <!-- Hero Header -->



    <!-- Call to action -->

    {{--  <section class="cs-primary-bg cs-call-to-action">

      <div class="container">

        <div class="row">

          <div class="col-md-5 col-sm-6">

            <h2>Get our latest update or inspiration directly in your inbox</h2>

          </div>

          <div class="col-md-7 col-sm-6">



            <div class="form-inline">



              <div class="form-group ">



                <input type="email" class="form-control" id="email" placeholder="Your email address" required>

              </div>



              <button class="btn btn-secondary" onclick="showSubscription('yes')">{{getPhrase('subscribe')}}</button>



            </div>



          </div>

        </div>

      </div>

    </section> --}}

    <!-- Call to action -->


    <!-- Advertising -->
    <div class="container">
        <div class="row">
            <div class="col-12" style="margin-right: 35px; margin-left: 35px;">
                <div class="slider-advertising">
                    <div class="card">
                        <div class="card-body" style="display: flex; justify-content: center;">
                            <img src="{{IMAGES}}advertising.jpg" class="img-advertising" style="border-radius: 5px;"
                                 alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="display: flex; justify-content: center;">
                            <img src="{{IMAGES}}advertising.jpg" class="img-advertising" style="border-radius: 5px;"
                                 alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="display: flex; justify-content: center;">
                            <img src="{{IMAGES}}advertising.jpg" class="img-advertising" style="border-radius: 5px;"
                                 alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="display: flex; justify-content: center;">
                            <img src="{{IMAGES}}advertising.jpg" class="img-advertising" style="border-radius: 5px;"
                                 alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="display: flex; justify-content: center;">
                            <img src="{{IMAGES}}advertising.jpg" class="img-advertising" style="border-radius: 5px;"
                                 alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="display: flex; justify-content: center;">
                            <img src="{{IMAGES}}advertising.jpg" class="img-advertising" style="border-radius: 5px;"
                                 alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Advertising -->

    <!-- {{-- Quizzes --}} -->

    <!-- <section class="cs-gray-bg">

  <div class="container">

    <div class="cs-row">

      <div class="row">

        <div class="col-sm-12 text-center clearfix">

          <h2 class="cs-section-head">{{getPhrase('practice_exams_and_exam_categories')}}</h2>



          <ul class="nav nav-pills cs-nav-pills text-center">



           @if(count($categories))



        @foreach($categories as $category)



            <li><a href="{{URL_VIEW_ALL_EXAM_CATEGORIES.'/'.$category->slug}}">{{$category->category}}</a></li>



           @endforeach



    @else

        <h4>{{getPhrase('no_practice_exams_are_available')}}</h4>



           @endif



            </ul>



          </div>

        </div>











@if(!empty($quizzes))

        <div class="row">





@foreach($quizzes as $quiz)

            <div class="col-md-3 col-sm-6">



              Single EXAM-->

            <!--  <div class="cs-product cs-animate">





          <div class="info-box ribbon_box same_height">

            @if($quiz->is_paid)

                <div class="ribbon green"><span>{{getPhrase('premium')}}</span></div>

            @else

                <div class="ribbon yellow"><span>{{getPhrase('free')}}</span></div>

            @endif





                    <a href="">

                      <div class="cs-product-img">

@if($quiz->image)

                <img src="{{IMAGE_PATH_EXAMS.$quiz->image}}" alt="exam" class="img-responsive">

                @else

                <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}" alt="exam" class="img-responsive">

                @endif

                    </div>

                  </a>





                  <div class="cs-product-content">

                   <a href="" class="cs-product-title text-center">{{ucfirst($quiz->title)}}</a>





             <ul class="cs-card-actions mt-0">

              <li>

                <a href="#">Вопросов : {{(int)$quiz->total_marks}}</a>

              </li>



              <li>  </li>





              <li class="cs-right">

                <a href="#">{{$quiz->dueration}} минут</a>



              </li>





            </ul>





            <div class="text-center mt-2">



              @if( $quiz->is_paid == 1)



                <a href="{{ URL_START_EXAM_AFTER_LOGIN.$quiz->id }}" class="btn btn-blue btn-sm btn-radius">{{getPhrase('start_exam')}}</a>

              @if($quiz->is_paid)



                    <a href="#" style="float: right;">{{getPhrase('price')}} : {{getCurrencyCode()}} {{(int)$quiz->cost}}

                            </a>



@endif



            @else



                <a href="{{ URL_FRONTEND_START_EXAM.$quiz->slug }}" class="btn btn-blue btn-sm btn-radius">{{getPhrase('start_exam')}}</a>



              @endif

                    </div>





                  </div>





                </div>



              </div>

              Single EXAM











            </div>

@endforeach





                </div>

@endif

















    @if(count($categories))

        <div class="row text-center">

          <ul class="list-inline top40">

            <li><a href="{{URL_VIEW_ALL_EXAM_CATEGORIES}}" class="btn btn-primary btn-shadow">{{getPhrase('browse_all_exams')}}</a></li>

    </ul>

  </div>

  @endif

            </div>

            </div>

            </section> -->

    <!-- /End Quizzes -->



    {{-- LMS Categories --}}



    <section class="cs-gr-bg" style="margin-bottom: 50px; margin-top: 50px;">

        <div class="container">

            <div class="cs-row">

                <div class="row">

                    <div class="col-sm-12 text-center clearfix">

                        <h2 class="cs-section-head"> {{getPhrase('lms')}} </h2>


                        <ul class="nav nav-pills cs-nav-pills lms-cats text-center">

                            @if(isset($lms_cates))



                                @foreach($lms_cates as $lms_category)



                                    <li>
                                        <a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$lms_category->slug}}">{{$lms_category->category}}</a>
                                    </li>



                                @endforeach



                            @else



                                <h4>{{getPhrase('no_categories_are_available')}}</h4>



                            @endif


                        </ul>


                    </div>

                </div>


                <div class="row col-sm-8" style="margin-top: 90px;">


                    @if(isset($lms_series))



                        @foreach($lms_series as $series)

                            <div class="col-md-6 col-sm-6">

                                <!-- Product Single Item -->

                                <div class="cs-product cs-animate">


                                    <div class="info-box ribbon_box same_height">

                                        @if($series->is_paid)

                                            <div class="ribbon green"><span>{{getPhrase('premium')}}</span></div>

                                        @else

                                            <div class="ribbon yellow"><span>{{getPhrase('free')}}</span></div>

                                        @endif


                                        <a href="{{URL_VIEW_LMS_CONTENTS.$series->slug}}">

                                            <div class="cs-product-img">

                                                @if($series->image)

                                                    <img src="{{IMAGE_PATH_UPLOAD_LMS_SERIES.$series->image}}"
                                                         alt="exam" class="img-responsive">

                                                @else

                                                    <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}" alt="exam"
                                                         class="img-responsive">

                                                @endif

                                            </div>

                                        </a>

                                        <ul class="cs-product-content mt-0">


                                            <li><a href="{{URL_VIEW_LMS_CONTENTS.$series->slug}}"
                                                   class="cs-product-title">{{ucfirst($series->title)}}</a></li>


                                            @if($series->is_paid)



                                                <li><a href="#" style="float: right;">{{getPhrase('price')}}
                                                        : {{getCurrencyCode()}} {{(int)$series->cost}}

                                                    </a></li>



                                            @endif


                                            <li>Всего предметов: {{$series->total_items}}</li>


                                            <div class="text-center mt-2">

                                                <a href="{{URL_VIEW_LMS_CONTENTS.$series->slug}}"
                                                   class=" btn btn-blue btn-sm btn-radius">{{getPhrase('view')}}</a>

                                            </div>

                                        </ul>


                                    </div>


                                </div>

                                <!-- /Product Single Item -->

                            </div>



                    @endforeach

                @endif

                <!-- Vebinars -->

                    <div class="vebinaras" style="display: none;">

                        <h2 class="cs-section-head"> Вебинары </h2>

                        <div class="col-8">

                            <div class="veb-contents">

                                <div class="head-contents col-sm-4">

                                    <span class="head-title">Имя Фамилия</span>

                                </div>

                                <div class="veb-object col-sm-8">
                                    <span class="veb-object text">Lorem ipsum dolor sit amet, consectetur adipisicing elit!</span>
                                    <p class="veb-object date">
                <span>6 января 13:00
                <button class="btn">Записаться <img src="{{IMAGES}}vebinars-check.svg" width="20px" height="20px"
                                                    alt=""></button>
              </span>

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- End Vebinars -->

                </div>

                <div class="col-sm-4">

                    <div id="eventCalendar"
                         style="height: 100%; border-radius: 10px; margin-top: 50px; margin-left: auto;"></div>


                    <div id="partners">

                        <span class="partners title">Партнеры</span>

                        <div class="slick-partners">
                            @if($partners)

                                @foreach($partners as $part)

                                    <div><img src="{{IMAGES .'/partners/'. $part->img}}" alt="{{$part->title}}"></div>

                                @endforeach

                            @endif
                        </div>


                    </div>

                </div>


                @if(isset($lms_cates))



                    <div class="row text-center">

                        <ul class="list-inline top40">

                        <!-- <li><a href="{{URL_VIEW_ALL_LMS_CATEGORIES}}" class="btn btn-primary btn-shadow">{{getPhrase('Browse_all_categories')}}</a></li> -->

                        </ul>

                    </div>



                @endif


            </div>

        </div>


        <div class="container">
            <div class="row" style="margin-top: 50px">

                <!-- Trainings -->
                @if($trainings)
                    <h2 class="cs-section-head trainings-title"> Тренинги </h2>


                    <div class="trainings-contents">

                        @foreach($trainings as $train)
                            <div class="col-md-6 col-sm-6 trainings-cards">

                                <img src="{{IMAGES}}/trainings/{{$train->img}}" alt="">

                                <p class="trainings-text">{{$train->lead}}</p>

                                <p class="trainings-theme">{{$train->theme}}</p>

                                <p class="trainings-location"><a href="#">{{$train->location}}</a></p>

                                <p class="trainings-date"><img src="{{IMAGES}}calendar.svg" alt="">{{$train->date}}</p>

                            </div>
                        @endforeach


                    </div>

            @endif
            <!-- End Trainings -->
            </div>
        </div>
    </section>



    <div class="mywhatsappicon" id="mywhatsappicon"><a href="https://wa.me/996505003744"><img
                    src="{{IMAGES}}whatsapp.svg" width="50px" height="50px" alt=""></a></div>

    {{-- End LMS Categories --}}






    <!-- End Vebinary -->




    <!--Testmonies-->

    <!-- @if ($testimonies) -->

    <!-- TESTIMONIALS -->

    <!-- <section class="testimonials">

  <div class="container">



    <div class="cs-row">

      <div class="row">

        <div class="col-sm-12 text-center clearfix">

         <h2 class="cs-section-head">{{getPhrase('feed_backs')}}</h2>

       </div>

     </div>



     <div class="row">

      <div class="col-sm-12">







        <div id="customers-testimonials" class="owl-carousel">
        -->




    <!--TESTIMONIAL 1 -->

    <!--  @foreach ($testimonies as $testmony)

        <div class="item">

          <div class="shadow-effect">

            <img class="img-circle" src="{{ getProfilePath($testmony->image, 'thumb') }}" alt="{{$testmony->name}}">

              <p>{{$testmony->description}}</p>

            </div>

            <div class="testimonial-name">{{$testmony->name}}</div>

          </div>

          @endforeach -->

    <!--END OF TESTIMONIAL 1 -->


    <!--
            </div>

          </div>

        </div>





      </div>





    </div>

    </section> -->

    <!-- END OF TESTIMONIALS -->

    <!-- @endif -->

    <!--Testmonies-->



















    <!-- Info Boxes -->

    <!-- <section class="cs-gray-bg">

  <div class="container">

    <div class="row cs-row">

      <div class="col-sm-4 wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">

        Info Box  Centered Single Item

        <div class="cs-info-box-center">

          <img src="{{IMAGES}}icn-cup.png" alt="" class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="300ms">

          <h4>{{getPhrase('free_exams')}}</h4>



        </div>

        /Info Box Centered  Single Item

      </div>

      <div class="col-sm-4 wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">

        Info Box  Centered Single Item

        <div class="cs-info-box-center">

          <img src="{{IMAGES}}icn-computer.png" alt="" class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="600ms">

          <h4>{{getPhrase('paid_exams')}}</h4>



        </div>

        /Info Box Centered  Single Item

      </div>

      <div class="col-sm-4 wow fadeIn" data-wow-duration="1000ms" data-wow-delay="900ms">

        Info Box  Centered Single Item

        <div class="cs-info-box-center">

          <img src="{{IMAGES}}icn-sett.png" alt="" class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="900ms">

          <h4>{{getPhrase('learning_management_system')}}</h4>



        </div>

        /Info Box Centered  Single Item

      </div>

    </div>

  </div>

</section>

/Info Boxes -->



@stop



@section('footer_scripts')





    <script>

        $(".cs-nav-pills li").first().addClass("active");

        $(".lms-cats li").first().addClass("active");

    </script>





    <script src="{{themes('site/js/testimonies/jquery.min.js')}}"></script>

    <script src="{{themes('site/js/testimonies/owl.carousel.min.js')}}"></script>



    <script>

        jQuery(document).ready(function ($) {

            "use strict";

            //  TESTIMONIALS CAROUSEL HOOK

            $('#customers-testimonials').owlCarousel({

                loop: true,

                center: true,

                items: 3,

                margin: 0,

                autoplay: true,

                dots: true,

                autoplayTimeout: 8500,

                smartSpeed: 450,

                responsive: {

                    0: {

                        items: 1

                    },

                    768: {

                        items: 2

                    },

                    1170: {

                        items: 3

                    }

                }

            });

        });

    </script>




@stop



