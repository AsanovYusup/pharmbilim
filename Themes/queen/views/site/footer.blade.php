

<footer>
    
    <div class="container">

        <div class="row">


                <!-- <div class="col-md-4 col-sm-6">

                    <div class="row">

                        <div class="col-sm-6 col-xs-6">

                            <h4 class="cs-footer-title">{{getPhrase('need_help')}}</h4>

                            <ul class="cs-footer-links">

                                <li><a href="{{URL_VIEW_ALL_PRACTICE_EXAMS}}">{{getPhrase('practice_exams')}}</a></li>

                                <li><a href="{{URL_VIEW_ALL_LMS_CATEGORIES}}">{{getPhrase('lms')}}</a></li>

                                <li><a href="{{SITE_PAGES_ABOUT_US}}">{{getPhrase('about_us')}}</a></li>

                                <li><a href="{{URL_SITE_CONTACTUS}}">{{getPhrase('contact_us')}}</a></li>

                                <li><a href="{{SITE_PAGES_TERMS}}">{{getPhrase('terms_and_conditions')}}</a></li>

                                <li><a href="{{SITE_PAGES_PRIVACY}}">{{getPhrase('privacy_and_policy')}}</a></li>

                            </ul>

                        </div>

                      

                    </div>

                </div> -->


                <div class="col-md-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet nihil magnam vel quaerat, illo molestiae. Vero maxime aspernatur aliquam corrupti minima, expedita voluptatum! Reprehenderit fuga excepturi cupiditate voluptates exercitationem ex?
                </div>
                <div class="col-md-3">
                    Optio veniam impedit minima ut quisquam atque ea vero, cum eum, numquam modi, omnis. Eum pariatur ut aperiam quo, molestiae aut commodi id, inventore optio deserunt iure voluptatibus quisquam facilis?
                </div>
                <div class="col-md-3">
                    Assumenda voluptatum quae aliquid voluptatibus labore dolor fugiat deleniti illo dolores, quaerat, obcaecati dolorem aut laudantium deserunt ullam quas maiores tempora vitae harum aliquam sint ipsam maxime hic. Pariatur, dolore.
                </div>
                <div class="col-md-3">
                    Animi laboriosam suscipit dolor repellat ipsam eveniet eius magnam, qui explicabo sit expedita id! Quos et sed vel pariatur placeat ad fugiat, deserunt asperiores eum deleniti unde, accusamus provident, maiores.
                </div>
                
                <div class="col-md-12">

                    <br>

                    <hr>

                    <br>

                    <div class="col-md-6 col-sm-6">

                        <h4 class="cs-footer-title">{{getPhrase('follow_us_on')}}</h4>

                        <?php 

                        $current_theme  = getDefaultTheme();  

                        $face_book      =  getThemeSetting('home_page_facebook_link',$current_theme);

                        $twitter        =  getThemeSetting('home_page_twitter_link',$current_theme);

                        $google_plus    =  getThemeSetting('home_page_googleplus_link',$current_theme);

                        ?>

                        <ul class="cs-social-share">

                            <li><a href="{{$face_book}}" target="_blank" class="brand-facebook"><i class="fa brand-color fa-facebook"></i></a></li>

                            <li><a href="{{$twitter}}" target="_blank" class="brand-twitter"><i class="fa brand-color fa-twitter"></i></a></li>

                            <li><a href="{{$google_plus}}" target="_blank" class="brand-pinterest"><i class="fa brand-color fa-google-plus"></i></a></li>

                        </ul>

                    </div>


                    <div class="col-md-6 col-sm-12">



                        <h4 class="cs-footer-title">{{getPhrase('email_newsletter')}}</h4>


                        <div class="col-md-6" style="padding-left: 0px;">

                            <div class="form-group">

                                <input type="email" class="form-control email_newsletter" placeholder="Email Address" id="email1" required>

                            </div>

                        </div>

                        <div class="col-md-6" style="padding-left: 0px;">

                            <button class="btn btn-block email_newsletter button_newsletter" onclick="showSubscription()" >{{getPhrase('subscribe')}}</button>

                        </div>


                    </div>
                    
                </div>
                

            </div>

        </div>

    </footer>

    <div class="cs-copyrights">

        <div class="container">

            &copy; {{getThemeSetting('copyrights',$current_theme)}}

        </div>

    </div>

