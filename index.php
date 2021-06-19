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

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">


      
        <link rel="stylesheet" href="css/fancy.css">

        




        <style>

            

        </style>

    </head>

    <body>
        
        <div class="container" id="loginForm">
            <h3 class="text-center pt-3 pb-4">Coach Schedule Form & Details</h3>

            <form action="" id="form" method="get" enctype="multipart/form-data" autocomplete="off">

                <div class="form-group row">



                    <div class = "col-sm-3">

                        <label class="pt-3">Category Name<em>*</em> </label>
                                                
                        <select class="form-control form-control-md select2 " name="coach_name" style="width:100%;">
                            
                            <option value="" >Select Category</option>

                            <?php

                                $allCoachName = $admin->getAllCoachName();
                                    
                                while($row = $admin->fetch($allCoachName)){	
                                
                            ?>
                            
                                <option value="<?php echo $row['coach_name']; ?>"> <?php echo $row['coach_name']; ?></option>

                            <?php }  ?>
                            
                        </select>

                    </div>

                    <!-- <div class = "col-sm-3">
                    
                    </div>

                    <div class = "col-sm-3">
                    
                    </div>

                    <div class = "col-sm-3">
                    
                    </div> -->

                    </div>


                    <div class="form-group row">
                        
                        <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>" />

            
                        <button type="submit" name="register" id="register" class="btn btn-danger btn-sm btn-block"><i class="icon-signup"></i>Search</button>

                    </div>

            

            </form>


            <br>

            <table id="example" class="table table-hover table-striped table-bordered  display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Coach Name</th>
                        <th>Timezone</th>
                        <th>Day of Week</th>
                        <th>Available at</th>
                        <th>Available until</th>
                        <th>Booking Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php

                        $x = 1;

                        if(isset($_GET['coach_name'])){


                        if($admin->num_rows($results) > 0){
                            
                            while($row = $admin->fetch($results)){ 

                    ?>

                    <tr>
                        <td><?php echo $row['coach_name'];?></td>
                        <td><?php echo $row['timezone'];?></td>
                        <td><?php echo $row['day_of_week'];?></td>
                        <td><?php echo date("h:i a", strtotime($row['available_at_from_time'])); ?></td>
                        <td><?php echo date("h:i a", strtotime($row['available_at_to_time']));?></td>

                        
                        <td>
                            <?php 
                                if ($row['booking_status'] == 1) {
                                  
                                ?>
                                
                                <a data-fancybox="newentry" class="btn btn-primary btn-sm" data-type="iframe" href="javascript:void(0)" data-src="<?php echo $addFollowURL; ?>?add&id=<?php echo $row['id']; ?>" title="Edit">View Booking</a>

                                <?php

                                } else {

                                    echo 'Availabe To Book';
                                }
                            ?>
                        </td>
                        
                        <td class="text-center">
                            
                        <?php 

                            $fullDay = date('l', CURRENTMILIS/1000);

                            $todaysDate =  date('Y-m-d', CURRENTMILIS/1000);

                            $startDateTime  = $admin->convert_datetime(date('Y-m-d', strtotime($todaysDate)).' '.date("H:i:s", strtotime($row['available_at_from_time'])));


                            $endDateTime  = strtotime(date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s', $startDateTime/1000)."+30 minutes")))*1000;

                            if ($fullDay == $row['day_of_week']) {

                                if ((CURRENTMILIS >= $startDateTime) && (CURRENTMILIS <= $endDateTime)) {

                            ?>

                                <a class="btn btn-primary" href="<?php echo $pageURL; ?>?booikingId=<?php echo $row['id']; ?>&coach_name=<?php echo $row['coach_name']; ?>" onclick="return confirm('Are you sure you want to Book?');" title="Book"> Book </a>

                            <?php } } ?>


                            
                        </td>

                    </tr>
                   

                    <?php } } } ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th>Coach Name</th>
                        <th>Timezone</th>
                        <th>Day of Week</th>
                        <th>Available at</th>
                        <th>Available until</th>
                        <th>Booking Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>

        
        </div>

    </body>
    
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<script src="js/fancy.js"></script>

<script>

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

$("[data-fancybox='newentry']").fancybox({
	fitToView: false,
	smallBtn: true,
	toolbar: false,
	afterClose: function () {
		parent.location.reload(true);
	},
	iframe: {
		css: {
			width: '100%',
			height: '100%'
		}
	}
});

</script>



