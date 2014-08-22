<div id="flashMessage" class="message error">
    <?php echo $message ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    /*$('#flashMessage.message.error').hide("slide", {}, 1000);*/
    $('#flashMessage.message.error').delay(4200).slideUp(1000);
});
</script>