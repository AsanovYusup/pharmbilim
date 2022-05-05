/*
Copyright (c) 2017
[Custom JS Script]
Theme Name : Author Shop
Version    : 1.0
Author     : Sumo Connect Team
Author URI : https://sumoconnect.com
Support    : sumoconnect@gmail.com
*/
/*jslint browser: true*/
/*global $, jQuery, alert*/

/*--------------------------------------------------------------
TABLE OF CONTENTS:
----------------------------------------------------------------
# Document Ready
## Vars
## JRATE Star Rating
## Testimonial Slider
## Initiat WOW JS

--------------------------------------------------------------*/


/* Document Ready */
jQuery(document).ready(function () {

//     window.onload = function() {
//     if(!window.location.hash) {
//         window.location = window.location + '#loaded';
//         window.location.reload();
//     }
// }

    "use strict";


    /* JRATE Star Rating -- SVG based Rating jQuery plugin -- for docs rafy-fa plugin -- http://jacob87.github.io/raty-fa/ */
    if ($('.startRate').length) {
        $('.startRate').raty({
            score: 3
        });
    }

    //Testimonial Slider
    if ($('.cs-testimonial-slider').length) {
        $('.cs-testimonial-slider').slick({
            dots: true,
            arrows: false,
            infinite: false,
            centerPadding: '10px',
            autoplay:true,
            speed: 300,
            slidesToShow: 2,
            slidesToScroll: 2,

            responsive: [

            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
            ]
        });
    }

    //Initiat WOW JS
    new WOW().init();

    if ($('.cs-animate').length) {
        var wow = new WOW({
            boxClass: 'cs-animate', // default
            animateClass: 'wow animated fadeInUp', // default
            offset: 0, // default
            mobile: true, // default
            live: true // default
        });
        wow.init();
    }
});

// $('.slider-advertising').slick({
//   infinite: true,
//   slidesToShow: 3,
//   slidesToScroll: 3
// });

$('.slider-advertising').hide();

// $(function(){
//     var data = [
//     { "date": "2020-04-21 10:15:20", "title": "Событие 1", "description": "Lorem Ipsum dolor set", "url": "http://www.event3.com/" },
//     { "date": "2020-02-18 10:15:20", "title": "Событие 2", "description": "Lorem Ipsum dolor set", "url": "" },
//     { "date": "2020-02-01 10:15:20", "title": "Событие 3", "description": "Lorem Ipsum dolor set", "url": "http://www.event3.com/" },
//     { "date": "2020-02-25 10:15:20", "title": "Событие 4", "description": "Lorem Ipsum dolor set", "url": "http://www.event3.com/" },
//     ];
//     $('#eventCalendar').eventCalendar({
//       jsonData: data,
//       eventsjson: 'data.json',
//       jsonDateFormat: 'human',
//       startWeekOnMonday: false,
//       openEventInNewWindow: true,
//       dateFormat: 'DD-MM-YYYY',
//       showDescription: false,
//       locales: {
//         locale: "ru",
//         txt_noEvents: "Нет запланированных событий",
//         txt_SpecificEvents_prev: "",
//         txt_SpecificEvents_after: "события:",
//         txt_NextEvents: "Следующие события:",
//         txt_GoToEventUrl: "Смотреть",
//         moment: {
//           "months" : [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
//           "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ],
//           "monthsShort" : [ "Янв", "Фев", "Мар", "Апр", "Май", "Июн",
//           "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек" ],
//           "weekdays" : [ "Воскресенье", "Понедельник","Вторник","Среда","Четверг",
//           "Пятница","Суббота" ],
//           "weekdaysShort" : [ "Вс","Пн","Вт","Ср","Чт",
//           "Пт","Сб" ],
//           "weekdaysMin" : [ "Вс","Пн","Вт","Ср","Чт",
//           "Пт","Сб" ]
//       }
//   }
// });
// });


$.fn.stickyfloat = function(options, lockBottom) {
    var $obj                = this;
    var parentPaddingTop    = parseInt($obj.parent().css('padding-top'));
    var startOffset         = $obj.parent().offset().top;
    var opts                = $.extend({ startOffset: startOffset, offsetY: parentPaddingTop, duration: 200, lockBottom:true }, options);
    
    $obj.css({ position: 'absolute' });
    
    if(opts.lockBottom){
        var bottomPos = $obj.parent().height() - $obj.height() + parentPaddingTop;
        if( bottomPos < 0 )
            bottomPos = 0;
    }
    
    $(window).scroll(function () { 
        $obj.stop(); 

        var pastStartOffset         = $(document).scrollTop() > opts.startOffset;   
        var objFartherThanTopPos    = $obj.offset().top > startOffset;  
        var objBiggerThanWindow     = $obj.outerHeight() < $(window).height();  

        if( (pastStartOffset || objFartherThanTopPos) && objBiggerThanWindow ){ 
            var newpos = ($(document).scrollTop() -startOffset + opts.offsetY );
            if ( newpos > bottomPos )
                newpos = bottomPos;
            if ( $(document).scrollTop() < opts.startOffset ) 
                newpos = parentPaddingTop;
            
            $obj.animate({ top: newpos }, opts.duration );
        }
    });
};


$(document).ready(function(){
    $('#mywhatsappicon').stickyfloat({ duration: 400 });
});
