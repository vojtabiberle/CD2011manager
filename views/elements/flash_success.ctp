<div id="flashMessage" class="message success">
    <?php echo $message ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    /*$('#flashMessage.message.success').hide("slide", {}, 1000);*/
    $('#flashMessage.message.success').delay(4200).slideUp(1000);
});
</script>