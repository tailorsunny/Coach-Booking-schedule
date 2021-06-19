<?php

    include_once 'include/config.php';

    include_once 'include/admin-functions.php';

    $admin       = new AdminFunctions();

    $csrf        = new csrf();
    $token_id    = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

    $strquery    = '';

    $pageURL = 'booking.php';



    $addFollowURL = 'view-booking.php';


    $tableName = 'report';


    if(isset($_GET['coach_name'])){

        $results = $admin->query("SELECT * FROM ".PREFIX."report WHERE  coach_name = '".$_GET['coach_name']."' ");

    }

    if(isset($_GET['booikingId']) && !empty($_GET['booikingId'])){

        $id = $admin->escape_string($admin->strip_all($_GET['booikingId']));

        $data = $admin->getUniqueCoachDetailsById($id);

        
    }

    
    if(isset($_POST['register'])) {
        $result = $admin->insertBookingStatus($_POST);
        header("location:report.php?insertsuccess");
        exit;
    }


// print_r($_POST);

?>

<html lang="en">

    <head>

        <meta charset="UTF-8">

        <link rel="icon" type="image/png" href="w3hubs.jpg" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Report Page</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


        <style>

            

        </style>

    </head>

    <body>
        
        <div class="container" id="loginForm">
            <h3 class="text-center py-3">Booking Form</h3>

            <form action="" id="form" method="post" enctype="multipart/form-data" autocomplete="off">

                <div class="form-group row">

                    <div class = "col-sm-3">

                        <label>Full Name<em>*</em> </label>
                                                
                        <input type="text" name="full_name" class="form-control">

                    </div>

                    <div class = "col-sm-3">

                        <label>Available at Date<em>*</em> </label>
                                                
                        <input type="date" name="booking_from_date" id="booking_from_date" class="form-control" onchange="showbutton();">

                    </div>

                    <div class = "col-sm-3">

                        <label>Available at Time<em>*</em> </label>
                                                
                        <input type="time" name="booking_from_time" id="booking_from_time" class="form-control" onchange="showbutton();">
                    
                    </div>

                    <div class = "col-sm-3">

                        <label>Available Until Date<em>*</em> </label>
                                                
                        <input type="date" name="booking_to_date" id="booking_to_date" class="form-control" onchange="showbutton();" readonly>
                    
                    </div>

                    <div class = "col-sm-3">

                        <label>Available Until Time<em>*</em> </label>
                                                
                        <input type="time" name="booking_to_time" id="booking_to_time" class="form-control" onchange="showbutton();">
                    
                    </div>

                </div>


                    <div class="form-group row">
                        
                        <input type="hidden" name="id" id="coachId" value="<?php echo $id; ?>" />

                        <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>" />

                        <span id="showMsg"> The <?php echo $data['coach_name'];?> Available <?php echo $data['day_of_week'];?> only At Time <?php echo date("h:i a", strtotime($data['available_at_from_time']));?> Between <?php echo date("h:i a", strtotime($data['available_at_to_time']));?>  </span>

                        <button style="display:none;" type="submit" name="register" id="register" class="btn btn-danger btn-sm btn-block"><i class="icon-signup"></i>Submit</button>

                    </div>

            

            </form>


            <br>

            

        
        </div>

    </body>
    
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>

    function showbutton() {

        let booking_from_date = $('#booking_from_date').val();

        let fromids = $('#booking_from_date').attr('id');

        let booking_to_date   = $('#booking_to_date').val();

        let toids = $('#booking_to_date').attr('id');

        if (booking_from_date != '') {

            checkingDay(booking_from_date,fromids);
            
        }

        if (booking_to_date != '') {

            checkingDay(booking_to_date,toids);
            
        }

        let booking_from_time = $('#booking_from_time').val();

        let fromTimeids       = $('#booking_from_time').attr('id');


        if (booking_from_time != '') {

            checkingtime(booking_from_time,fromTimeids);

        }


        let booking_to_time   = $('#booking_to_time').val();

        let toTimeids         = $('#booking_to_time').attr('id');

         if (booking_to_time != '') {

            checkingtime(booking_to_time,toTimeids);

        }

        if (booking_from_date != '' && booking_to_date != '' && booking_from_time != '' && booking_to_time != '') {

            $.ajax({
						
                type: 'POST',
                
                data: 'coachId=' + $('#coachId').val() + '&booking_from_date='+booking_from_date+'&booking_to_date='+booking_to_date+'&booking_from_time='+booking_from_time+'&booking_to_time='+booking_to_time,
                
                url: 'getAjaxcheckAvailabilityOfCoach.php',
                
                success: function (res) {

                    console.log(res);
                
                    if (res == '0') {

                        $('#register').show();

                    } else {

                        $('#register').hide();


                        alert('Sorry Coach Already Book On This Date');

                    }

                }

            });
            
        } else {

            $('#register').hide();

        }
        
    }


    function checkingDay(date,id) {

        var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

        var a = new Date(date);

        let DayName = weekday[a.getDay()];

        if ( DayName != '<?php echo $data['day_of_week'];?>'){

            $('#'+id).val('');

            alert('Please Select '+'<?php echo $data['day_of_week'];?>'+' Only');

            $('#register').hide();

        } else {
           
            $('#booking_to_date').val(date);

        }
        
    }

    function checkingtime(time,id) {

        var d = '<?php echo date('F d, Y ', CURRENTMILIS/1000)?>';

        var orignal = new Date(d + time);

        sttime = orignal.getTime();

        var df = '<?php echo date('F d, Y ', CURRENTMILIS/1000)?>';

        var sttf = new Date(df + '<?php echo $data['available_at_from_time'];?>');

        starttime = sttf.getTime();

        var de = '<?php echo date('F d, Y ', CURRENTMILIS/1000)?>';

        var stte = new Date(de + '<?php echo $data['available_at_to_time'];?>');

        endtime = stte.getTime();

        if((sttime >= starttime) && (sttime <= endtime) ) {


        } else {

            $('#'+id).val('');

            alert('Please Select Your Time Between '+'<?php echo date("h:i a", strtotime($data['available_at_from_time']));?>'+ ' To ' +'<?php echo date("h:i a", strtotime($data['available_at_to_time']));?>');

            $('#register').hide();

        }

    }


</script>



