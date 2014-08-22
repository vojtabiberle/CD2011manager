<?php
class CheckInController extends AppController {

	var $name = 'CheckIn';
        var $uses = array();

        function index()
        {
            if(!empty($this->data))
            {
                $student = $this->__search($this->data);
                if(!empty($student))
                {
                    $this->loadModel('Student');
                    if($student['Student']['byl_den2'] == 0)
                    {
                        $this->Student->id = $student['Student']['id'];
                        if($this->Student->saveField('byl_den2', 1))
                        {
                            $student['Student']['byl_den2'] = 1;
                            $key = $this->Student->query('select kw, subkw from smsses where id = '.$student['Student']['id_platby']);
                            $this->set('key', $key);
                            $this->set('student', $student);
                            return;
                            //$this->redirect(array('controller' => 'check_in'));
                        }
                        else
                        {
                            $this->Session->setFlash('Nepodařilo se zaznamenat příchod studenta. Kontaktujte IT a poznamenejte informace!');
                            $this->set('error', 'true');
                            $this->set('student', $student);
                            return;
                        }
                    }
                    else
                    {
                        $this->Session->setFlash('Tato vstupenka byla dnes již použita!');
                        $this->set('error', 'true');
                        $this->set('student', $student);
                        return;
                    }
                }
                else
                {//chyba - student nenalezen
                    $this->Session->setFlash('Student nenalezen!');
                    return;
                    //$this->redirect(array('controller' => 'check_in'));

                }
            }
        }

//        function index()
//        {
//            if(!empty($this->data))
//            {
//                $student = $this->__search($this->data);
//
//                if(!empty($student))
//                {
//                    $this->loadModel('Student');
//
//                    $date = date('j.n.Y');
//                    //$date = '3.3.2011';
//                    if(Configure::read('__careerdays_first_day_date') == $date)
//                    {
//                        $den = 1;
//                        if($student['Student']['byl_den1'] == 1)
//                        {
//                            $this->Session->setFlash('Tato vstupenka byla dnes již použita!');
//                            $this->set('error', 'true');
//                            $this->set('student', $student);
//                            return;
//                            //$this->redirect(array('controller' => 'check_in'));
//                        }
//                    }
//                    elseif(Configure::read('__careerdays_second_day_date') == $date)
//                    {
//                        $den = 2;
//                        if($student['Student']['byl_den2'] == 1)
//                        {
//                            $this->Session->setFlash('Tato vstupenka byla dnes již použita!');
//                            $this->set('error', 'true');
//                            $this->set('student', $student);
//                            return;
//                            //$this->redirect(array('controller' => 'check_in'));
//                        }
//                    }
//                    else
//                    {
//                        $this->Session->setFlash('Nastala chyba v určování data, obraťte se na IT!');
//                        return;
//                        //$this->redirect(array('controller' => 'check_in'));
//                    }
//
//                    if($student['Student']['zaplaceno_dnu'] == 2)
//                    {
//                        $this->Student->id = $student['Student']['id'];
//                        if($this->Student->saveField('byl_den'.$den, 1))
//                        {
//                            $student['Student']['byl_den'.$den] = 1;
//                            $key = $this->Student->query('select kw, subkw from smsses where id = '.$student['Student']['id_platby']);
//                            $this->set('key', $key);
//                            $this->set('student', $student);
//                            return;
//                            //$this->redirect(array('controller' => 'check_in'));
//                        }
//                        else
//                        {
//                            $this->Session->setFlash('Nepodařilo se zaznamenat příchod studenta. Kontaktujte IT a poznamenejte informace!');
//                            $this->set('error', 'true');
//                            $this->set('student', $student);
//                            return;
//                        }
//
//                    }
//                    elseif($student['Student']['zaplaceno_dnu'] == 1)
//                    {//zaplacen jeden den
//                        if($student['Student']['chce_den1'] == 1)
//                        {
//                            if($den == 1)
//                            {
//                                $this->Student->id = $student['Student']['id'];
//                                if($this->Student->saveField('byl_den'.$den, 1))
//                                {
//                                    $student['Student']['byl_den'.$den] = 1;
//                                    $key = $this->Student->query('select kw, subkw from smsses where id = '.$student['Student']['id_platby']);
//                                    $this->set('key', $key);
//                                    $this->set('student', $student);
//                                    return;
//                                    //$this->redirect(array('controller' => 'check_in'));
//                                }
//                                else
//                                {
//                                    $this->Session->setFlash('Nepodařilo se zaznamenat příchod studenta. Kontaktujte IT a poznamenejte informace!');
//                                    $this->set('error', 'true');
//                                    $this->set('student', $student);
//                                    return;
//                                }
//                            }
//                            else
//                            {
//                                $this->Session->setFlash('Student nemá zaplacený druhý den!');
//                                $this->set('error', 'true');
//                                $this->set('student', $student);
//                                return;
//                            }
//                        }
//                        elseif($student['Student']['chce_den2'] == 1)
//                        {
//                            if($den == 2)
//                            {
//                                $this->Student->id = $student['Student']['id'];
//                                if($this->Student->saveField('byl_den'.$den, 1))
//                                {
//                                    $student['Student']['byl_den'.$den] = 1;
//                                    $key = $this->Student->query('select kw, subkw from smsses where id = '.$student['Student']['id_platby']);
//                                    $this->set('key', $key);
//                                    $this->set('student', $student);
//                                    return;
//                                    //$this->redirect(array('controller' => 'check_in'));
//                                }
//                                else
//                                {
//                                    $this->Session->setFlash('Nepodařilo se zaznamenat příchod studenta. Kontaktujte IT a poznamenejte informace!');
//                                    $this->set('error', 'true');
//                                    $this->set('student', $student);
//                                    return;
//                                }
//                            }
//                            else
//                            {
//                                $this->Session->setFlash('Student nemá zaplacený první den!');
//                                $this->set('error', 'true');
//                                $this->set('student', $student);
//                                return;
//                            }
//                        }
//                    }
//                    else
//                    {
//                        $this->Session->setFlash('Student nemá zaplacen ani jeden den. Možná chyba v systému, obraťte se na IT!');
//                        $this->set('student', $student);
//                        return;
//                        //$this->redirect(array('controller' => 'check_in'));
//                    }
//                }
//                else
//                {//chyba - student nenalezen
//                    $this->Session->setFlash('Student nenalezen!');
//                    return;
//                    //$this->redirect(array('controller' => 'check_in'));
//                }
//            }
//        }

