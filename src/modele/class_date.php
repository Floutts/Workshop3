<?php


class Date
{

    var $days = array('Lundi', 'Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');
    var $months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

    private $getEvent;

    public function __construct($db)
    {
        $this->db = $db;
        $this->getEvent = $db->prepare('SELECT id,NomAssociation,DateDebut,idSalle,DateFin,DebutLocation,Finlocation FROM reservation WHERE YEAR(DateDebut)=:year');
    }


   function getEvents($year){
        global $DB;
        $req = $DB->query('SELECT id,NomAssociation FROM reservation WHERE YEAR(DateDebut)='.$year);
        $r = array();
        while ($d = $req->fetch(PDO::FETCH_OBJ)){
            print_r($d);
        }
        return $r;

   }
        public function getEvent($year){
            $r = array();
            $events = $this->getEvent->execute(array(':year'=>$year));
            if ($this->getEvent->errorCode()!=0){
                print_r($this->getEvent->errorInfo());
            }
            return $this->getEvent->fetchAll();
            while ($d = $this->getEvent->fetchAll(PDO::FETCH_OBJ)){
                $r[strtotime($d->date)][$d->id] = $d->NomAssociation;
            }
            return $r;
        }




    function getAll($year)
    {
        $r = array();
/**
         $date = strtotime($year.'-01-01');
         while(date('Y',$date) <= $year){
         $y = date('Y', $date);
         $m = date('n', $date);
         $d = date('j', $date);
         $w = str_replace('0', '7', date('w', $date));
         $r[$y][$m][$d] = $w;
         $date = $date + 24 * 3600;
         }
*/
        $date = new DateTime($year.'-01-01');
        while ($date->format('Y') <= $year) {
            $y = $date->format('Y');
            $m = $date->format('n');
            $d = $date->format('d');
            $n = $date->format('m');
            $w = str_replace('0', '7', $date->format('w'));
            $r[$y][$m][$d] = $w;
            $date->add(new DateInterval('P1D'));
        }

        return $r;

    }
}