<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf_token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')}}" type="image/x-icon" />
  <title>
    @yield('title') {{ isset($title) ? $title : getSetting('site_title','site_settings') }}
  </title>
  

  @yield('header_scripts')


  <link href="{{themes('site/css/main.css')}}" rel="stylesheet">
  <link href="{{themes('css/notify.css')}}" rel="stylesheet">
  <link href="{{themes('css/angular-validation.css')}}" rel="stylesheet">
  <link href="{{themes('css/sweetalert.css')}}" rel="stylesheet">
  <link href="{{themes('css/intlTelInput.css')}}" rel="stylesheet">
  <link href="{{themes('site/js/slick/slick.css')}}" rel="stylesheet">
  <link href="{{themes('site/js/slick/slick-theme.css')}}" rel="stylesheet">
  <link href="{{themes('site/js/calendar/css/eventCalendar.css')}}" rel="stylesheet">
  <link href="{{themes('site/js/calendar/css/eventCalendar_theme_responsive.css')}}" rel="stylesheet">



  <!--Testimonies css-->
  <link href="{{themes('site/css/testimonies/normalize.min.css')}}" rel="stylesheet">
  <link href="{{themes('site/css/testimonies/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{themes('site/css/testimonies/owl.theme.default.min.css')}}" rel="stylesheet">
  <link href="{{themes('site/css/testimonies/style.css')}}" rel="stylesheet">
  <!--Testimonies css-->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  @yield('home_css_scripts')
  
</head>

<body ng-app="academia" onload="timer()">
  <!-- Navigation -->

  @include('site.header')

  


  @yield('content')


  @include('site.footer')
  
  <!-- jQuery -->

  <script src="{{themes('site/js/jquery-3.1.1.min.js')}}"></script>
  <script src="{{themes('site/js/bootstrap.min.js')}}"></script>
  <script src="{{themes('site/js/slick/slick.js')}}"></script>
  <script src="{{themes('site/js/bootstrap.offcanvas.js')}}"></script>
  <script src="{{themes('site/js/jRate.min.js')}}"></script>
  <script src="{{themes('site/js/wow.min.js')}}"></script>
  <script src="{{themes('js/notify.js')}}"></script>
  <script src="{{themes('js/sweetalert-dev.js')}}"></script>
  <script src="{{themes('js/jquery.maskedinput.min.js')}}"></script>
  <script src="{{themes('js/intlTelInput.js')}}"></script> 
  <script src="{{themes('site/js/calendar/moment.js')}}"></script>
  <script src="{{themes('site/js/calendar/jquery.eventCalendar.js')}}"></script>
  <script src="{{themes('site/js/main.js?v=3')}}"></script>


  @include('errors.formMessages')

  <script>

    $('.slick-partners').slick({
      adaptiveHeight: true,
      autoplay: true,
      arrows: false
    });


    var data = <?php include 'public/data.json'; ?>


    $('#eventCalendar').eventCalendar({
      jsonData: data,
      eventsjson: 'public/data.json',
      jsonDateFormat: 'human',
      startWeekOnMonday: false,
      openEventInNewWindow: true,
      dateFormat: 'DD-MM-YYYY',
      showDescription: false,
      locales: {
        locale: "ru",
        txt_noEvents: "Нет запланированных событий",
        txt_SpecificEvents_prev: "",
        txt_SpecificEvents_after: "события:",
        txt_NextEvents: "Следующие события:",
        txt_GoToEventUrl: "Смотреть",
        moment: {
          "months" : [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
          "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ],
          "monthsShort" : [ "Янв", "Фев", "Мар", "Апр", "Май", "Июн",
          "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек" ],
          "weekdays" : [ "Воскресенье", "Понедельник","Вторник","Среда","Четверг",
          "Пятница","Суббота" ],
          "weekdaysShort" : [ "Вс","Пн","Вт","Ср","Чт",
          "Пт","Сб" ],
          "weekdaysMin" : [ "Вс","Пн","Вт","Ср","Чт",
          "Пт","Сб" ]
        }
      }
    });

    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      initialCountry: "kg",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      onlyCountries: ['kg'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      separateDialCode: true,
      utilsScript: "{{themes('intl-tel-input/build/js/utils.js')}}",
    });
  </script>
  <script>
    var input = document.querySelector("#phone_1");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      initialCountry: "kg",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      onlyCountries: ['kg'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "{{themes('intl-tel-input/build/js/utils.js')}}",
    });
  </script>

  <script>
    (function(d){
      var display = d.querySelector('#countdown .display')
      var timeLeft = parseInt(display.innerHTML)
      var timer = setInterval(function(){
        if (--timeLeft >= 0) { 
          display.innerHTML = timeLeft 
        } else {
          d.querySelector('#countdown p').style.display = 'none'
          d.querySelector('#countdown button').style.display = 'block'
          clearInterval(timer)
        }
      }, 1000)
    })(document)

    function showSubscription(use_first = ''){

      if(use_first == 'yes'){
        var user_email  = $("#email").val();
      }
      else{
        var user_email  = $("#email1").val();

      }

      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      
      if(!re.test(user_email))
      {
        showMessage('Sorry','Please enter a valid email','error');
        return;
      }
      else{


       $.ajax({

        url      : '{{ URL_SAVE_SUBSCRIPTION_EMAIL }}',
        type     : 'post',
        data: {

          useremail    : user_email,
          '_token'     : $('[name="csrf_token"]').attr('content')

        },

        success: function( response ){
          var email_staus  = $.parseJSON(response);
          if(email_staus.status == 'existed'){
            showMessage('Ok','You are already subscribed','info');
          }
          else{

            showMessage('Success','You are subscription was successfull','success'); 
          }
        }


      });

       var mytext  = ''  
       $("#email").val(mytext);
       $("#email1").val(mytext);


     }



     function showMessage(title,msg,type){
// console.log(u_title);
$(function(){
  PNotify.removeAll();
  new PNotify({
    title: title,
    text: msg,
    type: type,
    delay: 2000,
    shadow: true,
    width: "300px",

    animate: {
      animate: true,
      in_class: 'fadeInLeft',
      out_class: 'fadeOutRight'
    }
  });
});
}

}
</script>

@yield('footer_scripts')

{!!getSetting('google_analytics', 'seo_settings')!!}




</body>

</html>