        function smsreg()
        {
            if(!empty($this->data))
            {
                if(isset($this->data['Student']['regcode']))
                {
                    $this->loadModel('Smss');
                    $regcod = $this->Smss->find('first', array(
                        'conditions' => array('generated_key' => $this->data['Student']['regcode'])
                    ));

                    if($regcod['Smss']['byl_pouzit'] == 1)
                    {
                        $this->Session->setFlash('SMS kód byl použit!');
                        $this->redirect(array('action' => 'smsreg'));
                    }
                    //pr($regcod);
                    if(substr($regcod['Smss']['tarif'], -2) == '99')
                    {
                        $dnu = 2;
                    }
                    elseif(substr($regcod['Smss']['tarif'], -2) == '79')
                    {
                        $dnu = 1;
                    }
                    else
                    {
                        $this->Session->setFlash('Nelze určit počet dnů, kontaktujte IT.');
                        //$this->redirect(array('action' => 'smsreg'));
                    }

                    $this->set('dnu', $dnu);
                    $this->set('showform', true);
                }
                elseif(isset($this->data['Student']['checkform']))
                {
                    $date = date('j.n.Y');
                    //$date = '3.3.2011';
                    if(Configure::read('__careerdays_first_day_date') == $date)
                    {
                        $den = 1;
                    }
                    elseif(Configure::read('__careerdays_second_day_date') == $date)
                    {
                        $den = 2;
                    }
                    else
                    {
                        $this->Session->setFlash('Nastala chyba v určování data, obraťte se na IT!');
                        return;
                        //$this->redirect(array('controller' => 'check_in'));
                    }

                    if(isset($this->data['Student']['den']))
                    {
                        if($this->data['Student']['den'] == 1)
                        {
                            $this->data['Student']['chce_den1'] = 1;
                        }
                        if($this->data['Student']['den'] == 2)
                        {
                            $this->data['Student']['chce_den2'] = 1;
                        }
                        $this->data['Student']['zaplaceno_dnu'] = 1;
                    }
                    else
                    {
                        $this->data['Student']['chce_den1'] = 1;
                        $this->data['Student']['chce_den2'] = 1;
                        $this->data['Student']['zaplaceno_dnu'] = 2;
                    }

                    $this->loadModel('Student');
                    

                    if($den == 1 && $this->data['Student']['chce_den1'] == 1)
                    {
                        $this->data['Student']['byl_den'.$den] = 1;
                    }
                    if($den == 2 && $this->data['Student']['chce_den2'] == 1)
                    {
                        $this->data['Student']['byl_den'.$den] = 1;
                    }

                    if(isset($this->data['Student']['skola']) && isset($this->data['Student']['obor']))
                    {
                        $school = $this->Student->School->find('first',array(
                            'conditions' => array('AND' => array(
                                'nazev' => $this->data['Student']['skola'],
                                'nazev_studijniho_oboru' => $this->data['Student']['obor']
                                )
                            )
                        ));
                        //$this->data['Student']['school_id'] = $school['School']['id'];
                        $this->data['School'] = $school['School'];
                    }

                    if(empty($this->data['School']))
                    {
                        $this->Session->setFlash('Zadej prosím školu a obor.');
                        return;
                    }

                    if((empty($this->data['User']['email'])) && ($this->data['User']['email'] != $this->data['User']['emailCheck']))
                    {
                        $this->Session->setFlash('Zadej prosím stejné emailové adresy.');
                        return;
                    }
                    if((empty($this->data['User']['password'])) && ($this->data['User']['password'] != $this->Auth->password($this->data['User']['passwordCheck'])))
                    {
                        $this->Session->setFlash('Zadej prosím stejná hesla.');
                        return;
                    }


    //                pr($this->data);
    //                exit;

                    if(empty($this->data['User']['jmeno']) || empty($this->data['User']['prijmeni']))
                    {
                        $this->Session->setFlash('Zadej prosím jméno a příjmení.');
                        return;
                    }

                    $typ = $this->data['Student']['typ'];
                    if($typ == 'B' || $typ == 'N')
                    {
                        if(empty($this->data['Student']['rocnik']))
                        {
                            $this->Session->setFlash('Zadej prosím ročník.');
                            return;
                        }
                    }


                    $this->data['Student']['barcode'] = $this->__rand_chars(6, 10);

                    if($this->Student->saveAll($this->data))
                    {
                        $this->Session->setFlash('Student byl zaregistrován a jeho příchod zaznamenán. <a href="/check_in/tisk/'.$this->Student->id.'">Tiskni</a> vstupenku.');
                        unset($this->data);
                    }
                    else
                    {
                        $this->Session->setFlash('Studenta se nepodařilo zaregistrovat. Kontaktujte IT.');
                    }
                }
                else
                {
                    $this->Session->setFlash('Neplatný formulář. kotaktujte IT.');
                    $this->redirect(array('action' => 'smsreg'));
                }
            }
        }

