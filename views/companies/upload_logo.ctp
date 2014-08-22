<div class="companies upload_logo form">
<h2><?php __('Loga firmy'); ?></h2>
<fieldset>
    <legend><?php __('Logo firmy pro web');?></legend>
    <div id="web_image_placeholder"><p><img src="/img/indicator.gif" /></p></div>
    <div class="controllers">
    <div id="web_file_deleter">
        <div class="delete-button">Delete file</div>
    </div>
    <div id="web_file_uploader"></div>
    </div>

</fieldset>
<fieldset>
    <legend><?php  __('Logo firmy pro tisk');?></legend>
    <div id="hi_image_placeholder"><p><img src="/img/indicator.gif" /></p></div>
    <div class="controllers">
    <div id="hi_file_deleter">
        <div class="delete-button">Delete file</div>
    </div>
    <div id="hi_file_uploader"></div>
    </div>
    
</fieldset>

</div>


<?php
$this->Html->css('fileuploader/fileuploader', null, array('inline' => false));
$this->Html->script('fileuploader/fileuploader', array('inline' => false));
?>

<script type="text/javascript">
    $(document).ready(function(){

        $('#web_image_placeholder').html('<p><imp src="/img/indicator.gif" /></p>');
        $('#web_image_placeholder').load('/companies/get_web_image');

        $('#web_file_deleter .delete-button').click(function(){
            $('#web_image_placeholder').html('<p><imp src="/img/indicator.gif" /></p>');
            $('#web_image_placeholder').load('/companies/del_web_image');
        });

        function web_complete(id, fileName, responseJSON)
        {
            $('#web_image_placeholder').html('<p><imp src="/img/indicator.gif" /></p>');
            $('#web_image_placeholder').load('/companies/get_web_image');
        }

        var web_uploader = new qq.FileUploader({
            element: $('#web_file_uploader')[0],
            action: '/companies/upload_logo',
            params: {
                file_upload: 'true',
                web_image: 'true'
            },
            allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            onComplete: web_complete,
            debug: false
        });

        $('#hi_image_placeholder').html('<p><imp src="/img/indicator.gif" /></p>');
        $('#hi_image_placeholder').load('/companies/get_hi_image');

        $('#hi_file_deleter .delete-button').click(function(){
            $('#hi_image_placeholder').html('<p><imp src="/img/indicator.gif" /></p>');
            $('#hi_image_placeholder').load('/companies/del_hi_image');
        });

        function hi_complete(id, fileName, responseJSON)
        {
            $('#hi_image_placeholder').html('<p><imp src="/img/indicator.gif" /></p>');
            $('#hi_image_placeholder').load('/companies/get_hi_image');
        }

        var hi_uploader = new qq.FileUploader({
            element: $('#hi_file_uploader')[0],
            action: '/companies/upload_logo',
            params: {
                file_upload: 'true',
                hi_image: 'true'
            },
            onComplete: hi_complete,
            debug: false
        });
    });
</script>