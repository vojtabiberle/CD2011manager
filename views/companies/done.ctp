<div class="companies form done">
    <h2><?php __('Schválení údajů o firmě');?></h2>
    <p>Dovolujeme si Vás upozornit, že schválením údajů potvrzujete, že všechny údaje jsou v pořádku a už je nechcete měnit.
    V případě nutné potřeby změny kontaktujte tým Career Days.</p>
    <div class="clear"></div>
    <div class="buttons">
    <?php
        echo $this->Html->link(__('Schválit údaje', true), array('controller' => 'companies', 'action' => 'done', 'true'));
        echo $this->Html->link(__('Odejít', true), array('controller'=>'pages', 'action'=>'display', 'company_welcomme'));
    ?>
    </div>

</div>