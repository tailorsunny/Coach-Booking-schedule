<?php 
    
    include_once 'include/config.php';
    
    include_once 'include/admin-functions.php';
    
    $admin     = new AdminFunctions();

    if (isset($_POST['coachId']) && !empty($_POST['coachId']) && isset($_POST['booking_from_date']) && !empty($_POST['booking_from_date']) && isset($_POST['booking_to_date']) && !empty($_POST['booking_to_date']) && isset($_POST['booking_from_time']) && !empty($_POST['booking_from_time']) && isset($_POST['booking_to_time']) && !empty($_POST['booking_to_time'])) {
    
        $coachId            = $_POST['coachId'];

        $booking_from_date  = $_POST['booking_from_date'];
        
        $booking_to_date    = $_POST['booking_to_date'];
        
        $booking_from_time  = $_POST['booking_from_time'];
        
        $booking_to_time    = $_POST['booking_to_time']; 

        $startDateTime      = $admin->convert_datetime(date('Y-m-d', strtotime($booking_from_date)).' '.date("H:i:s", strtotime($booking_from_time)));

        $endDateTime        = $admin->convert_datetime(date('Y-m-d', strtotime($booking_to_date)).' '.date("H:i:s", strtotime($booking_to_time)));


        $avilable           = $admin->getavailabilityOfCoach($coachId,$startDateTime,$endDateTime);

    }

        echo $avilable;

?>