        function dokoupit()
        {
            if(!empty($this->data))
            {
                if(!empty($this->data['CheckIn']['student_id']))
                {
                    $date = date('j.n.Y');
                    //$date = '3.3.2011';
                    if(Configure::read('__careerdays_first_day_date') == $date)
                    {
                        $den = 1;
                    }
                    elseif(Configure::read('__careerdays_second_day_date') == $date)
                    {
                        $den = 2;
                    }
                    else
                    {
                        $this->Session->setFlash('Nastala chyba v určování data, obraťte se na IT!');
                        return;
                        //$this->redirect(array('controller' => 'check_in'));
                    }

                    $this->loadModel('Student');
                    $this->Student->id = $this->data['CheckIn']['student_id'];
                    $student = $this->Student->read();
                    if(isset($this->data['CheckIn']['prvni_den']) || isset($this->data['CheckIn']['druhy_den']))
                    {
                        if($student['Student']['zaplaceno_dnu'] == 1)
                        {
                            $student['Student']['zaplaceno_dnu'] = 2;
                            $student['Student']['chce_den'.$den] = 1;
                            $student['Student']['byl_den'.$den] = 1;
                            if($this->Student->save($student))
                            {
                                $this->Session->setFlash('Vstupenka dokoupena. Byl zaznamenán příchod studenta na Career Days.');
                                $this->set('student', $student);
                            }
                            else
                            {
                                $this->Session->setFlash('Nepodařilo se dokoupit vstupenku. Kotaktujte IT a poznamenejte informace!');
                                $this->set('student', $student);
                            }
                        }
                        else
                        {
                            $this->Session->setFlash('Student nemá zaplacen ani jeden den. Je potřeba vytvořit novou registraci.');
                            return;
                        }
                    }
                    else
                    {
                        $this->Session->setFlash('Nenastaven den nákupu vstupenky. Kontaktujte IT.');
                        return;
                    }
                }
                else
                {

                    $student = $this->__search($this->data);

                    if(!empty($student))
                    {
                        $this->set('student', $student);
                    }
                    else
                    {
                        $this->Session->setFlash('Student nenalezen');
                        return;
                    }
                }
            }
        }

