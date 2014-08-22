<div class="hostess index">
    <div>
        <fieldset>
            <legend>Jsem na firmě:</legend>
            <?php
                //pr($companies);
                echo $this->Form->create('Hostess', array('url' => '/hostess/index'));
                $data = array();
                foreach($companies as $company)
                {
                    //FIXME: datum
                    $date = date('j.n.Y');
                    //$date = '2.3.2011';
                    if(/*$date == '2.3.2011' && */isset($company['RoomDay1']['name']))
                    {
                        $data[$company['Company']['id']] = $company['RoomDay1']['name'].' - '.$company['Company']['name'].' - 2.3.2011';
                    }
                    elseif(/*$date == '3.3.2011' && */isset($company['RoomDay2']['name']))
                    {
                        $data[$company['Company']['id']] = $company['RoomDay2']['name'].' - '.$company['Company']['name'].' - 3.3.2011';
                    }
                }
                echo $this->Form->select('company', $data, null, array('escape' => false));
                echo $this->Form->end(__('Vyber', true));
            ?>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend>Jsem na tréninku:</legend>
            <?php
                //pr($trainings);
                echo $this->Form->create('Hostess', array('url' => '/hostess/index'));
                $data = array();
                foreach($trainings as $training)
                {
                    $data[$training['Room']['id']] = $training['Room']['name'];
                }
                echo $this->Form->select('training', $data);
                echo $this->Form->end(__('Vyber', true));
            ?>
        </fieldset>
    </div>
</div>