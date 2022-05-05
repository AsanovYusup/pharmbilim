@extends($layout)

@section('content')

@include('layouts.partials.breadcrumbs')
@include('layouts.partials.subheader')

<div class="card mb-g">
	<div class="card-body">
		<div class="row">
            <div class="col-md-8">
                @if(!$content_record)

                @elseif($content_record->content_type == 'video' || $content_record->content_type == 'iframe' || $content_record->content_type == 'video_url')

                    @include('student.lms.series-video-player', array('series'=>$item, 'content' => $content_record))

                @elseif($content_record->content_type == 'audio' || $content_record->content_type == 'audio_url')
                    @include('student.lms.series-audio-player', array('series'=>$item, 'content' => $content_record))
                @endif

            </div>
            <div class="col-md-4">
                @include('student.lms.series-items', array('series'=>$item, 'content'=>$content_record))
            </div>
        </div>

	</div>
</div>

@stop
@section('footer_scripts')
@push('custom_styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.3/plyr.min.css" integrity="sha512-dq8AeRs1cVyiW4/Ybo7Rn8+TlezUqjZrkZQd+zmR0ina6bSDcFyfM1ID7Mkj9QHmkk7sxZMEvspxL1U91tZS5w==" crossorigin="anonymous" />
@endpush
@push('custom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.3/plyr.min.js" integrity="sha512-j9RGDdWcJqVqrSDkCVkJGaGJgAxDyyYNzYEAuzEWQhIhcjpcbRUip/0ZjP1iW5l1uNEBJNtAD/2YecwlIF3XjQ==" crossorigin="anonymous"></script>
    <script>
        const player = new Plyr('#player');
        console.log(player.duration);
        var csrfToken = $('[name="csrf_token"]').attr('content');
        var slug = $('#player').attr('lms-slug');
        var category = $('#player').attr('category');
        var timew = 0;

        setInterval(function () {
            if (player.playing) {
                timew++;
            }
        }, 60000);

        setInterval(function () {
            if (timew > 0) {
                $.ajax({
                    url: '/points',
                    type: 'POST',
                    data: {_token :csrfToken, 'slug': slug, 'category': category, 'time': timew},
                });
            }
            timew = 0;
        }, 180000);

        $(window).bind("beforeunload", function() {
            if (timew > 0) {
                $.ajax({
                    url: '/points',
                    type: 'POST',
                    data: {_token :csrfToken, 'slug': slug, 'category': category, 'time': timew},
                });
            }
            timew = 0;
        });

        player.on('ended', event => {
            if (timew > 0) {
                $.ajax({
                    url: '/points',
                    type: 'POST',
                    data: {_token :csrfToken, 'slug': slug, 'category': category, 'time': timew},
                });
            }
            timew = 0;
        });

        setInterval(refreshToken, 600000);

        function refreshToken(){
            $.get('refresh-csrf').done(function(data){
                csrfToken = data; // the new token
            });
        }
        setInterval(refreshToken, 600000);
    </script>
@endpush
@if($content_record)
    @if($content_record->content_type == 'video' || $content_record->content_type == 'video_url')

    @endif
@endif
@include('common.custom-message-alert')
@stop