        function koupit()
        {
            if(!empty($this->data))
            {
                $date = date('j.n.Y');
                //$date = '3.3.2011';
                if(Configure::read('__careerdays_first_day_date') == $date)
                {
                    $den = 1;
                }
                elseif(Configure::read('__careerdays_second_day_date') == $date)
                {
                    $den = 2;
                }
                else
                {
                    $this->Session->setFlash('Nastala chyba v určování data, obraťte se na IT!');
                    return;
                    //$this->redirect(array('controller' => 'check_in'));
                }

                $this->loadModel('Student');
                if($this->data['Student']['chce_den1'] == 1 && $this->data['Student']['chce_den2'] == 1)
                {
                    $this->data['Student']['zaplaceno_dnu'] = 2;
                }
                else
                {
                    $this->data['Student']['zaplaceno_dnu'] = 1;
                }

                if($den == 1 && $this->data['Student']['chce_den1'] == 1)
                {
                    $this->data['Student']['byl_den'.$den] = 1;
                }
                if($den == 2 && $this->data['Student']['chce_den2'] == 1)
                {
                    $this->data['Student']['byl_den'.$den] = 1;
                }

                if(isset($this->data['Student']['skola']) && isset($this->data['Student']['obor']))
                {
                    $school = $this->Student->School->find('first',array(
                        'conditions' => array('AND' => array(
                            'nazev' => $this->data['Student']['skola'],
                            'nazev_studijniho_oboru' => $this->data['Student']['obor']
                            )
                        )
                    ));
                    //$this->data['Student']['school_id'] = $school['School']['id'];
                    $this->data['School'] = $school['School'];
                }
                
                if(empty($this->data['School']))
                {
                    $this->Session->setFlash('Zadej prosím školu a obor.');
                    return;
                }

                if((empty($this->data['User']['email'])) && ($this->data['User']['email'] != $this->data['User']['emailCheck']))
                {
                    $this->Session->setFlash('Zadej prosím stejné emailové adresy.');
                    return;
                }
                if((empty($this->data['User']['password'])) && ($this->data['User']['password'] != $this->Auth->password($this->data['User']['passwordCheck'])))
                {
                    $this->Session->setFlash('Zadej prosím stejná hesla.');
                    return;
                }


//                pr($this->data);
//                exit;

                if(empty($this->data['User']['jmeno']) || empty($this->data['User']['prijmeni']))
                {
                    $this->Session->setFlash('Zadej prosím jméno a příjmení.');
                    return;
                }

                $typ = $this->data['Student']['typ'];
                if($typ == 'B' || $typ == 'N')
                {
                    if(empty($this->data['Student']['rocnik']))
                    {
                        $this->Session->setFlash('Zadej prosím ročník.');
                        return;
                    }
                }


                $this->data['Student']['barcode'] = $this->__rand_chars(6, 10);

                if($this->Student->saveAll($this->data))
                {
                    $this->Session->setFlash('Student byl zaregistrován a jeho příchod zaznamenán. <a href="/check_in/tisk/'.$this->Student->id.'">Tiskni</a> vstupenku.');
                    unset($this->data);
                }
                else
                {
                    $this->Session->setFlash('Studenta se nepodařilo zaregistrovat. Kontaktujte IT.');
                }
            }
        }

        function vstupenka($id = null)
        {
            $this->layout = 'ajax';
            $this->loadModel('Student');
            $student = $this->Student->find('first',array(
                    'conditions' => array('Student.id' => $id),
                    //'contain' => array('User', 'Emplyee', 'Field')
            ));

            if($student['Student']['barcode'] == null)
            {
                $barcode = $this->__rand_chars(6, 10);
                $this->Student->id = $student['Student']['id'];
                $this->Student->saveField('barcode', $barcode);
                $student['Student']['barcode'] = $barcode;
            }

            $this->set('student', $student);
            $this->set('title_for_layout', __('Vstupenka', true));

            $this->set('agenda', $this->__getAgenda($student));
        }

        function tisk($id = null)
        {
            $this->autoRender = false;
            $html = $this->requestAction('/check_in/vstupenka/'.$id, array('return'));
            define('RELATIVE_PATH', APP_PATH.'vendors'.DS.'html2fpdf'.DS);

            ini_set('error_reporting', 'E_ALL & ~E_NOTICE');
            ini_set('max_execution_time', 120);
            App::import('vendor', 'mpdf', array('file' => 'mpdf'.DS.'mpdf.php'));
            $mpdf = new mPDF('cs');
            $mpdf->SetTitle('Career Days 2011 - vstupenka');
            $mpdf->SetAuthor('Career Days 2011');
            $mpdf->SetCreator('Career Days 2011');
            $mpdf->setBasePath($_REQUEST['url']);
            $mpdf->showImageErrors = true;
            $mpdf->WriteHTML($html);
            $mpdf->output('vstupenka.pdf', 'D');
        }

