<div class="employees own_view form">
    <h2><?php __('Lidé ve firmě');?></h2>
    <?php echo $this->Form->create('Employee')?>
    <fieldset>
        <legend>Hlavní kontakt</legend>

    </fieldset>

    <fieldset>
        <legend>Kontakt pro studenty</legend>

    </fieldset>
    <fieldset>
        <legend>Kontakt pro Career Brožuru</legend>

    </fieldset>

    <?php echo $this->Form->end(__('Ulož', true));?>
</div>