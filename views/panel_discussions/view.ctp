<?php
function is_registered($user, $discussion)
{
    $registered = false;
    foreach($discussion['Company'] as $company)
    {
        if($user['User']['id'] == $company['user_id'])
            $registered = true;
    }
    return $registered;
}
?>
<div class="panelDiscussions view">
<h2><?php  echo __('Panelová diskuze: ', true).$panelDiscussion['PanelDiscussion']['name'];?></h2>
<label for="popis">Popis:</label>
<p id="popis">
    <?php echo $panelDiscussion['PanelDiscussion']['popis'];?>
</p>
<div class="clear"></div>
<label for="ucastnici">Účastníci:</label>
<p id="ucastnici">
<ul>
    <?php
        foreach($panelDiscussion['Company'] as $company)
        {
            echo '<li>'.$company['name'].'</li>';
        }
    ?>
</ul>
</p>
<div class="clear"></div>
<div class="actions">
    <ul>
<?php
    $count = count($panelDiscussion['Company']);
    $panelDiscussion['PanelDiscussion']['zbyva'] = $panelDiscussion['PanelDiscussion']['max_pocet_ucastniku'] - $count;

    if(is_registered($user, $panelDiscussion) && $panelDiscussion['PanelDiscussion']['zbyva'] != 0)
    {
        echo '<li>'.$this->Html->link(__('Odhlaš', true), array('action' => 'company_unregister', $panelDiscussion['PanelDiscussion']['id'])).'</li>';
    }
    else
    {
        echo '<li>'.$this->Html->link(__('Přihlaš', true), array('action' => 'company_register', $panelDiscussion['PanelDiscussion']['id'])).'</li>';
    }
?>
    </ul>
</div>