        function search()
        {
            if(!empty($this->data))
            {
                $student = $this->__search($this->data);
                $this->set('student', $student);
            }
        }

        function __search($data)
        {
            
            if(!empty($data['CheckIn']['barcode']))
            {
                $this->loadModel('Student');
                $student = $this->Student->find('first', array(
                    'conditions' => array('barcode LIKE' => $data['CheckIn']['barcode']),
                    'contain' => array('User')
                ));
            }
            if(!empty($data['CheckIn']['username']))
            {
                $this->loadModel('User');
                $student = $this->User->find('first', array(
                    'conditions' => array('username LIKE' => $data['CheckIn']['username']),
                    'contain' => array('Student')
                ));
                $student['Student'] = $student['Student'][0];
            }
            if(!empty($data['CheckIn']['email']))
            {
                $this->loadModel('User');
                $student = $this->User->find('first', array(
                    'conditions' => array('email LIKE' => $data['CheckIn']['email']),
                    'contain' => array('Student')
                ));
                $student['Student'] = $student['Student'][0];
            }

            if(!isset($student['Student']['id']))
                return;

            return $student;
        }

        /** Vygenerování náhodného řetězce
        * @param int [$count] délka vráceného řetězce
        * @param int [$chars] použité znaky: <=10 číslice, <=36 +malá písmena, <=62 +velká písmena
        * @return string náhodný řetězec
        * @copyright Jakub Vrána, http://php.vrana.cz
        */
        function __rand_chars($count, $chars)
        {
            $return = "";
            for ($i=0; $i < $count; $i++) {
                $rand = rand(0, $chars - 1);
                $return .= chr($rand + ($rand < 10 ? ord('0') : ($rand < 36 ? ord('a') - 10 : ord('A') - 36)));
            }
            return $return;
        }

        function __getAgenda($student)
        {

            $agenda = array('den1' => array(), 'den2' => array());
            if(isset($student['Training']))
            {
                foreach($student['Training'] as $training)
                {
                    if($training['den'] == '2011-03-02')
                    {
                        $training['typ'] = 'training';
                        $data = $this->__getRoomAndCompanyNameFromCompanyId($training['company_id']);
                        $training['room_name'] = $data['room_name'];
                        $training['company_name'] = $data['company_name'];
                        $agenda['den1'][] = $training;
                    }
                    if($training['den'] == '2011-03-03')
                    {
                        $training['typ'] = 'training';
                        $data = $this->__getRoomAndCompanyNameFromCompanyId($training['company_id']);
                        $training['room_name'] = $data['room_name'];
                        $training['company_name'] = $data['company_name'];
                        $agenda['den2'][] = $training;
                    }
                }
            }
            if(isset($student['Meeting']))
            {
                foreach($student['Meeting'] as $meeting)
                {
                    if($meeting['den'] == 1)
                    {
                        $meeting['typ'] = 'meeting';
                        $data = $this->__getRoomAndCompanyNameFromCompanyId($meeting['company_id']);
                        $meeting['room_name'] = $data['room_name'];
                        $meeting['company_name'] = $data['company_name'];
                        $agenda['den1'][] = $meeting;
                    }
                    if($meeting['den'] == 2)
                    {
                        $meeting['typ'] = 'meeting';
                        $data = $this->__getRoomAndCompanyNameFromCompanyId($meeting['company_id']);
                        $meeting['room_name'] = $data['room_name'];
                        $meeting['company_name'] = $data['company_name'];
                        $agenda['den2'][] = $meeting;
                    }
                }
            }

            return $agenda;
        }

        function __getRoomAndCompanyNameFromCompanyId($id = null)
        {
            $this->loadModel('Company');
            $company = $this->Company->find('first', array(
                'conditions' => array('Company.id' => $id)
            ));

            if($company['Company']['room_day_1'] != null)
            {
                return array('room_name' => $company['RoomDay1']['name'], 'company_name' => $company['Company']['name']);
            }
            elseif($company['Company']['room_day_2'] != null)
            {
                return array('room_name' => $company['RoomDay2']['name'], 'company_name' => $company['Company']['name']);
            }
            else
            {
                return null;
            }
        }
}
?>