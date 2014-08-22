<div id="flashMessage" class="message warning">
    <?php echo $message ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    /*$('#flashMessage.message.warning').hide("slide", {}, 1000);*/
    $('#flashMessage.message.warning').delay(4200).slideUp(1000);
});
</script>