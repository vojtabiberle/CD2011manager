<div class="smsses form generate">
    <h2><?php __('Generování kódů pro AIESEC');?></h2>
        <?php
            echo $this->element('smss/sms_menu');
            //pr($smsses);
        ?>
<?php
    echo $this->Form->create('Smss');
        echo $this->Form->input('kolik', array('label' => __('Kolik', true)));
    echo $this->Form->end(__('Generuj', true));
?>
    <small>Prosím nezadávej příliš veliká čásla, zatěžuješ tím server! (500 není hodně)</small>
</div>