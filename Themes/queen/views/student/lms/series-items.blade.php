@php
    $contents = $series->getContents();
    $active_class = '';
    $active_class_id = 0;
    $content_image_path = IMAGE_PATH_UPLOAD_LMS_DEFAULT;
    if(isset($content) && $content)
    {
    if(isset($content->id))
        $active_class_id = $content->id;
    if($content->image)
    $content_image_path = IMAGE_PATH_UPLOAD_LMS_CONTENTS.$content->image;
    }
    $video_src = $content->file_path;
@endphp
@if($content)
    {!! $content->description!!}
    @if($content->content_type=='iframe')
    
    @if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $video_src, $match))    
        @php
            $video_id = $match[1];
        @endphp              
    @endif
    @if ($series->show_in_front)
        {{-- <a class="btn btn-lg btn-danger waves-effect waves-themed" onclick="window.open(this.href, 'pharmbilim-chat', 'height=700,width=400'); return false;" onkeypress="window.open(this.href, 'pharmbilim-chat', 'height=700,width=400'); return false;" href="https://studio.youtube.com/live_chat?is_popout=1&v={{$video_id}}">Чат / Комментарии</a> --}}
        <div id="chat-embed-wrapper"></div>
        <script>  
            let frame = document.createElement("iframe");  
            frame.referrerPolicy = "origin";  
            frame.src = "https://www.youtube.com/live_chat?v={{$video_id}}&hl=ru&persist_hl=1&embed_domain=" + window.location.hostname;  
            frame.frameBorder = "0";  
            frame.id = "chat-embed";  
            let wrapper = document.getElementById("chat-embed-wrapper");  
            wrapper.appendChild(frame); 
        </script>
        <style>
            #chat-embed{
                width: 100%;
                min-height: 500px;
            }
        </style>
    @endif
    @endif
@endif