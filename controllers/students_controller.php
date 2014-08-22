<?php
class StudentsController extends AppController {

	var $name = 'Students';
        var $layout = 'student';
        var $components = array('RequestHandler');

        function  beforeFilter()
        {
            $this->Auth->allowedActions = array('index', 'program', 'et_day', 'zaregistruj_se', 'pay', 'register', 'check_username', 'check_email', 'autoschool', 'autoobor', 'counter');
            parent::beforeFilter();
            
        }

        function program()
       {
            $this->layout = 'simple';
            
            $date = date('j.n.Y');
            if($date == '2.3.2011')
            {
                $den = 1;
            }
            elseif($date == '3.3.2011')
            {
                $den = 2;
            }
            else
            {
               $den = -1;
            }

            $time = rmSecond(date('H:i:s'));

            $endtime = addTime($time, '01:00');

            $time = $time.':00';
            $endtime = $endtime.':00';

            //echo $endtime;

            $this->loadModel('Training');
            $this->loadModel('Meeting');
            //$this->loadModel('PanelDiscussion');
            //$this->Meeting->recursive = 2;
            $meetings = $this->Meeting->find('all', array(
                'conditions' => array('den' => $den, 'zacatek >=' => $time),
                'order' => array('zacatek ASC'),
                'limit' => 20
            ));

            

            foreach($meetings as $key => $meeting)
            {
                $meetings[$key]['Company']['room_day_1_name'] = $this->__getRoomNameFromId(($meeting['Company']['room_day_1']));
                $meetings[$key]['Company']['room_day_2_name'] = $this->__getRoomNameFromId(($meeting['Company']['room_day_2']));
            }
            //pr($meetings);
            $trainings = $this->Training->find('all', array(
                'order' => array('datetime ASC')
                
            ));
            
            //pr($trainings);

//            $tr = array();
//            foreach($trainings as $training)
//            {
//                if($training['Training']['den'] == '2011-03-03')
//                {
//                    $tr[] = $training;
//                }
//            }
//            pr($training);
            //$panel_discussions = $this->PanelDiscussion->find('all');

            

            $this->set(compact('meetings', 'trainings', 'den'));
            //pr($meetings);
            //pr($trainings);
        }

