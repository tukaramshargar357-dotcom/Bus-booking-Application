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

?>

<?php

    $sql_select_all = "SELECT * FROM `places`";
    $result_data = $conn->query($sql_select_all);
    //print_r($result_data);

    if (isset($_GET['from']) && isset($_GET['to'])) {

        $f_id = (int)$_GET['from'];
        $t_id = (int)$_GET['to'];

        $sql = "SELECT rb.id,br.route_name, bn.bus_name,bt.bus_type_name, rb.bus_number,rb.price, rb.total_seats
            FROM `route_bus` AS rb 
            INNER JOIN bus_name AS bn ON rb.bus_name_id = bn.id
            INNER JOIN bus_type AS bt ON rb.bus_type_id = bt.id
            INNER JOIN bus_route AS br ON rb.route_id = br.id
            WHERE br.from_place_id = ".$f_id." and br.to_place_id = ".$t_id.";";
            $search_data = $conn->query($sql);
            print_r($search_data);
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
                <h2 style="text-align:center;">BOOKING PAGE</h2>

                <div class="row py-2">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <h3>FROM</h3>
                        <select class="form-select" aria-label="Default select example">
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
                </div>

                <div class="row py-2">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <h3>TO</h3>
                        <select class="form-select" aria-label="Default select example">
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
                </div>
                <div class="row py-2">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2 py-2">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">ID</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-3 py-2">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Booking Date</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-3 py-2">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Travel Date</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4 py-2">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Start Time</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-4 py-2">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">End Time</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4 py-2">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Bus Name ID</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-4 py-2">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Bus No</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Customer Name</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Mobile</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Journey from ID</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-2">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Journey To ID</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-4">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Pick Up Point ID</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row py-2">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2 py-2">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">No of Seats</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-3 py-2">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Seat No</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-3 py-2">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Bus Type ID</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Price</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-4">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Total Amount</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row py-2">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2 py-2">
                        <a  href="search_page.php" class="btn btn-danger btn-lg">BACK</a> 
                    </div>

                    <div class="col-sm-3 py-2">
                        <a  href="#" class="btn btn-danger btn-lg">BOOK NOW</a> 
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>