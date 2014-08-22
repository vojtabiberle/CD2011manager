<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php
 *
 * This is an application wide file to load any function that is not used within a class
 * define. You can also use this to include or require any files in your application.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * App::build(array(
 *     'plugins' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'models' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'views' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'controllers' => array(/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'datasources' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'behaviors' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'components' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'helpers' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'vendors' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'shells' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * As of 1.3, additional rules for the inflector are added below
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */


include_once('http_hosts.php');

Configure::write('App.maintenance', false);
//App::import('vendor', 'FirePHPCore'.DS.'fb');


date_default_timezone_set('Europe/Prague');
putenv('TZ=Europe/Prague');

function timeBetween($startTime, $stopTime)
{
    //return true;
    if(timeIsInFuture($stopTime) && timeIsInPast($startTime))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function timeIsInFuture($time)
    {
        $now = time();
        preg_match('/([0-9]+)\.([0-9]+)\.([0-9]+) ([0-9]+):([0-9]+)/', $time, $res);
        /*
         * [0] - celý matchfunction timeIsInFuture($time)
    {
        $now = time();
        preg_match('/([0-9]+)\.([0-9]+)\.([0-9]+) ([0-9]+):([0-9]+)/', $time, $res);
        /*
         * [0] - celý match
         * [1] - dny
         * [2] - měsíce
         * [3] - roky
         * [4] - hodiny
         * [5] - minuty
         */
        //pr($res);
        $time = mktime(addZero($res[4]), addZero($res[5]), '00', addZero($res[2]), addZero($res[1]), $res[3]);
        //echo "now: $now, time: $time";
        if($now <= $time)
            return true;
        else
        {
            return false;
        }
        return false;
    }

    function timeIsInPast($time)
    {
        $now = time();
        preg_match('/([0-9]+)\.([0-9]+)\.([0-9]+) ([0-9]+):([0-9]+)/', $time, $res);
        /*
         * [0] - celý matchfunction timeIsInFuture($time)
    {
        $now = time();
        preg_match('/([0-9]+)\.([0-9]+)\.([0-9]+) ([0-9]+):([0-9]+)/', $time, $res);
        /*
         * [0] - celý match
         * [1] - dny
         * [2] - měsíce
         * [3] - roky
         * [4] - hodiny
         * [5] - minuty
         */
        //pr($res);
        $time = mktime(addZero($res[4]), addZero($res[5]), '00', addZero($res[2]), addZero($res[1]), $res[3]);
        //echo "now: $now, time: $time";
        if($now >= $time)
            return true;
        else
        {
            return false;
        }
        return false;
    }

    function addZero($num)
    {
        if(count($num) == 1)
        {
            return '0'.$num;
        }
        return $num;
    }

    function rmZero($num)
    {
        if(count($num) == 2)
        {
            preg_match('/([0-9])([0-9])/', $num, $res);
            if($res[1] == 0)
            {
                return $res[2];
            }
        }
        return $num;
    }

    function rmSecond($time)
    {
        preg_match('/([0-9]{2}):([0-9]{2}):([0-9]{2})/', $time, $res);
        return $res[1].':'.$res[2];
    }

    function toCzechDate($date)
    {
        preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $date, $res);
        return rmZero($res[3]).'.'.rmZero($res[2]).'.'.$res[1];
    }

    function toCzechDateTime($datetime)
    {
        list($date, $time) = explode(' ', $datetime);
        return toCzechDate($date).' '.rmSecond($time);
    }

    function toEngDate($date)
    {
        preg_match('/([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})/', $date, $res);
        return $res[3].'-'.addZero($res[2]).'-'.addZero($res[1]);
    }

    function toEngDateTime($datetime)
    {
        list($date, $time) = explode(' ', $datetime);
        return toEngDate($date).' '.rmSecond($time);
    }

    /*** TIME ***/
    function corectTime($time)
    {
        $t = array(0,0);
        list($t[0], $t[1]) = explode(':', $time);
        $hod = $t[1] / 60;
        if($hod >= 1)
        {
            $t[0] += $hod;
            $t[1] = $t[1] % 60;
        }
        if(strlen($t[1]) == 1)
            $t[1] = '0'.$t[1];
        $dny = $t[0] / 24;
        if($dny >= 1)
        {
            $t[0] = $t[0] % 24;
            //dny nás nezajímaj
        }
        if(strlen($t[0]) == 1)
            $t[0] = '0'.$t[0];
        return $t[0].':'.$t[1];
    }

    /**
     * Vrací 1 pokud první čas je větší, 0 pokud se rovnají a -1 pokud je druhý čas větší.
     * @param time $t1
     * @param time $t2
     * @return [-1,0,1]
     */
    function compareTime($t1, $t2)
    {
        list($t1hod, $t1min) = explode(':', $t1);
        list($t2hod, $t2min) = explode(':', $t2);
        if($t1hod > $t2hod)
        {
            return 1;
        }
        elseif($t1hod < $t2hod)
        {
            return -1;
        }
        else
        {
            if($t1min > $t2min)
            {
                return 1;
            }
            elseif($t1min < $t2min)
            {
                return -1;
            }
            else
            {
                return 0;
            }
        }
    }

    /**
     * Čas k porovnání. Vrací true, pokud se čas nachází mezi časy b1 a b2.
     * @param <type> $time
     * @param <type> $b1
     * @param <type> $b2
     */
    function timeBetweenTimes($time, $b1, $b2)
    {
        if(compareTime($time, $b1) > 0 && compareTime($time, $b2) < 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function addTime($t1, $t2)
    {
        $t = array(0,0);
        list($t1hod, $t1min) = explode(':', $t1);
        list($t2hod, $t2min) = explode(':', $t2);
        $t[1] = $t1min + $t2min;
        if($t[1] >= 60)
        {
            $t[0] += 1;
            $t[1] -= 60;
        }
        $t[0] += $t1hod + $t2hod;
        if($t[0] >= 24)
        {
            $t[0] -= 24;
        }
        if(strlen($t[1]) == 1)
        {
            $t[1] = '0'.$t[1];
        }
        return $t[0].':'.$t[1];
    }

    function subTime($t1, $t2)
    {
        $t = array(0,0);
        list($t1hod, $t1min) = explode(':', $t1);
        list($t2hod, $t2min) = explode(':', $t2);
        $t[1] = $t1min - $t2min;
        if($t[1] < 0)
        {
            $t[0] -= 1;
            $t[1] += 60;
        }
        $t[0] = $t[0] + ($t1hod - $t2hod);
        if($t[0] < 0)
        {
            $t[0] += 24;
        }
        return $t[0].':'.$t[1];
    }