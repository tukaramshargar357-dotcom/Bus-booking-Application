<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_booking_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully via MySQLi";

?>

<?php

    $sql_select_all = "SELECT * FROM `places`";
    $result_data = $conn->query($sql_select_all);
    //print_r($result_data);
    
    if (isset($_GET['from_id']) && isset($_GET['to_id'])) {

        $f_id = (int)$_GET['from_id'];
        $t_id = (int)$_GET['to_id'];

        $sql = "SELECT rb.id,br.route_name, bn.bus_name,bt.bus_type_name, rb.bus_number,rb.price, rb.total_seats
            FROM `route_bus` AS rb 
            INNER JOIN bus_name AS bn ON rb.bus_name_id = bn.id
            INNER JOIN bus_type AS bt ON rb.bus_type_id = bt.id
            INNER JOIN bus_route AS br ON rb.route_id = br.id
            WHERE br.from_place_id = ".$f_id." and br.to_place_id = ".$t_id.";";
            $search_data = $conn->query($sql);
            // print_r($search_data);
    }
        
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container" style="background-color:#fc708c;">
        <div class="row py-1">
            <div class="col-sm-12">
                <h2 style="text-align:center;">SEARCH PAGE</h2>

                <form action="" method="get">
                    <div class="row py-1">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-3  m-2">
                            <h3>FROM</h3>
                            <select class="form-select" aria-label="Default select example" name="from_id">
                                <option selected>--Select--</option>

                                    <?php
                                if ($result_data->num_rows > 0) {
                                
                                    while ($row_data = $result_data->fetch_assoc()) {
                                        echo '<option value="'.$row_data['id'].'" '
                                            . (((int)$f_id === (int)$row_data['id']) ? 'selected' : '')
                                            . '>'
                                            . $row_data['place_name']
                                            . '</option>';
                                    }
                                }
                                ?>
                                </option>
                            </select>
                        </div>

                        <div class="col-sm-3  m-2">
                            <h3>TO</h3>
                            <select class="form-select" aria-label="Default select example" name="to_id">
                                <option selected>--Select--</option>
                                <?php
                                if ($result_data->num_rows > 0) {
                                    mysqli_data_seek($result_data,0);
                                    while ($row_data = $result_data->fetch_assoc()) {
                                        echo '<option value="'.$row_data['id'].'" '
                                            . (((int)$t_id === (int)$row_data['id']) ? 'selected' : '')
                                            . '>'
                                            . $row_data['place_name']
                                            . '</option>';
                                    }
                                }
                                ?>
                                </option>
                                
                            </select>
                        </div>

                        <div class="col-sm-3  m-3">
                            <button type="submit" class="btn btn-danger py-2 m-3">SEARCH</button>
                            
                        </div>
                    </div>
                </form>

                <?php
                    if (isset($search_data) && $search_data->num_rows > 0) {
                        
                        while ($row_data = $search_data->fetch_assoc()) {
                            echo '<div class="row  py-2 m-2 " style="background-color:#ffc0cb;">
                                    <div class="col-sm-8 " style="background-color:#ffc0cb;">
                                        <h4>'. $row_data['bus_name'].'</h4>
                                        <p>Bus type:'. $row_data['bus_type_name'].' ('. $row_data['route_name'].')</p>
                                    </div> 
                                    <div class="col-sm-2">
                                        <h5>Price</h5>
                                        <h6>'. $row_data['price'].'</h6>
                                    </div>
                                    <div class="col-sm-2 py-3">
                                        <a  href="booking_page.php" class="btn btn-danger ">SELECT</a>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo '<h2>Please select From and To</h2>';
                    }
                ?>


                

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>