        function tisk()
        {
            $this->autoRender = false;
            $html = $this->requestAction('/students/vstupenka', array('return'));
            define('RELATIVE_PATH', APP_PATH.'vendors'.DS.'html2fpdf'.DS);
//            App::import('vendor', 'html2fpdf', array('file' => 'html2fpdf'.DS.'html2fpdf.php'));
//
//            $html=utf8_decode($html);
//
//            $pdf=new HTML2FPDF();
//            $pdf->AddPage();
//            $pdf->ReadMetaTags($html);
//            $pdf->WriteHTML($html);
//            $pdf->Output("vstupenka.pdf", 'D');

//            App::import('vendor', 'dompdf', array('file' => 'dompdf'.DS.'dompdf_config.inc.php'));
//            $dompdf = new DOMPDF();
//            $dompdf->set_base_path('http://student');
//            $dompdf->load_html($html);
//            $dompdf->render();
//            $dompdf->stream("sample.pdf");

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

        function vstupenka()
        {
            $this->layout = 'ajax';
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
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

        function barcode()
        {
            $this->autoRender = false;
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    'contain' => array('Meeting')
            ));

            if($student['Student']['barcode'] == null)
            {
                $barcode = $this->__rand_chars(6, 10);
                $this->Student->id = $student['Student']['id'];
                $this->Student->saveField('barcode', $barcode);
            }
            else
            {
                $barcode = $student['Student']['barcode'];
            }

            App::import('vendor', 'BCGFont', array('file' => 'barcodegen'.DS.'BCGFont.php'));
            App::import('vendor', 'BCGColor', array('file' => 'barcodegen'.DS.'BCGColor.php'));
            App::import('vendor', 'BCGDrawing', array('file' => 'barcodegen'.DS.'BCGDrawing.php'));
            App::import('vendor', 'BCGcode39', array('file' => 'barcodegen'.DS.'BCGcode39.barcode.php'));

            //pr(VENDORS.'barcodegen'.DS.'font'.DS.'Arial.ttf');
            //$font = new BCGFont(VENDORS.'barcodegen'.DS.'font'.DS.'Arial.ttf', 18);
            $color_black = new BCGColor(0, 0, 0);
            $color_white = new BCGColor(255, 255, 255);

            $code = new BCGcode39();
            $code->setScale(2);
            $code->setThickness(30);
            $code->setForegroundColor($color_black);
            $code->setBackgroundColor($color_white);
            //$code->setFont($font);
            $code->setChecksum(false);
            $code->parse($barcode);

            // Drawing Part
            $drawing = new BCGDrawing('', $color_white);
            $drawing->setBarcode($code);
            $drawing->draw();

            header('Content-Type: image/png');

            $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

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

        function et_day()
        {
            
        }

        function counter()
        {
            $this->layout = 'student';
            $data['all']['students'] = $this->Student->query('select *  from view_all_students_count as sum');
            $data['all']['aiesecers'] = $this->Student->query('select *  from view_all_aiesecers_count as sum');
            $data['all']['goal'] = 2036;
            $data['no_lc']['students'] = $this->Student->query('select * from view_no_lc_students_count as sum');
            $data['brno']['aiesecers'] = $this->Student->query('select * from view_brno_aiesecers_count as sum');
            $data['brno']['students'] = $this->Student->query('select * from view_brno_students_count as sum');
            $data['brno']['goal'] = 210;
            $data['czu']['aiesecers'] = $this->Student->query('select * from view_czu_aiesecers_count as sum');
            $data['czu']['students'] = $this->Student->query('select * from view_czu_students_count as sum');
            $data['czu']['goal'] = 150;
            $data['hradec']['aiesecers'] = $this->Student->query('select * from view_hradec_aiesecers_count as sum');
            $data['hradec']['students'] = $this->Student->query('select * from view_hradec_students_count as sum');
            $data['hradec']['goal'] = 36;
            $data['karvina']['aiesecers'] = $this->Student->query('select * from view_karvina_aiesecers_count as sum');
            $data['karvina']['students'] = $this->Student->query('select * from view_karvina_students_count as sum');
            $data['karvina']['goal'] = 235;
            $data['olomouc']['aiesecers'] = $this->Student->query('select * from view_olomouc_aiesecers_count as sum');
            $data['olomouc']['students'] = $this->Student->query('select * from view_olomouc_students_count as sum');
            $data['olomouc']['goal'] = 95;
            $data['ostrava']['aiesecers'] = $this->Student->query('select * from view_ostrava_aiesecers_count as sum');
            $data['ostrava']['students'] = $this->Student->query('select * from view_ostrava_students_count as sum');
            $data['ostrava']['goal'] = 340;
            $data['plzen']['aiesecers'] = $this->Student->query('select * from view_plzen_aiesecers_count as sum');
            $data['plzen']['students'] = $this->Student->query('select * from view_plzen_students_count as sum');
            $data['plzen']['goal'] = 115;
            $data['praha']['aiesecers'] = $this->Student->query('select * from view_praha_aiesecers_count as sum');
            $data['praha']['students'] = $this->Student->query('select * from view_praha_students_count as sum');
            $data['praha']['goal'] = 755;
            $data['zlin']['aiesecers'] = $this->Student->query('select * from view_zlin_aiesecers_count as sum');
            $data['zlin']['students'] = $this->Student->query('select * from view_zlin_students_count as sum');
            $data['zlin']['goal'] = 100;

            $this->set('data', $data);
        }

        function realcounter()
        {
            $this->layout = 'default';
            $user = $this->Auth->user();
            if($user['User']['group_id'] != 1)
            {
                exit;
            }
            $data['all']['1'] = $this->Student->query('select * from view_all_prisli1_count as cnt');
            $data['all']['2'] = $this->Student->query('select * from view_all_prisli2_count as cnt');
            $data['all']['goal'] = 2036;
            $data['brno']['1'] = $this->Student->query('select * from view_brno_prisli1_count as cnt');
            $data['brno']['2'] = $this->Student->query('select * from view_brno_prisli2_count as cnt');
            $data['brno']['goal'] = 210;
            $data['czu']['1'] = $this->Student->query('select * from view_czu_prisli1_count as cnt');
            $data['czu']['2'] = $this->Student->query('select * from view_czu_prisli2_count as cnt');
            $data['czu']['goal'] = 150;
            $data['hradec']['1'] = $this->Student->query('select * from view_hradec_prisli1_count as cnt');
            $data['hradec']['2'] = $this->Student->query('select * from view_hradec_prisli2_count as cnt');
            $data['hradec']['goal'] = 36;
            $data['karvina']['1'] = $this->Student->query('select * from view_karvina_prisli1_count as cnt');
            $data['karvina']['2'] = $this->Student->query('select * from view_karvina_prisli2_count as cnt');
            $data['karvina']['goal'] = 235;
            $data['olomouc']['1'] = $this->Student->query('select * from view_olomouc_prisli1_count as cnt');
            $data['olomouc']['2'] = $this->Student->query('select * from view_olomouc_prisli2_count as cnt');
            $data['olomouc']['goal'] = 95;
            $data['ostrava']['1'] = $this->Student->query('select * from view_ostrava_prisli1_count as cnt');
            $data['ostrava']['2'] = $this->Student->query('select * from view_ostrava_prisli2_count as cnt');
            $data['ostrava']['goal'] = 340;
            $data['plzen']['1'] = $this->Student->query('select * from view_plzen_prisli1_count as cnt');
            $data['plzen']['2'] = $this->Student->query('select * from view_plzen_prisli2_count as cnt');
            $data['plzen']['goal'] = 115;
            $data['praha']['1'] = $this->Student->query('select * from view_praha_prisli1_count as cnt');
            $data['praha']['2'] = $this->Student->query('select * from view_praha_prisli2_count as cnt');
            $data['praha']['goal'] = 755;
            $data['zlin']['1'] = $this->Student->query('select * from view_zlin_prisli1_count as cnt');
            $data['zlin']['2'] = $this->Student->query('select * from view_zlin_prisli2_count as cnt');
            $data['zlin']['goal'] = 100;
            $data['nolc']['1'] = $this->Student->query('select * from view_no_lc_prisli1_count as cnt');
            $data['nolc']['2'] = $this->Student->query('select * from view_no_lc_prisli2_count as cnt');

            $this->set('data', $data);
        }

        function meeting_register($id = null)
        {
            if($this->RequestHandler->isAjax())
            {
                $this->layout = 'ajax';
            }
            else
            {
                $this->layout = 'student';
            }

            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    'contain' => array('Meeting')
            ));
            $this->set('student', $student);

