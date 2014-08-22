<div class="students reg form register">
    <fieldset>
        <legend>Registrace na Career Days</legend>
        <?php
        unset($this->data['User']['password']);
        unset($this->data['User']['passwordCheck']);
            echo $this->Form->create('Student', array('url' => '/check_in/koupit'));

            echo $this->Form->input('User.jmeno', array('label' => __('Jméno', true)));

            echo $this->Form->input('User.prijmeni', array('label' => __('Příjmení', true)));

            echo $this->Form->input('User.email', array('label' => __('Email', true)));
            echo $this->Form->input('User.emailCheck', array('label' => __('Email znovu', true)));
            echo '<div id="MailMessage"></div>';

            echo $this->Form->input('User.username', array('label' => __('Uživatelské jméno', true)));
            echo '<div id="UsernameMessage"></div>';

            echo $this->Form->input('User.password', array('label' => __('Heslo', true)));
            echo $this->Form->input('User.passwordCheck', array('label' => __('Heslo znovu', true), 'type' => 'password'));
            echo '<div id="PasswordMessage"></div>';

            echo $this->Form->input('skola', array('label' => __('Škola', true), 'title' => 'Prosím nech v políčku vyplněnou hodnotu, kterou ti nabídne náš našeptávač.'));

            echo $this->Form->input('obor', array('label' => __('Studijní oboru', true), 'title' => 'Prosím nech v políčku vyplněnou hodnotu, kterou ti nabídne náš našeptávač.'));



            echo $this->Form->radio('typ', array('B' => 'Bakalářské', 'N' => 'Navazující', 'D' => 'Doktorant', 'A' => 'Absolvent'), array('legend' => __('Typ studia', true)));
            echo $this->Form->radio('rocnik', array('1'=> '1. ročník', '2' => '2. ročník', '3' => '3. ročník', '4' => '4. ročník', '5' => '5. ročník'), array('legend' => __('Ročník', true)));

            echo '<fieldset>';
            echo '<legend>Dny na Career Days</legend>';
            echo '<div>';
            echo $this->Form->checkbox('chce_den1', array('label' => 'Chce první den'));
            echo 'Chce první den';
            echo '</div>';
            echo '<div>';
            echo $this->Form->checkbox('chce_den2', array('label' => 'Chce druhý den'));
            echo 'Chce druhý den';
            echo '</div>';
            echo '</fieldset>';

            echo $this->Form->end(__('Registruj', true));

            $this->Html->script('jquery-autocomplete/jquery.autocomplete.min', array('inline' => false));
            $this->Html->script('jquery-autocomplete/lib/jquery.bgiframe.min', array('inline' => false));
            $this->Html->css('jquery.autocomplete', null, array('inline' => false));
            $this->Html->script('jquery.tools.min', array('inline' => false));

        ?>
    </fieldset>
