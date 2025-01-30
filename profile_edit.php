<?php
include "include/db_connect.php";
include("include/security_token.php");
include("include/users_right.php");
if (isset($_GET['clid'])) {

    $clid = $_GET['clid'];
    if ($cstmr = $con->query("SELECT * FROM customers WHERE id='$clid'")) {

        while ($rows = $cstmr->fetch_array()) {
            $lstid = $rows["id"];
            $fullname = $rows["fullname"];
            $package = $rows["package"];
            $username = $rows["username"];
            $password = $rows["password"];
            $mobile = $rows["mobile"];
            $area = $rows["area"];
            $pop = $rows["pop"];
            $address = $rows["address"];
            $nid = $rows['nid'];
            $remarks = $rows['remarks'];
            $con_charge = $rows['con_charge'];
            $pop = $rows['pop'];
            $price = $rows['price'];
            $expiredate = $rows['expiredate'];
            $liablities = $rows['liablities'];
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>FAST-ISP-BILLING-SOFTWARE</title>
    <?php include 'style.php'; ?>

</head>

<body data-sidebar="dark">




    <!-- Begin page -->
    <div id="layout-wrapper">

      <?php $page_title="Update Customer";  include 'Header.php';?>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <?php include 'Sidebar_menu.php'; ?>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <div class="card">
                                <div class="card-header">Update Customer</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                                <label>Fullname</label>
                                                <input type="text" id="userUpdateId" class="d-none" value="<?php echo $lstid; ?>" name="id">

                                                <input type="text" id="fullname" class="form-control" value="<?php echo $fullname; ?>" name="fullname">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                                <label>User Name </label>
                                                <input id="username" type="text" class="form-control" name="username" value="<?php echo $username; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                                <label>Password</label>
                                                <input id="password" name="password" type="text" class="form-control" value="<?php echo $password; ?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                                <label>Mobile no.</label>
                                                <input id="mobile" type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                                <label>Area/Location</label>
                                                <select id="area" class="form-select" name="area">
                                                    <option value="<?php echo $area; ?>">
                                                        <?php

                                                        $areaId = $area;

                                                        $allArea = $con->query("SELECT * FROM area_list WHERE id=$areaId");
                                                        while ($rows = $allArea->fetch_array()) {
                                                            echo $rows['name'];
                                                        }

                                                        ?>
                                                    </option>


                                                    
                                                        <?php

                                                        $allArea = $con->query("SELECT * FROM area_list WHERE pop_id=$pop");
                                                        while ($rows = $allArea->fetch_array()) {
                                                            echo '<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
                                                        }

                                                        ?>
                                                    

                                                    <?php
                                                    if ($area = $con->query("SELECT * FROM area_list WHERE pop=$pop ")) {
                                                        while ($rows = $area->fetch_array()) {


                                                            $name = $rows["name"];
                                                            $id = $rows["id"];

                                                            echo '<option value=' . $id . '>' . $name . '</option>';
                                                        }
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                                <label>Package</label>
                                                <select id="package" class="form-select" name="package">
                                                    <option value="<?php echo $package; ?>">

                                                        <?php

                                                        $packageNameId = $package;

                                                        $allPackageee = $con->query("SELECT * FROM branch_package WHERE id=$packageNameId");
                                                        while ($popRowwww = $allPackageee->fetch_array()) {
                                                            echo $popRowwww['package_name'];
                                                        }

                                                        ?>

                                                    </option>
                                                    <?php

                                                    $sql = "SELECT * FROM branch_package WHERE pop_id=$pop";
                                                    $result = mysqli_query($con, $sql);
                                                    while ($rows = mysqli_fetch_assoc($result)) {


                                                    ?>

                                                        <option value="<?php echo $rows['id'] ?>">

                                                            <?php echo  $rows['package_name'];
                                                            ?>


                                                        </option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                                <label>Addres</label>
                                                <input id="address" type="text" class="form-control" name="address" value="<?php echo $address; ?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                                <label>Nid Card Number</label>
                                                <input id="nid" type="text" class="form-control" name="nid" value="<?php echo $nid; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                                <label>Remarks</label>
                                                <textarea id="remarks" type="text" class="form-control" name="remarks"><?php echo $remarks; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                                <label>Connection Charge</label>
                                                <input id="connection_charge" type="text" class="form-control" name="remarks" value="<?php echo $con_charge; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                                <label>Expire Date</label>
                                                <input id="expiredate" type="date" class="form-control" name="expiredate" value="<?php echo $expiredate; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                            <label>Price</label>
                                            <input id="price" type="text" class="form-control" name="price" value="<?php echo $price; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group mb-2">
                                            <label>Liabilites</label>
                                            <select name="liablities" id="liablities" class="form-select">
                                                <?php 
                                                
                                                if($liablities == 0){
                                                    echo '<option value="0" selected>No</option>';
                                                    echo '<option value="1">Yes</option>';
                                                }else{
                                                    echo '<option value="1" selected>Yes</option>';
                                                    echo '<option value="0">No</option>';
                                                }
                                                
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <button id="updateBtn" type="button" class="btn btn-success mt-3">Update Now</button>
                                            <button class="btn btn-danger mt-3" type="button" onclick="history.back();">Back</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'Footer.php'; ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

   

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>


    <?php include 'script.php'; ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#updateBtn").click(function() {

                var id = $("#userUpdateId").val();
                var fullname = $("#fullname").val();
                var username = $("#username").val();
                var password = $("#password").val();
                var mobile = $("#mobile").val();
                var area = $("#area").val();
                var package = $("#package").val();
                var price = $("#price").val();
                var address = $("#address").val();
                var nid = $("#nid").val();
                var remarks = $("#remarks").val();
                var connection_charge = $("#connection_charge").val();
                var expiredate = $("#expiredate").val();
                var liablities = $("#liablities").val();
                
                if (fullname.length == 0) {
                    toastr.error("Fullnae is require");
                } else if (username.length == 0) {
                    toastr.error("Username is require");
                } else if (password.length == 0) {
                    toastr.error("Password is require");
                } else if (mobile.length == 0) {
                    toastr.error("Mobile is require");
                } else if (area.length == 0) {
                    toastr.error("Area is require");
                } else if (package.length == 0) {
                    toastr.error("Package is require");
                } else if (address.length == 0) {
                    toastr.error("Address is require");
                } else if (connection_charge.length == 0) {
                    toastr.error("Connection is require");
                } else {
                    updateCustomer = "0";
                    $.ajax({
                        type: 'POST',
                        url: 'include/customers_server.php',
                        data: {
                            id: id,
                            fullname: fullname,
                            username: username,
                            password: password,
                            mobile: mobile,
                            area: area,
                            package: package,
                            price:price,
                            address: address,
                            nid: nid,
                            remarks: remarks,
                            connection_charge: connection_charge,
                            expiredate:expiredate,
                            liablities:liablities,
                            updateCustomer: updateCustomer
                        },
                        success: function(response) {
                            if (response == 1) {
                                toastr.success("Update Successfully");

                            } else {
                                
                                toastr.error("Data not Update");
                            }

                        }
                    });
                }

            });
        });
    </script>

</body>

</html>