            if(!empty($this->data))
            {
                $meeting = $this->Student->Meeting->find('first', array(
                    'conditions' => array('Meeting.id' => $this->data['Student']['meeting_id']),
                    'contain' => array('Student')
                ));
//                pr($meeting);
//                exit;

                if(!empty($this->data['Student']['zanechat_kontakt']))
                {
                    if($this->Student->query('insert into meetings_students_logs (student_id, meeting_id, souhlas_s_pozadavky, predat_kontakt) values('.$student['Student']['id'].','.$meeting['Meeting']['id'].',0,1)'))
                    {
                        $this->Session->setFlash('Tvůj kontakt bude předán firmě.');
                        $this->redirect('/priprav_se');
                    }
                }

                $cmtg = count($meeting['Student']);

                if($cmtg >= $meeting['Meeting']['max_pocet_ucastniku'])
                {
                    $this->Session->setFlash('Toto setkání už je plně obsazeno.');
                    $this->redirect('/priprav_se');
                }
                if($this->__siFree($meeting['Meeting']['zacatek'], $meeting['Meeting']['konec'], $meeting['Meeting']['den']))
                {
//                    pr($student);
//                    pr($training);
//                    exit;
                    if(empty($this->data['Student']['pozadavky_souhlas']))
                    {
                        $this->Session->setFlash('Nemůžeme tě přihlásit na setkání, pokud nesouhlasíš s požadavky firmy na studenty!');
                        $this->redirect('/priprav_se');
                    }
                    if($this->Student->habtmAdd('Meeting', $student['Student']['id'], $meeting['Meeting']['id']))
                    {
                        $this->Student->query('insert into meetings_students_logs (student_id, meeting_id, souhlas_s_pozadavky, predat_kontakt) values('.$student['Student']['id'].','.$meeting['Meeting']['id'].',1,0)');
                        $this->Session->setFlash('Byl(a) jsi přihlášen(a) na setkání.');
                        $this->redirect('/priprav_se');
                    }
                    else
                    {
                        $this->Session->setFlash('Něco se bohužel nepovedlo a Tvé přihlášení se nezdařilo.');
                        $this->redirect('/priprav_se');
                    }
                }
                else
                {
                    $this->Session->setFlash('V tomto čase již máš zaregistrovaný trénink nebo setkání!');
                    $this->redirect('/priprav_se');
                }
            }

            if(!$id)
            {
                $this->Session->setFlash(__('Neznámé setkání s firmou.', true));
                $this->redirect('/priprav_se');
            }

            $mtg = $this->Student->Meeting->find('first', array(
                'conditions' => array('Meeting.id' => $id)
            ));

