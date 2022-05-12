<?php
    include_once('connection.php');
    include_once('function.php');

    $report=array();
    $report['clear']=true;
    $report['valid']=true;
    if(isset($_SESSION['phoenix_user']) && !empty($_SESSION['phoenix_user']) )
    {
        // if(isset($_POST['action']) && $_POST['action']=='report-product')
        // {

        // }
    }
    else{
        $report['clear']=false;
        $report['error']='login';
        $report['valid']=false;
    }

    echo json_encode($report);
?>