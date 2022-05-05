<?php
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
?>
<?php if($content): ?>
    <?php echo $content->description; ?>

    <?php if($content->content_type=='iframe'): ?>
    
    <?php if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $video_src, $match)): ?>    
        <?php
            $video_id = $match[1];
        ?>              
    <?php endif; ?>
    <?php if($series->show_in_front): ?>
        
        <div id="chat-embed-wrapper"></div>
        <script>  
            let frame = document.createElement("iframe");  
            frame.referrerPolicy = "origin";  
            frame.src = "https://www.youtube.com/live_chat?v=<?php echo e($video_id); ?>&hl=ru&persist_hl=1&embed_domain=" + window.location.hostname;  
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
    <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>