            $this->set('meeting', $mtg);
            
        }

        function meeting_unregister($id = null)
        {
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    'contain' => array()
            ));
            if(!$id)
            {
                $this->Session->setFlash(__('Neznámé setkání.', true));
                $this->redirect('/priprav_se');
            }

            //$this->loadModel('Training');
            $mtg = $this->Student->Meeting->find('first', array(
                'conditions' => array('Meeting.id' => $id),
                'contain' => array('Student')
            ));

            $jeNaMeetingu = false;
            foreach($mtg['Student'] as $st)
            {
                if($st['id'] == $student['Student']['id'])
                    $jeNaMeetingu = true;
            }

            if($jeNaMeetingu)
            {
                if($this->Student->habtmDelete('Meeting', $student['Student']['id'], $mtg['Meeting']['id']))
                {
                    $this->Session->setFlash(__('Byl(a) jsi odhlášen(a) ze setkání.', true));
                    $this->redirect('/priprav_se');
                }
                else
                {
                    $this->Session->setFlash(__('Něco se bohužel nepovedlo a Tvé odhlášení se nezdařilo.', true));
                    $this->redirect('/priprav_se');
                }
            }
            else
            {
                $this->Session->setFlash(__('Nepokoušej se prosím odhlásit jiné než svoje setkání!', true));
                $this->redirect('/priprav_se');
            }
        }

        function training_register($id = null)
        {
            if($this->RequestHandler->isAjax())
            {
                $this->layout = 'ajax';
            }
            else
            {
                $this->layout = 'student';
            }

            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    'contain' => array()
            ));
            $this->set('student', $student);

            if(!empty($this->data))
            {
                $training = $this->Student->Training->find('first', array(
                    'conditions' => array('Training.id' => $this->data['Student']['training_id']),
                    'contain' => array('Student')
                ));
                list($date, $time) = explode(' ', toCzechDateTime($training['Training']['datetime']));
                $startTime = $time;
                $endTime = addTime($time, '01:30');

                $ctr = count($training['Student']);
                if($ctr >= 20)
                {
                    $this->Session->setFlash('Tento trénink už je plně obsazen.');
                    $this->redirect('/priprav_se');
                }
                //FIXME: tohle je fakt škaredý
                if($date == '02.03.2011')
                {
                    $d = 1;
                }
                elseif($date == '03.03.2011')
                {
                    $d = 2;
                }
                else
                {
                    $d = -1;
                }

                if($this->__siFree($startTime, $endTime, $d))
                {
//                    pr($student);
//                    pr($training);
//                    exit;
                    if($this->Student->habtmAdd('Training', $student['Student']['id'], $training['Training']['id']))
                    {
                        $this->Session->setFlash('Byl(a) jsi přihlášen(a) na trénink.');
                        $this->redirect('/priprav_se');
                    }
                    else
                    {
                        $this->Session->setFlash('Něco se bohužel nepovedlo a Tvé přihlášení se nezdařilo.');
                        $this->redirect('/priprav_se');
                    }
                }
                else
                {
                    $this->Session->setFlash('V tomto čase již máš zaregistrovaný trénink nebo setkání!');
                    $this->redirect('/priprav_se');
                }
            }

            if(!$id)
            {
                $this->Session->setFlash(__('Neznámý trénink.', true));
                $this->redirect('/priprav_se');
            }

            //$this->loadModel('Training');
            $tr = $this->Student->Training->find('first', array(
                'conditions' => array('Training.id' => $id),
                'contain' => array('Student')
            ));

            $this->set('training', $tr);
        }

        function training_unregister($id = null)
        {
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    'contain' => array()
            ));
            if(!$id)
            {
                $this->Session->setFlash(__('Neznámý trénink.', true));
                $this->redirect('/priprav_se');
            }

            //$this->loadModel('Training');
            $tr = $this->Student->Training->find('first', array(
                'conditions' => array('Training.id' => $id),
                'contain' => array('Student')
            ));

            $jeNaTreninku = false;
            foreach($tr['Student'] as $st)
            {
                if($st['id'] == $student['Student']['id'])
                    $jeNaTreninku = true;
            }

            if($jeNaTreninku)
            {
                if($this->Student->habtmDelete('Training', $student['Student']['id'], $tr['Training']['id']))
                {
                    $this->Session->setFlash(__('Byl(a) jsi odhlášen(a) z tréninku.', true));
                    $this->redirect('/priprav_se');
                }
                else
                {
                    $this->Session->setFlash(__('Něco se bohužel nepovedlo a Tvé odhlášení se nezdařilo.', true));
                    $this->redirect('/priprav_se');
                }
            }
            else
            {
                $this->Session->setFlash(__('Nepokoušej se prosím odhlásit jiné než svoje tréninky!', true));
                $this->redirect('/priprav_se');
            }
        }

        /**
         * @return true/false
         * @param <type> $fromTime format 00:00
         * @param <type> $toTime format 00:00
         */
        function __siFree($fromTime, $toTime, $den)
        {
            $isFree=true;
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    'contain' => array('Meeting', 'Training')
            ));

            //pr($student);
            //exit;

            if($den == -1)
            {
                return $den;
            }

            if(!empty($student['Training']))
            {
                foreach($student['Training'] as $training)
                {
                    list($date, $time) = explode(' ', toCzechDateTime($training['datetime']));
                    //FIXME: tohle je fakt škaredý
                    if($date == '02.03.2011')
                    {
                        $d = 1;
                    }
                    elseif($date == '03.03.2011')
                    {
                        $d = 2;
                    }
                    else
                    {
                        $d = -1;
                        return $d;
                    }
                    if($d == $den)
                    {
                        if(timeBetweenTimes($fromTime, $training['zacatek'], $training['konec']) || timeBetweenTimes($toTime, $training['zacatek'], $training['konec']))
                        {
                            $isFree=false;
                        }
                    }
                }
            }

            if(!empty($student['Meeting']))
            {
                foreach($student['Meeting'] as $meeting)
                {
                    if($meeting['den'] == $den)
                    {
                        if(timeBetweenTimes($fromTime, $meeting['zacatek'], $meeting['konec']) || timeBetweenTimes($toTime, $meeting['zacatek'], $meeting['konec']))
                        {
                            $isFree=false;
                        }
                    }
                }
            }

            return $isFree;
        }

        function first_day()
        {
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    //'contain' => array('User', 'Emplyee', 'Field')
            ));

            if(!empty($student['Student']['chce_den1']) || !empty($student['Student']['chce_den2']) )
            {
                $this->Session->setFlash(__('Den tvého příjezdu je již nastaven.', true), 'flash_error');
                $this->redirect('/priprav_se');
            }

            $student['Student']['chce_den1'] = 1;
            $student['Student']['chce_den2'] = 0;
            if($this->Student->save($student))
            {
                $this->Session->setFlash(__('Očekáváme tě první den.', true), 'flash_success');
                $this->redirect('/priprav_se');
            }
            else
            {
                $this->Session->setFlash(__('Nepovedl se nastavit den. Zkus to za chvilku znovu.', true), 'flash_error');
                $this->redirect('/priprav_se');
            }
        }

        function second_day()
        {
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    //'contain' => array('User', 'Emplyee', 'Field')
            ));

            if(!empty($student['Student']['chce_den1']) || !empty($student['Student']['chce_den2']) )
            {
                $this->Session->setFlash(__('Den tvého příjezdu je již nastaven.', true), 'flash_error');
                $this->redirect('/priprav_se');
            }

            $student['Student']['chce_den1'] = 0;
            $student['Student']['chce_den2'] = 1;
            if($this->Student->save($student))
            {
                $this->Session->setFlash(__('Očekáváme tě druhý den.'), 'flash_success', true);
                $this->redirect('/priprav_se');
            }
            else
            {
                $this->Session->setFlash(__('Nepovedl se nastavit den. Zkus to za chvilku znovu.', true), 'flash_error');
                $this->redirect('/priprav_se');
            }
        }

        function index()
        {
            $this->set('title_for_layout', __('Registrace', true));
            if($this->Auth->user())
            {
                $this->set('zobraz_menu', true);
            }
            else
            {
                $this->set('zobraz_menu', false);
            }
        }

        function zaregistruj_se()
        {
            
        }

        function priprav_se()
        {
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    //'contain' => array('User', 'Emplyee', 'Field')
            ));

            $this->set(compact('student'));
        }

        function prijed()
        {
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    //'contain' => array('User', 'Emplyee', 'Field')
            ));

            $this->set(compact('student'));
        }

        function toggle_zivotopis_tisk()
        {
            $this->autoRender = false;
            if($this->RequestHandler->isAjax())
            {
                return $this->__toggle('vytiskni_zivotopis');
            }
        }

        function toggle_vstupenka()
        {
            $this->autoRender = false;
            if($this->RequestHandler->isAjax())
            {
                return $this->__toggle('vytiskni_vstupenku');
            }
        }

        function toggle_obleceni()
        {
            $this->autoRender = false;
            if($this->RequestHandler->isAjax())
            {
                return $this->__toggle('priprav_obleceni');
            }
        }

        function toggle_cesta()
        {
            $this->autoRender = false;
            if($this->RequestHandler->isAjax())
            {
                return $this->__toggle('cesta');
            }
        }

        function __toggle($what)
        {
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    //'contain' => array('User', 'Emplyee', 'Field')
            ));

            if(empty($student['RegistrationRequestment'][$what]) || $student['RegistrationRequestment'][$what] == 0)
            {
                if(empty($student['RegistrationRequestment']['id']))
                {
                    $this->Student->RegistrationRequestment->create();
                    $this->Student->RegistrationRequestment->saveField($what, 1);
                    if(!empty($this->Student->RegistrationRequestment->id))
                    {
                        if($this->Student->saveField('registration_requestment_id', $this->Student->RegistrationRequestment->id))
                        {
                            return 1;
                        }
                        else
                        {
                            return -1;
                        }
                    }
                }
                else
                {
                    $this->Student->RegistrationRequestment->id = $student['Student']['registration_requestment_id'];
                    if($this->Student->RegistrationRequestment->saveField($what, 1))
                    {
                        return 1;
                    }
                    else
                    {
                        return -1;
                    }
                }
            }
            elseif($student['RegistrationRequestment'][$what] == 1)
            {
                $this->Student->RegistrationRequestment->id = $student['Student']['registration_requestment_id'];
                if($this->Student->RegistrationRequestment->saveField($what, 0))
                {
                    return 0;
                }
                else
                {
                    return -1;
                }
            }
        }

        function get_companies()
        {
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    //'contain' => array('User', 'Emplyee', 'Field')
            ));

            $this->set('student', $student);
            
            if($this->RequestHandler->isAjax())
            {
                $this->layout = 'ajax';
                $this->loadModel('Company');

                if($student['Student']['zaplaceno_dnu'] == 2)
                {
                    $companies = $this->Company->find('all', array(
                        'contain' => array('Meetings', 'RoomDay1', 'RoomDay2'),
                        'order' => array('Company.name ASC')
                    ));
                }
                elseif($student['Student']['chce_den1'] == 1)
                {
                    $companies = $this->Company->find('all', array(
                        'conditions' => array('ma_den_1' => 1),
                        'contain' => array('Meetings', 'RoomDay1', 'RoomDay2'),
                        'order' => array('Company.name ASC')
                    ));
                }
                elseif($student['Student']['chce_den2'] == 1)
                {
                    $companies = $this->Company->find('all', array(
                        'conditions' => array('ma_den_2' => 1),
                        'contain' => array('Meetings', 'RoomDay1', 'RoomDay2'),
                        'order' => array('Company.name ASC')
                    ));
                }
                else
                {
                    $companies = $this->Company->find('all', array(
                        'contain' => array('Meetings', 'RoomDay1', 'RoomDay2'),
                        'order' => array('Company.name ASC')
                    ));
                }

                $this->set(compact('companies'));
            }
        }

        function get_trainings()
        {
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    //'contain' => array('User', 'Emplyee', 'Field')
            ));
