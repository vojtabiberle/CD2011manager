<?php
class HostessController extends AppController
{
    var $name = 'Hostess';
    var $uses = array();

    function index()
    {
        $this->loadModel('Company');
        $companies = $this->Company->find('all', array(
            'contain' => array('RoomDay1', 'RoomDay2'),
            //'conditions' => array('room_day_1 not' => null, 'room_day_2 not' => null)
        ));

        $this->loadModel('Room');
        $trainings = $this->Room->find('all', array(
            'contain' => array(),
            'conditions' => array('description LIKE' => 'Training')
        ));

        if(!empty($this->data))
        {
            $this->Session->delete('CompanyId');
            $this->Session->delete('TrainingId');
            if(isset($this->data['Hostess']['company']))
            {
                $this->Session->write('CompanyId', $this->data['Hostess']['company']);
                $this->Session->setFlash('Firma vybrána.');
                $this->redirect(array('controller' => 'hostess', 'action' => 'setkani'));
            }
            elseif(isset($this->data['Hostess']['training']))
            {
                $this->Session->write('TrainingId', $this->data['Hostess']['training']);
                $this->Session->setFlash('Trénink vybrán.');
                $this->redirect(array('controller' => 'hostess', 'action' => 'setkani'));
            }
            else
            {
                $this->Session->setFlash('Vyber prosím firmu nebo trénink!');
            }
        }

        $this->set(compact('companies', 'trainings'));
    }

    function firma()
    {
        if(($compid = $this->Session->read('CompanyId')))
        {
            $this->loadModel('Company');
            $company = $this->Company->find('first', array(
                'conditions' => array('Company.id' => $compid),
                'contain' => array('Cdbrochure', 'CdKontakt', 'StudentKontakt', 'CbKontakt', 'Field')
            ));
            $this->set('company', $company);
        }
        else
        {
            $this->Session->setFlash('Nastav prosím firmu!');
            $this->redirect('/');
        }
    }

    function setkani()
    {
        if(($cid = $this->Session->read('CompanyId')))
        {
            $this->loadModel('Meeting');
            $this->recursive = 2;
            $meetings = $this->Meeting->find('all', array(
                'conditions' => array('company_id' => $cid, 'konec < ' => 'curtime()'),
                'order' => array('zacatek', 'den'),
                'contain' => array('Student')
            ));
//            echo '<pre>';
//            print_r($meetings);
//            echo '</pre>';
            foreach($meetings as $mkey => $meeting)
            {
                foreach($meeting['Student'] as $key => $student)
                {
                    //echo $student['user_id'].'<br>';
                    $meetings[$mkey]['Student'][$key]['User'] = $this->__getUser($student['user_id']);
                }
            }
//            echo '<pre>';
//            print_r($meetings);
//            echo '</pre>';

            $this->loadModel('Company');
            $this->Company->id = $cid;
            $this->Company->recursive = -1;
            $this->set('company', $this->Company->read());

            $this->set('meetings', $meetings);
        }
        elseif(($tid = $this->Session->read('TrainingId')))
        {
            $this->loadModel('Training');
            $this->recursive = 2;
            $trainings = $this->Training->find('all', array(
                'conditions' => array('room_id' => $tid),
                //'order' => array('zacatek', 'den'),
                'contain' => array('Student')
            ));
            //pr($trainings);
//            echo '<pre>';
//            print_r($meetings);
//            echo '</pre>';
            foreach($trainings as $tkey => $training)
            {
                foreach($training['Student'] as $key => $student)
                {
                    //echo $student['user_id'].'<br>';
                    $trainings[$tkey]['Student'][$key]['User'] = $this->__getUser($student['user_id']);
                }
            }
//            echo '<pre>';
//            print_r($meetings);
//            echo '</pre>';

            $this->set('trainings', $trainings);
        }
        else
        {
            $this->Session->setFlash('Nastav prosím firmu nebo trénink!');
            $this->redirect('/');
        }
    }

