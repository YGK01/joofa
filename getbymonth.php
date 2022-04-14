<?php
	$conn = mysqli_connect('localhost', 'root', '', 'joofatrading');
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
	if(ISSET($_POST['filter'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
		$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		
        echo "<h3>".$months[$month - 1]." ".$year."</h3>"
        ?>
        <form class="" action="ProductDetail.php?id=<?php $product_id ?> " method="post" enctype="multipart/form-data">
            <table class="table table-bordered">
                <thead class="alert-success">
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Client</th>
                        <th scope="col">Order Date</th>
                    </tr>
                </thead>
                <tbody style="background-color:#fff;">
                    <?php
							$data = [];
							$query = mysqli_query($conn, "SELECT * FROM `orderdetail` WHERE YEAR(OrderDate) = '$year' && MONTH(OrderDate) = '$month' && (OrderStatus='Ordered' OR OrderStatus='Delivering') ") or die(mysqli_error());
							while($fetch = mysqli_fetch_assoc($query)){;
								$data[$i] = array('OrderID' => $fetch['OrderID'], 'OrderTotalPrice' => $fetch['OrderTotalPrice'], 'ProductID' => $fetch['ProductID'], 'OrderNum' => $fetch['OrderNum'], 'clientID' => $fetch['clientID'], 'OrderDate' => $fetch['OrderDate'], 'OrderStatus' => $fetch['OrderStatus']);
								$i++;
							}
							foreach($data as $section => $row){
						?>
                    <tr>

                        <th scope="row"><?php echo $row["OrderID"] ?></th>
                        <td><?php echo $row["ProductID"] ?></td>
                        <td><?php echo $row["OrderNum"] ?></td>
                        <td><?php echo $row["OrderStatus"] ?></td>
                    <td><a href="A_OrderDetail.php?id=<?php echo $row["OrderID"]?>"
                            style="text-decoration:none; "><?php echo $row["clientID"] ?></a></td>
                        <td><?php echo $row["OrderDate"] ?></td>
                    </tr>
                    <?php
																
							}
						echo $total;
						?>

                </tbody>
            </table>


        <?php
	    }else{
        
        
        ?>
        <table class="table table-bordered">
            <thead class="alert-success">
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    <th scope="col">Client</th>
                    <th scope="col">Order Date</th>
                </tr>
            </thead>
            <tbody style="background-color:#fff;">
                <?php
                
					$conn = mysqli_connect('localhost', 'root', '', 'joofatrading');
					$query = mysqli_query($conn, "SELECT * FROM orderdetail WHERE (OrderStatus='Ordered' OR OrderStatus='Delivering') ORDER BY OrderDate ASC") or die(mysqli_error());
					while($row = mysqli_fetch_array($query)){
				?>
                <tr>

                    <th scope="row"><?php echo $row["OrderID"] ?></th>
                    <td><?php echo $row["ProductID"] ?></td>
                    <td><?php echo $row["OrderNum"] ?></td>
                    <td><?php echo $row["OrderStatus"] ?></td>
                    <td><a href="A_OrderDetail.php?id=<?php echo $row["OrderID"]?>"
                            style="text-decoration:none; "><?php echo $row["clientID"] ?></a></td>
                    <td><?php echo $row["OrderDate"] ?></td>
                </tr>
                <?php
                
					}
				?>
            </tbody>
        </table>
    <?php
    }
    ?>
</form>