//            echo '<!--';
//            pr($user);
//            echo '-->';
            $this->set('student', $student);
            
            if($this->RequestHandler->isAjax())
            {
                $this->layout = 'ajax';
                $this->loadModel('Training');

                if($student['Student']['zaplaceno_dnu'] == 2)
                {
                    $trainings = $this->Training->find('all', array(
                        'conditions' => array('company_id <>' => 0),
                        'order' => array('Training.datetime ASC')
                    ));
                }
                elseif($student['Student']['chce_den1'] == 1)
                {
                    $trainings = $this->Training->find('all', array(
                        'conditions' => array('company_id <>' => 0, 'date(datetime)' => toEngDate(Configure::read('__careerdays_first_day_date')) ),
                        'order' => array('Training.datetime ASC')
                    ));
                }
                elseif($student['Student']['chce_den2'] == 1)
                {
                    $trainings = $this->Training->find('all', array(
                        'conditions' => array('company_id <>' => 0, 'date(datetime)' => toEngDate(Configure::read('__careerdays_second_day_date')) ),
                        'order' => array('Training.datetime ASC')
                    ));
                }
                else
                {
                    $trainings = $this->Training->find('all', array(
                        'conditions' => array('company_id <>' => 0),
                        'order' => array('Training.datetime ASC')
                    ));
                }

                $this->set(compact('trainings'));
            }
        }

        function pay($how = null)
        {
            if(!$how)
            {//nevybrána metoda platby, tak je zobrazíme
                $this->set('how', false);
            }
            else
            {
                switch($how)
                {
                    case 'over':
                            $this->loadModel('Smss');
                            $key = $this->data['Students']['regcod'];
                            $code = $this->Smss->find('all',array(
                                'conditions' => array('generated_key' => $key)
                            ));
                            //pr($code);
                            //exit;
                            if(count($code) != 0 && $code['Smss']['byl_pouzit'] == 0)
                            {
                                $this->Session->write('RegCode', $key);
                                $this->redirect('/registrace');
                            }
                            else
                            {
                                $this->Session->setFlash(__('Neplatný nebo použitý registrační kód.', true));
                                $this->redirect($this->referer());
                            }
                        break;

                    case 'mobil':
                        break;
                    case '': //když nezadá parametry platby, tak vypíše všechny
                        break;
                    default: //když zadá neznámou platbu, tak ho to varuje, že ne e
                            $this->Session->setFlash('Tato volba není povolena.');
                            $this->redirect('/platba');
                        break;
                }
            }

            $this->set('how', $how);
            $this->set('title_for_layout', __('Platba', true));
            $this->set('zobraz_menu', false);
        }

        function register()
        {
            if(!empty($this->data))
            {
                $error = false;
                $errorMessage = array();
                if(isset($this->data['Smss']['generated_key']))
                {
                    $this->data['Student']['typ_platby'] = 'sms';
                    $this->loadModel('Smss');
                    $sms = $this->Smss->find('first', array(
                        'conditions' => array('generated_key' => $this->data['Smss']['generated_key'])
                    ));

                    if($sms['Smss']['byl_pouzit'] == 1)
                    {
                        $error = true;
                        $errorMessage[] = 'Tento registrační kód už byl použit!';
                    }

                    $this->data['Student']['id_platby'] = $sms['Smss']['id'];
                    $tarif = substr($sms['Smss']['tarif'], -2);
                    switch($tarif)
                    {
                        case '79':
                                $this->data['Student']['zaplaceno_dnu'] = 1;
                            break;
                        case '99':
                                $this->data['Student']['zaplaceno_dnu'] = 2;
                                $this->data['Student']['chce_den1'] = 1;
                                $this->data['Student']['chce_den2'] = 1;
                            break;
                    }
                    
                }
                //pr($sms);
                $school = $this->Student->School->find('first',array(
                    'conditions' => array('AND' => array(
                        'nazev' => $this->data['Student']['skola'],
                        'nazev_studijniho_oboru' => $this->data['Student']['obor']
                        )
                    )
                ));
                //$this->data['Student']['school_id'] = $school['School']['id'];
                $this->data['School'] = $school['School'];

                if(empty($this->data['School']))
                {
                    $errorMessage[] = 'Zadej prosím školu a obor.';
                    $error = true;
                }

                if((empty($this->data['User']['email'])) && ($this->data['User']['email'] != $this->data['User']['emailCheck']))
                {
                    $error = true;
                    $errorMessage[] = 'Zadej prosím stejné emailové adresy.';
                }
                if((empty($this->data['User']['password'])) && ($this->data['User']['password'] != $this->Auth->password($this->data['User']['passwordCheck'])))
                {
                    $error = true;
                    $errorMessage[] = 'Zadej prosím stejná hesla.';
                }

                
//                pr($this->data);
//                exit;

                if(empty($this->data['User']['jmeno']) || empty($this->data['User']['prijmeni']))
                {
                    $errorMessage[] = 'Zadej prosím jméno a příjmení.';
                    $error = true;
                }

                $typ = $this->data['Student']['typ'];
                if($typ == 'B' || $typ == 'N')
                {
                    if(empty($this->data['Student']['rocnik']))
                    {
                        $errorMessage[] = 'Zadej prosím ročník.';
                        $error = true;
                    }
                }

                if($error)
                {
                    $this->set('errorMessage', $errorMessage);
                    $this->redirect('/zaregistruj_se');
                }
                else
                {
                    if($this->Student->saveAll($this->data))
                    {
                        $this->Session->setFlash(__('Byl jsi zaregistrován, nyní se můžeš přihlásit.', true), 'flash_success');
                        if($this->data['Smss']['generated_key'])
                        {
                            $this->Smss->set($sms);
                            $this->Smss->saveField('byl_pouzit', 1);
                        }

                        $this->redirect('/');
                    }
                    else
                    {
                        $this->Session->setFlash(__('Registrace se bohužel nepodařila. Zkus to znovu! (Administřátoři byli informování)'), 'flash_warning');
                    }
                }

                //pr($errorMessage);
                //pr($this->data);
                //exit;
            }


            $key = $this->Session->read('RegCode');
            if(!isset($key) || $key == '')
            {
                $this->Session->setFlash(__('Ověř prosím znovu registrační kód.', true), 'flash_error');
                $this->redirect('/zaregistruj_se');
                exit;
            }
            $this->set('RegCod', $key);
            $this->Session->delete('RegCode');
            $this->set('title_for_layout', __('Registrace', true));
            $this->set('zobraz_menu', false);
        }

        function check_username()
        {
            $this->autoRender = false;
            if($this->RequestHandler->isAjax())
            {
                $name = $this->params['url']['name'];
                $user = $this->Student->User->find('all', array(
                        'conditions' => array('username' => $name)
                        ));
                if(count($user) > 0)
                {
                    return 0;
                }
                else
                {
                    return 1;
                }
            }
        }

        function check_email()
        {
            $this->autoRender = false;
            if($this->RequestHandler->isAjax())
            {
                $email = $this->params['url']['email'];
                $user = $this->Student->User->find('all', array(
                        'conditions' => array('email' => $email)
                        ));
                if(count($user) > 0)
                {
                    return 0;
                }
                else
                {
                    return 1;
                }
            }
        }

        function autoschool()
        {
            $this->layout = 'ajax';
            if($this->RequestHandler->isAjax())
            {
                $q = $this->params['url']['q'];
                $this->Student->School->recursive = 0;
                $schools = $this->Student->School->find('all', array(
                    'conditions' => array('OR' =>
                                            array('nazev LIKE' => '%'.$q.'%', 'alias LIKE' => '%'.$q.'%')
                                            //array('nazev LIKE' => '%'.$q.'%'),
                                            //array('alias LIKE' => '%'.$q.'%')
                        ),
                    'fields' => array('nazev'),
                    'group' => array('nazev')
                ));
                //pr($schools);
                $this->set('schools', $schools);
            }
        }

        function autoobor()
        {
            $this->layout = 'ajax';
            if($this->RequestHandler->isAjax())
            {
                $q = $this->params['url']['q'];
                $skola = $this->params['url']['school'];
                $this->Student->School->recursive = 0;
                $obory = $this->Student->School->find('all',array(
                    'conditions' => array('nazev' => $skola, 'nazev_studijniho_oboru LIKE' => '%'.$q.'%'),
                    'fields' => array('nazev_studijniho_oboru'),
                    'group' => array('nazev_studijniho_oboru')
                ));

                $this->set('obory', $obory);
            }
        }

        function profil()
        {
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    //'contain' => array('User', 'Emplyee', 'Field')
            ));
            $this->set('student', $student);
            $this->set('title_for_layout', __('Profil', true));
            $this->set('zobraz_menu', true);

            $this->set('agenda', $this->__getAgenda($student));
        }

        function agenda()
        {
            if($this->RequestHandler->isAjax())
            {
                $this->layout = 'ajax';
            }
            $user = $this->Auth->user();
            $student = $this->Student->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    //'contain' => array('User', 'Emplyee', 'Field')
            ));
            $this->set('agenda', $this->__getAgenda($student));
        }

        function __getAgenda($student)
        {
            
            $agenda = array('den1' => array(), 'den2' => array());
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

        function __getRoomNameFromId($id = null)
        {
            $this->loadModel('Room');
            $room = $this->Room->find('first', array(
                'conditions' => array('Room.id' => $id)
            ));

            return $room['Room']['name'];
        }

        function __getCompanyNameFromId($id = null)
        {
            $this->loadModel('Company');
            $company = $this->Company->find('first', array(
                'conditions' => array('Company.id' => $id)
            ));

            return $company['Company']['name'];
        }


        function upload_cv()
        {
            $this->layout = 'ajax';
            //pr($this->data);

            $user = $this->Auth->user();
            //pr($user);
            $uploaddir = WWW_ROOT.'files'.DS.'cv'.DS;
            $allowed = array(
                'application/msword', //doc
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', //docx
                'application/pdf',
                'application/vnd.oasis.opendocument.text' //odt
                );
            
            $name = $this->data['Student']['cv']['name'];
            $tmp_name = $this->data['Student']['cv']['tmp_name'];
            $type = $this->data['Student']['cv']['type'];
            
            $name = $this->__safe_filename($name);

            if(!in_array($type, $allowed))
            {
                $msg = array('status' => 'error', 'message' => 'Nepovolený typ soboru.');
                $this->set('message', $msg);
                return;
            }
            else
            {
                if(!$this->__check_dir($uploaddir.$user['User']['id']))
                {
                    $msg = array('status' => 'error', 'message' => 'Nepodařilo se vytvořit uživatelskou složku.');
                    $this->set('message', $msg);
                    return;
                }
                else
                {
                    if(!move_uploaded_file($tmp_name, $uploaddir.$user['User']['id'].DS.$name))
                    {
                        $msg = array('status' => 'error', 'message' => 'Nepodařilo se nahrát soubor.');
                        $this->set('message', $msg);
                        return;
                    }
                    else
                    {
                        $student = $this->Student->find('first', array(
                            'conditions' => array('user_id' => $user['User']['id'])
                        ));
                        $oldfile = $student['Student']['zivotopis'];
                        //pr($oldfile);
                        $this->Student->id = $student['Student']['id'];
                        if($this->Student->saveField('zivotopis', $name))
                        {
                            $msg = array('status' => 'success', 'message' => 'Životopis je uložen.');
                            $this->set('message', $msg);
                            if(!empty($oldfile))
                            {
                                @unlink($uploaddir.$user['User']['id'].DS.$oldfile);
                            }
                            return;
                        }
                        else
                        {
                            $msg = array('status' => 'error', 'message' => 'Nepodařilo se nahrát soubor.');
                            $this->set('message', $msg);
                            return;
                        }
                    }
                }
            }  
        }

        function __check_dir($dir)
        {
            if(is_dir($dir))
            {
                return true;
            }
            elseif(mkdir($dir))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        function get_cv()
        {
            $user = $this->Auth->user();
            $student = $this->Student->find('first', array(
                    'conditions' => array('user_id' => $user['User']['id'])
                ));
            $this->set('cv', $student['Student']['zivotopis']);
        }

        function delete_cv()
        {
            
        }

        function __safe_filename($filename)
        {
            $filename = str_replace("#", "No.", $filename);
            $filename = str_replace("$", "Dollar", $filename);
            $filename = str_replace("%", "Percent", $filename);
            $filename = str_replace("^", "", $filename);
            $filename = str_replace("&", "and", $filename);
            $filename = str_replace("*", "", $filename);
            $filename = str_replace("?", "", $filename);

            return $filename;
        }

        function password()
        {
            if($this->RequestHandler->isAjax())
            {
                if(!empty($this->data))
                {
                    $error = false;
                    $errorMessage = array();
                    $user = $this->Auth->user();
                    $u = $this->Student->User->findById($user['User']['id']);
                    //pr($u);
                    if($this->Auth->password($this->data['Student']['oldPassword']) != $u['User']['password'])
                    {
                        $error = true;
                        $errorMessage[] = 'Zadal(a) jsi nesprávné staré heslo!';
                    }
                    if($this->data['Student']['newPassword'] != $this->data['Student']['newPasswordCheck'])
                    {
                        $error = true;
                        $errorMessage[] = 'Zadej dvě stejná nová hesla.';
                    }

                    if($error)
                    {
                        $message = '';
                        foreach($errorMessage as $msg)
                        {
                            $message .= $msg."\n";
                        }
                        $msg = array('status' => 'error', 'message' => $message);
                        $this->set('message', $msg);
                    }
                    else
                    {
                        $this->Student->User->id = $user['User']['id'];
                        if($this->Student->User->saveField('password', $this->Auth->password($this->data['Student']['newPassword'])))
                        {
                            $msg = array('status' => 'success', 'message' => 'Heslo je změněno.');
                            $this->set('message', $msg);
                            //$this->Session->setFlash('Heslo je změněno.');
                            //$this->redirect(array('controller' => 'students', 'action' => 'profil'));
                        }
                        else
                        {
                            $msg = array('status' => 'error', 'message' => 'Heslo se bohužel nepodařilo změnit.');
                            $this->set('message', $msg);
                            //$this->Session->setFlash('Heslo se bohužel nepodařilo změnit.');
                            //$this->redirect(array('controller' => 'students', 'action' => 'profil'));
                        }
                    }
                }
                $this->layout = 'ajax';
            }
            else
            {
                //TODO: dodělat možnost měnit heslo bez Ajaxu
            }
        }
}
?>