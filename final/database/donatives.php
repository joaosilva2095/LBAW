<?php

function has_to_pay($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT last_donative, periodicity, frozen FROM friends WHERE id = ?");
    $stmt->execute(array($id));

    $result = $stmt->fetchAll();

    $last_donative = $result[0]["last_donative"];
    $periodicity = $result[0]["periodicity"];
    $frozen = $result[0]["frozen"];


    if(!$frozen){
        $currentDate = new DateTime();
        $last_donative = new DateTime($last_donative);
        $diff = $last_donative->diff($currentDate);
        $diff=$diff->format("%R%a");

        if($periodicity === 'Mensal' && $diff >= 30 ){
            return true;
        }
        else if($periodicity === 'Trimestral' && $diff >= 90){
            return true;
        }
        else if($periodicity === 'Semestral' && $diff >= 180){
            return true;
        }
        else if($periodicity === 'Anual' && $diff >= 365){
            return true;
        }
    }

    return false;

}


function how_many_month_to_pay($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT last_donative, periodicity, frozen FROM friends WHERE id = ?");
    $stmt->execute(array($id));

    $result = $stmt->fetchAll();

    $last_donative = $result[0]["last_donative"];
    $periodicity = $result[0]["periodicity"];
    $frozen = $result[0]["frozen"];


    if(!$frozen){
        $currentDate = new DateTime();
        $last_donative = new DateTime($last_donative);
        $diff = $last_donative->diff($currentDate);
        $diff=$diff->format("%R%a");

        if($periodicity === 'Mensal' && $diff >= 30 ){
            return floor($diff/30);
        }
        else if($periodicity === 'Trimestral' && $diff >= 90){
            return floor($diff/90);
        }
        else if($periodicity === 'Semestral' && $diff >= 180){
            return floor($diff/180);
        }
        else if($periodicity === 'Anual' && $diff >= 365){
            return floor($diff/365);
        }
    }

    return 0;
}

function latePayments(){

    global $conn;
    $stmt = $conn->prepare("SELECT users.name,friends.last_donative, friends.periodicity, friends.id FROM friends, users 
                            WHERE users.id=friends.id");
    $stmt->execute();
    $users = $stmt->fetchAll();

    foreach($users as $key=> $user){
        $num = how_many_month_to_pay($user["id"]);
        if($num>0)
        $users[$key]["numberofPayments"] = $num ;
       else
            unset($users[$key]);
    }

    return $users;
}