    function pridej()
    {
        //pr($this->params);
        //exit;
        if(isset($this->params['named']['meeting']))
        {
            $this->set('meeting_id', $this->params['named']['meeting']);
            if(isset($this->params['named']['student']))
            {
                $this->loadModel('Student');
                if($this->Student->habtmAdd('Meeting', $this->params['named']['student'], $this->params['named']['meeting']))
                {
                    //$this->Student->query('update meetings_students set potvrzeno = 1 where meeting_id = "'.$this->params['named']['meeting'].'" and student_id = "'.$this->params['named']['student'].'"');
                    $this->Session->setFlash('Student byl přidán na setkání.');
                    $this->redirect('/hostess/setkani#meeting'.$this->params['named']['meeting']);
                }
                else
                {
                    
                    $this->Session->setFlash('Studenta se bohužel nepodařilo přidat. Poznamenej si ho.');
                    $this->redirect('/hostess/setkani#'.$this->parmas['named']['meeting']);
                }
            }
        }
        if(isset($this->params['named']['training']))
        {
            $this->set('training_id', $this->params['named']['training']);
            if(isset($this->params['named']['student']))
            {
                $this->loadModel('Student');
                if($this->Student->habtmAdd('Training', $this->params['named']['student'], $this->params['named']['training']))
                {
                    //$this->Student->query('update students_trainings set potvrzeno = 1 where training_id = "'.$this->params['named']['training'].'" and student_id = "'.$this->params['named']['student'].'"');
                    $this->Session->setFlash('Student byl přidán na trénink.');
                    $this->redirect('/hostess/setkani#training'.$this->params['named']['training']);
                }
                else
                {
                    $this->Session->setFlash('Studenta se bohužel nepodařilo přidat. Poznamenej si ho.');
                    $this->redirect('/hostess/setkani#training'.$this->params['named']['training']);
                }
            }
        }

        if(!empty($this->data))
        {
            //pr($this->data);
            if(isset($this->data['Student']['meeting_id']) && isset($this->data['Student']['search']))
            {
                $this->loadModel('Student');
                $data = $this->data['Student']['search'];
                $students = $this->Student->query("SELECT * FROM students_all_info WHERE (jmeno LIKE '%".$data."%' OR prijmeni LIKE '%".$data."%' OR username LIKE '%".$data."%' OR email LIKE '%".$data."%' OR typ LIKE '%".$data."%' OR rocnik LIKE '%".$data."%' OR zivotopis LIKE '%".$data."%' OR barcode LIKE '%".$data."%')");
                $this->set('meeting_id', $this->data['Student']['meeting_id']);
                $this->set('students', $students);
            }
            if(isset($this->data['Student']['training_id']) && isset($this->data['Student']['search']))
            {
                $this->loadModel('Student');
                $data = $this->data['Student']['search'];
                $students = $this->Student->query("SELECT * FROM students_all_info WHERE (jmeno LIKE '%".$data."%' OR prijmeni LIKE '%".$data."%' OR username LIKE '%".$data."%' OR email LIKE '%".$data."%' OR typ LIKE '%".$data."%' OR rocnik LIKE '%".$data."%' OR zivotopis LIKE '%".$data."%' OR barcode LIKE '%".$data."%')");
                $this->set('training_id', $this->data['Student']['training_id']);
                $this->set('students', $students);
            }
        }
    }

    function odeber()
    {
        if(isset($this->params['named']['meeting']))
        {
            $meeting_id = $this->params['named']['meeting'];
            $student_id = $this->params['named']['student'];
            $this->loadModel('Student');
            if($this->Student->habtmDelete('Meeting', $student_id, $meeting_id))
            {
                $this->Session->setFlash('Student byl smazán');
                $this->redirect($this->referer().'#meeting'.$meeting_id);
            }
            else
            {
                $this->Session->setFlash('Studenta se bohužel nepodařilo smazat. Kontaktuj IT!');
                $this->redirect($this->referer().'#meeting'.$meeting_id);
            }
        }
        if(isset($this->params['named']['training']))
        {
            $training_id = $this->params['named']['training'];
            $student_id = $this->params['named']['student'];
            $this->loadModel('Student');
            if($this->Student->habtmDelete('Training', $student_id, $training_id))
            {
                $this->Session->setFlash('Student byl smazán');
                $this->redirect($this->referer().'#training'.$training_id);
            }
            else
            {
                $this->Session->setFlash('Studenta se bohužel nepodařilo smazat. Kontaktuj IT!');
                $this->redirect($this->referer().'#training'.$training_id);
            }
        }
    }

    function potvrzeni()
    {
        if(isset($this->params['named']['meeting']))
        {
            $meeting_id = $this->params['named']['meeting'];
            $student_id = $this->params['named']['student'];
            if(!empty($student_id) && !empty($meeting_id))
            {
                $this->loadModel('MeetingsStudents');
                $this->MeetingsStudents->query('update meetings_students set potvrzeno = 1 where meeting_id = "'.$meeting_id.'" and student_id = "'.$student_id.'"');
                $this->Session->setFlash('Potvrzeno');
                $this->redirect($this->referer().'#meeting'.$meeting_id);
            }
        }
        if(isset($this->params['named']['training']))
        {
            $training_id = $this->params['named']['training'];
            $student_id = $this->params['named']['student'];
            if(!empty($student_id) && !empty($training_id))
            {
                $this->loadModel('StudentsTrainings');
                $this->StudentsTrainings->query('update students_trainings set potvrzeno = 1 where training_id = "'.$training_id.'" and student_id = "'.$student_id.'"');
                $this->Session->setFlash('Potvrzeno');
                $this->redirect($this->referer().'#training'.$training_id);
            }
        }
    }

    function __getUser($id)
    {
        $this->loadModel('User');
        $user = $this->User->find('first', array(
            'conditions' => array('id' => $id),
            'contain' => array()
        ));
        $data = array();
        foreach($user['User'] as $key=>$val)
        {
            $data[$key] = $val;
        }
        return $data;
    }
}
?>