</div>
<script type="text/javascript">
$(document).ready(function(){
    var skola;

    $('#StudentTypN').attr('checked', true);
    var obor = $('#StudentObor').val()
    if(obor.length == 0)
    {
        $('#StudentObor').attr('disabled', 'disabled');
    }

    $('#UserPassword').val('');
    $('#UserPasswordCheck').val('');

    $('#StudentRocnik1').hide();
    $('#StudentRocnik1').next().hide();
    $('#StudentRocnik2').hide();
    $('#StudentRocnik2').next().hide();
    $('#StudentRocnik3').hide();
    $('#StudentRocnik3').next().hide();
    $('#StudentRocnik4').show();
    $('#StudentRocnik4').next().show();
    $('#StudentRocnik5').show();
    $('#StudentRocnik5').next().show();

    $('#StudentTypB').change(function(){
            $(this).parent().next().show();
            $('#StudentRocnik1').show();
            $('#StudentRocnik1').next().show();
            $('#StudentRocnik2').show();
            $('#StudentRocnik2').next().show();
            $('#StudentRocnik3').show();
            $('#StudentRocnik3').next().show();
            $('#StudentRocnik4').hide();
            $('#StudentRocnik4').next().hide();
            $('#StudentRocnik5').hide();
            $('#StudentRocnik5').next().hide();
    });
    $('#StudentTypN').change(function(){
            $(this).parent().next().show();
            $('#StudentRocnik1').hide();
            $('#StudentRocnik1').next().hide();
            $('#StudentRocnik2').hide();
            $('#StudentRocnik2').next().hide();
            $('#StudentRocnik3').hide();
            $('#StudentRocnik3').next().hide();
            $('#StudentRocnik4').show();
            $('#StudentRocnik4').next().show();
            $('#StudentRocnik5').show();
            $('#StudentRocnik5').next().show();
    });

    $('#StudentTypD').change(function(){
        $(this).parent().next().hide();
    });

    $('#StudentTypA').change(function(){
        $(this).parent().next().hide();
    });

    $('#UserUsername').focusout(function(){
        var val = $(this).val();
        if(val.length > 3)
        {
            $.get("/students/check_username",
                    {name: val},
                    function(data)
                    {
                        $('#UsernameMessage').html('').hide();
                        $('#UserUsername').removeClass('bred');
                        if(data == 0)
                        {
                            $('#UsernameMessage').html('<div class="message small warning">Toto uživatelské jméno je již zaregistrované.</div>').show();
                            $('#UserUsername').addClass('bred');
                        }
                    }
                    );
        }
        else
        {
            $('#UsernameMessage').html('<div class="message small warning">Uživatelské jméno musí mít nejméně 4 znaky.</div>').show();
            $('#UserUsername').addClass('bred');
        }
    });

    $('#UserPassword').focusout(function(){
        var val = $(this).val();
        if(val.length <= 3)
        {
            $('#PasswordMessage').html('<div class="message small warning">Zadejte heslo delší než 4 znaky.</div>').show();
            $('#UserPassword').addClass('bred');
        }
        else
        {
            $('#PasswordMessage').html('').hide();
            $('#UserPassword').removeClass('bred');
        }
    });

    $('#UserPasswordCheck').focusout(function(){
        var passwd = $('#UserPassword').val();
        var passch = $(this).val();

        if(passwd.length <= 3)
        {
            $('#PasswordMessage').html('<div class="message small warning">Zadejte heslo delší než 4 znaky.</div>').show();
            $('#UserPassword').addClass('bred');
        }
        else if(passch.length <= 3)
        {
            $('#PasswordMessage').html('<div class="message small warning">Zadejte heslo dvakrát pro ověření správnosti.</div>').show();
            $('#UserPassword').addClass('bred');
            $('#UserPasswordCheck').addClass('bred');
        }
        else if(passwd != passch)
        {
            $('#PasswordMessage').html('<div class="message small warning">Zadejte prosím stejná hesla.</div>').show();
            $('#UserPassword').addClass('bred');
            $('#UserPasswordCheck').addClass('bred');
        }
        else
        {
            $('#PasswordMessage').html('').hide();
            $('#UserPassword').removeClass('bred');
            $('#UserPasswordCheck').removeClass('bred');
        }
    });

    $('#UserEmail').focusout(function(){
        var email = $(this).val();
        var chemail = $('#UserEmailCheck').val();

        if(email.length > 3)
        {
            $.get("/students/check_email",
                    {email: email},
                    function(data)
                    {
                        $('#MailMessage').html('').hide();
                        $('#UserEmail').removeClass('bred');
                        $('#UserEmailCheck').removeClass('bred');
                        if(data == 0)
                        {
                            $('#MailMessage').html('<div class="message small warning">Tento email je již zaregistrován.</div>').show();
                            $('#UserEmail').addClass('bred');
                        }
                    }
                    );
        }

    });

    $('#UserEmailCheck').focusout(function(){
        var email = $('#UserEmail').val();
        var chemail = $(this).val();

        if(email != chemail)
        {
            $('#MailMessage').html('<div class="message small warning">Zadejte prosím stejné emailové adresy..</div>').show();
            $('#UserEmail').addClass('bred');
            $('#UserEmailCheck').addClass('bred');
        }
        else
        if(email.length > 3)
        {
            $.get("/students/check_email",
                    {email: email},
                    function(data)
                    {
                        $('#MailMessage').html('').hide();
                        $('#UserEmailCheck').removeClass('bred');
                        $('#UserEmail').removeClass('bred');
                        if(data == 0)
                        {
                            $('#MailMessage').html('<div class="message small warning">Tento email je již zaregistrován.</div>').show();
                            $('#UserEmail').addClass('bred');
                        }
                    }
                    );
        }
        else
        {
            $('#MailMessage').html('').hide();
            $('#UserEmail').removeClass('bred');
            $('#UserEmailCheck').removeClass('bred');
        }
    });

    $('#StudentSkola').autocomplete('/students/autoschool');

    $('#StudentSkola').tooltip({

	// place tooltip on the right edge
	position: "center right",

	// a little tweaking of the position
	offset: [-2, 10],

	// use the built-in fadeIn/fadeOut effect
	effect: "fade",

	// custom opacity setting
	opacity: 0.7

    });

    $('#StudentSkola').focusout(function(){
        skola = $(this).val();
        if(skola.length > 0)
        {
            $('#StudentObor').removeAttr('disabled');
        }
    });

    $('#StudentObor').autocomplete('/students/autoobor',{
        extraParams: {school: function() { return $('#StudentSkola').val() } }
    });

    $('#StudentObor').tooltip({

	// place tooltip on the right edge
	position: "center right",

	// a little tweaking of the position
	offset: [-2, 10],

	// use the built-in fadeIn/fadeOut effect
	effect: "fade",

	// custom opacity setting
	opacity: 0.7

    });
});
</script>