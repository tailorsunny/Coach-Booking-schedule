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


    if(isset($_GET['id'])){

        $results = $admin->query("SELECT * FROM ".PREFIX."booking_status WHERE  coach_id = '".$_GET['id']."' ");

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
        
        <div class="container pt-5" id="loginForm">



            <table id="example" class="table table-hover table-striped table-bordered display nowrap mt-2" style="width:100%">
                <thead>
                    <tr>
                         <th>Sr No</th>

                        <th>Coach Name</th>
                        <th>Timezone</th>
                        <th>Name</th>
                        <th>Day of Week</th>
                        <th>Booking at</th>
                        <th>Booking until</th>


                    </tr>
                </thead>
                <tbody>

                    <?php

                        $x = 1;

                        if(isset($_GET['id'])){


                        if($admin->num_rows($results) > 0){
                            
                            while($row = $admin->fetch($results)){ 

                    ?>

                    <tr>
                    <td><?php echo $x;?></td>

                        <td><?php echo $admin->getUniqueCoachDetailsById($row['coach_id'])['coach_name'];?></td>
                        <td><?php echo $admin->getUniqueCoachDetailsById($row['coach_id'])['timezone'];?></td>
                        <td><?php echo $row['full_name']; ?></td>

                        <td><?php echo $admin->getUniqueCoachDetailsById($row['coach_id'])['day_of_week'];?></td>
                        <td><?php echo date("d-m-Y h:i a", $row['bookin_time_stamp']/1000); ?></td>
                        <td><?php echo date("d-m-Y h:i a", $row['booking_to_time_stamp']/1000);?></td>

                       

                    </tr>
                   

                    <?php $x++;} } } ?>

                </tbody>

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

</script>



