<?php
   include "include/security_token.php";
   include "include/db_connect.php";
   include "include/pop_security.php";
   include "include/users_right.php";
   
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>FAST-ISP-BILLING-SYSTEM</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php include 'style.php';?>
   </head>
   <body data-sidebar="dark">
      
      <!-- Begin page -->
      <div id="layout-wrapper">
      <?php $page_title="Customers"; include 'Header.php';?>
      <!-- ========== Left Sidebar Start ========== -->
      <div class="vertical-menu">
         <div data-simplebar class="h-100">
            <!--- Sidemenu -->
            <?php include 'Sidebar_menu.php';?>
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
                  <div class="col-md-12 grid-margin">
                     <div class="d-flex justify-content-between flex-wrap">
                        <div class="d-flex align-items-end flex-wrap">
                           <div class="mr-md-3 mr-xl-5">
                              <div class="d-flex">
                                 <i class="mdi mdi-home text-muted hover-cursor"></i>
                                 <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;
                                 </p>
                                 <p class="text-primary mb-0 hover-cursor">Customers</p>
                              </div>
                           </div>
                           <br>
                        </div>
                        <div class="d-flex justify-content-between align-items-end flex-wrap">
                           <button data-bs-toggle="modal" data-bs-target="#addCustomerModal" class="btn btn-primary mt-2 mt-xl-0 mdi mdi-account-plus mdi-18px" id="addBtn" style="margin-bottom: 12px;">&nbsp;&nbsp;New customer</button>
                        </div>
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" id="addCustomerModal" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><span class="mdi mdi-account-check mdi-18px"></span> &nbsp;New customer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="">
                                    <form id="customer_form">
                                       <div class="card">
                                          <div class="card-body">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="form-group mb-2">
                                                      <label>Full Name</label>
                                                      <input id="customer_fullname" type="text" class="form-control " placeholder="Enter Your Fullname" />
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group mb-2">
                                                      <label>Username <span id="usernameCheck"></span></label>
                                                      <input id="customer_username" type="text" class="form-control " name="username" placeholder="Enter Your Username" oninput="checkUsername();" />
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="form-group mb-2">
                                                      <label>Password</label>
                                                      <input id="customer_password" type="password" class="form-control " name="password" placeholder="Enter Your Password" />
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group mb-2">
                                                      <label>Mobile no.</label>
                                                      <input id="customer_mobile" type="text" class="form-control " name="mobile" placeholder="Enter Your Mobile Number" />
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="form-group mb-2">
                                                      <label>Expired Date</label>
                                                      <select id="customer_expire_date" class="form-select">
                                                         <option value="<?php echo date("d"); ?>"><?php echo date("d"); ?></option>
                                                         <?php
                                                            if ($exp_cstmr = $con->query("SELECT * FROM customer_expires")) {
                                                                while ($rowsssss = $exp_cstmr->fetch_array()) {
                                                            
                                                                    $exp_date = $rowsssss["days"];
                                                            
                                                                    echo '<option value="' . $exp_date . '">' . $exp_date . '</option>';
                                                                }
                                                            }
                                                            
                                                            ?>
                                                      </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group mb-2">
                                                      <label>Address</label>
                                                      <input id="customer_address" type="text" class="form-control" name="address" placeholder="Enter Your Addres" />
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6 ">
                                                   <div class="form-group mb-2">
                                                      <label>POP/Branch</label>
                                                      <select id="customer_pop" class="form-select">
                                                         <option value="">Select Pop/Branch</option>
                                                         <?php
                                                            if ($pop = $con->query("SELECT * FROM add_pop ")) {
                                                                while ($rows = $pop->fetch_array()) {
                                                            
                                                                    $id = $rows["id"];
                                                                    $name = $rows["pop"];
                                                            
                                                                    echo '<option value="' . $id . '">' . $name . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                      </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                   <div class="form-group mb-2">
                                                      <label>Area/Location</label>
                                                      <select id="customer_area" class="form-select" name="area">
                                                         <option>Select Area</option>
                                                      </select>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="form-group mb-2">
                                                      <label>Nid Card Number</label>
                                                      <input id="customer_nid" type="text" class="form-control" name="nid" placeholder="Enter Your Nid Number" />
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group mb-2">
                                                      <label>Package</label>
                                                      <select id="customer_package" class="form-select">
                                                      </select>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="form-group mb-2">
                                                      <label>Connection Charge</label>
                                                      <input id="customer_con_charge" type="text" class="form-control" name="con_charge" placeholder="Enter Connection Charge" value="500" />
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group mb-2">
                                                      <label>Package Price</label>
                                                      <input disabled id="customer_price" type="text" class="form-control" value="00" />
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <label>Remarks</label>
                                                      <textarea id="customer_remarks" type="text" class="form-control" placeholder="Enter Remarks"></textarea>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <label>Status</label>
                                                      <select id="customer_status" class="form-select">
                                                         <option value="">Select Status</option>
                                                         <option value="0">Disable</option>
                                                         <option value="1">Active</option>
                                                         <option value="2">Expire</option>
                                                         <option value="3">Request</option>
                                                      </select>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success" id="customer_add">Add Customer</button>
                                 </div>
                              </div>
                              <!-- /.modal-content -->
                           </div>
                           <!-- /.modal-dialog -->
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="col-md-12 float-md-right grid-margin-sm-0">
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group mb-2">
                                       <label>PoP/Branch</label>
                                       <select id="srch_poplst" class="form-select">
                                          <option value="">Select PoP/Branch</option>
                                          <?php
                                             if ($pop = $con->query("SELECT * FROM add_pop ")) {
                                                 while ($rows = $pop->fetch_array()) {
                                             
                                                     $id = $rows["id"];
                                                     $name = $rows["pop"];
                                             
                                                     echo '<option value="' . $id . '">' . $name . '</option>';
                                                 }
                                             }
                                             ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group mb-2">
                                       <label>Area</label>
                                       <select id="srch_area" class="form-select" name="area">
                                          <option value="all">All</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group mb-2">
                                       <label>Status</label>
                                       <select id="customer_sttssrch" class="form-select" name="customer_sttssrch">
                                          <option value="all">All</option>
                                          <option value="recharge">Recharge</option>
                                          <option value="online">Online</option>
                                          <option value="offline">Offline</option>
                                          <option value="expired">Expired</option>
                                          <option value="due">DUE</option>
                                          <option value="unpaid">Unpaid</option>
                                          <option value="active">Active</option>
                                          <option value="disabled">Disabled</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <?php // PoP, Area, Status(Active, Expired, Online, Offline, Locked, DUE, Free user, Unpaid), after create redirect to customer profile page    ?>
                              <div class="table-responsive ">
                                 <form name="actionFrm" id="actionFrm" >
                                    <div id="customer_tbl_list">
                                    </div>
                                    </br>
                                    <div style="float:Right; width:auto;" >
                                       <table width="auto">
                                          <tr>
                                             <td>
                                                <select id="customer_actions" name="actions" class="form-select">
                                                   <option value="">Select Status</option>
                                                   <option value="1">Recharge</option>
                                                   <option value="2">SMS</option>
                                                   <option value="3">Print</option>
                                                   <option value="4">Packages</option>
                                                   <option value="5">Change PoP/Branch</option>
                                                   <option value="6">Active</option>
                                                   <option value="7">Disable</option>
                                                </select>
                                             </td>
                                             <td>
                                                <select id="customer_popact" name="pop" class="form-select">
                                                   <option value="">Select PoP/Branch</option>
                                                   <?php
                                                      if ($pop = $con->query("SELECT * FROM add_pop ")) {
                                                          while ($rows = $pop->fetch_array()) {
                                                      
                                                              $id = $rows["id"];
                                                              $name = $rows["pop"];
                                                      
                                                              echo '<option value="' . $id . '">' . $name . '</option>';
                                                          }
                                                      }
                                                      ?>
                                                </select>
                                             </td>
                                             <td>
                                                <select id="customer_areaact" class="form-select" name="area">
                                                   <option>Select Area</option>
                                                </select>
                                             </td>
                                             <td align="right">
                                                <button class="btn btn-danger mdi mdi-book-cog-outline " id="processBtn" >&nbsp;&nbsp;Process</button>
                                             </td>
                                          </tr>
                                       </table>
                                 </form>
                                 </br>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <footer class="footer">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-6">
                        <script>
                           document.write(new Date().getFullYear())
                        </script> © IT-FAST.
                     </div>
                     <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                           Development <i class="mdi mdi-heart text-danger"></i><a target="__blank" href="https://facebook.com/itfastbd">iT-Fast</a>
                        </div>
                     </div>
                  </div>
               </div>
            </footer>
         </div>
         <!-- end main content-->
      </div>
      <!-- END layout-wrapper -->
      <!-- Right Sidebar -->
      <div class="right-bar">
         <div data-simplebar class="h-100">
            <div class="rightbar-title px-3 py-4">
               <a href="javascript:void(0);" class="right-bar-toggle float-end">
               <i class="mdi mdi-close noti-icon"></i>
               </a>
               <h5 class="m-0">Settings</h5>
            </div>
            <!-- Settings -->
            <hr class="mt-0">
            <h6 class="text-center mb-0">Choose Layouts</h6>
            <div class="p-4">
               <div class="mb-2">
                  <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="Layouts-1">
               </div>
               <div class="form-check form-switch mb-3">
                  <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch">
                  <label class="form-check-label" for="light-mode-switch">Light Mode</label>
               </div>
               <div class="mb-2">
                  <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="Layouts-2">
               </div>
               <div class="form-check form-switch mb-3">
                  <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css">
                  <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
               </div>
               <div class="mb-2">
                  <img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="Layouts-3">
               </div>
               <div class="form-check form-switch mb-3">
                  <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css">
                  <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
               </div>
            </div>
         </div>
         <!-- end slimscroll-menu-->
      </div>
      <!-- /Right-bar -->
      <div id="deleteModal" class="modal fade">
         <div class="modal-dialog modal-confirm">
            <div class="modal-content">
               <div class="modal-header flex-column">
                  <div class="icon-box">
                     <i class="fa fa-trash"></i>
                  </div>
                  <h4 class="modal-title w-100">Are you sure?</h4>
                  <h4 class="modal-title w-100 " id="DeleteId">1</h4>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="True">&times;</button>
               </div>
               <div class="modal-body">
                  <p>Do you really want to delete these records? This process cannot be undone.</p>
               </div>
               <div class="modal-footer justify-content-center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-danger" id="DeleteConfirm">Delete</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" id="customerPrint_Modal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span class="mdi mdi-account-check mdi-18px"></span> &nbsp;Print customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="customerDataContainer">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button"  class="btn btn-success" id="printCustomerButton">Print Customer</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

      <!-- Right bar overlay-->
      <div class="rightbar-overlay"></div>
      <!-- JAVASCRIPT -->
      <script src="assets/libs/jquery/jquery.min.js"></script>
      <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/libs/metismenu/metisMenu.min.js"></script>
      <script src="assets/libs/simplebar/simplebar.min.js"></script>
      <script src="assets/libs/node-waves/waves.min.js"></script>
      <!-- Required datatable js -->
      <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
      <!-- Buttons examples -->
      <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
      <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
      <script src="assets/libs/jszip/jszip.min.js"></script>
      <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
      <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
      <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
      <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
      <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
      <!-- Responsive examples -->
      <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
      <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
      <script type="text/javascript" src="js/toastr/toastr.min.js"></script>
      <script type="text/javascript" src="js/toastr/toastr.init.js"></script>
      <!-- Datatable init js -->
      <script src="assets/js/pages/datatables.init.js"></script>
      <script src="assets/js/app.js"></script>
      <script type="text/javascript">
         $(document).ready(function() {
            $("#printCustomerButton").click(function(){
                printCustomerData();
            });
         	$("#customer_popact").hide();
         	$("#customer_areaact").hide();
         
         	//Search Customer by POP
         	$(document).on('change', '#srch_poplst', function() {
                    var searchdta = 'srch_poplst='+$(this).val() + '&srch_area_id='+$("#srch_area").val() + '&customer_sttssrch='+$("#customer_sttssrch").val();
                  //   alert(searchdta);return false; 
                    $.ajax({
                        type: 'POST',
                        url: "include/customers_list_table.php",
                        data: searchdta,
                        success: function(response) {
                             $("#customer_tbl_list").html(response);
                        }
                    });
                });
         
         	// Search customer with Area Criteria
         	$(document).on('change', '#srch_area', function() {
                    var searchdta = 'srch_area_id='+$(this).val() + '&srch_poplst='+$("#srch_poplst").val() + '&customer_sttssrch='+$("#customer_sttssrch").val();
                    $.ajax({
                        type: 'POST',
                        url: "include/customers_list_table.php",
                        data: searchdta,
                        success: function(response) {
                             $("#customer_tbl_list").html(response);
                        }
                    });
                });
         
         	// Search customer with Status Criteria
         	$(document).on('change', '#customer_sttssrch', function() {
                    var searchdta = 'customer_sttssrch='+$(this).val() + '&srch_poplst='+$("#srch_poplst").val() + '&srch_area_id='+$("#srch_area").val();
                    //alert(searchdta);
         		$.ajax({
                        type: 'POST',
                        url: "include/customers_list_table.php",
                        data: searchdta,
                        success: function(response) {
                             $("#customer_tbl_list").html(response);
                        }
                    });
                });
         
         
         
         	//Search  by POP & Load area
         	$(document).on('change', '#srch_poplst', function() {
                    var popiD = $(this).val();
         		if(popiD !=0)
         		{
         			 $.ajax({
                        type: 'POST',
                        url: "include/customers_server.php",
                        data: {
                            srch_pop_name: popiD
                        },
                        success: function(response) {
                             $("#srch_area").html(response);
                        }
                    });
         
         		}
         
         
                });
         	// Action for customers
         	//POP load
         	$(document).on('change', '#customer_actions', function() {
                    if($(this).val()== 4)
         		{
         			$("#customer_popact").show();
         			$("#customer_areaact").show();
         		}
         		else{ $("#customer_popact").hide();
         		$("#customer_areaact").hide();}
         
                });
         
         
         	//Area load
         	$(document).on('change', '#customer_popact', function() {
                    var popiD = $(this).val();
         		if(popiD !=0)
         		{
         			 $.ajax({
                        type: 'POST',
                        url: "include/customers_server.php",
                        data: {
                            current_pop_name: popiD
                        },
                        success: function(response) {
                             $("#customer_areaact").html(response);
                        }
                    });
         
         		}
         
         
                });
         
         	// Form Submission
         	$("#processBtn").click(function(e) {
                e.preventDefault(); 
                $.ajax({
                    type: 'POST',
                    url: "include/customers_actions.php",
                    data: {
                        action: $('#customer_actions').val(),
                        pop: $('#srch_poplst').val(),
                        area: $('#srch_area').val(),
                        process:'print',
                    },
                    success: function(response) {

                        var data = JSON.parse(response);
                        var modalBody = '<table class="table table-responsive table-bordered">';
                        modalBody += '<thead><tr>';
                        modalBody += '<th>ID</th>';
                        modalBody += '<th>Full Name</th>';
                        modalBody += '<th>Expire Date</th>';
                        modalBody += '<th>Username</th>';
                        modalBody += '<th>Phone</th>';
                        modalBody += '<th>Comment</th>';
                        modalBody += '</tr></thead>';
                        modalBody += '<tbody>';
                        data.forEach(function(customer) {
                           var expireDate = new Date(customer.expiredate);
                           var todayDate = new Date();

                             modalBody += '<tr>';
                             modalBody += '<td>' + customer.id + '</td>';
                             modalBody += '<td>' + customer.fullname + '</td>';
                             if (expireDate <= todayDate) {
                                 modalBody += '<td><span class="badge bg-danger">Expired</span></td>';
                              } else {
                                 modalBody += '<td>' + customer.expiredate + '</td>';
                              }
                             modalBody += '<td>' + customer.username + '</td>';
                             modalBody += '<td>' + customer.mobile + '</td>';
                             modalBody += '<td><input type="text" class="form-control"></td>';
                             modalBody += '</tr>';
                        });
                        modalBody += '</tbody></table>';

                        $('#customerPrint_Modal #customerDataContainer').html(modalBody);
                        $("#customerPrint_Modal").modal('show'); 
                    },
                    error: function(xhr, status, error) {
                        console.error("An error occurred: " + error);
                    }
                });
         	});
         
            // Print function
            function printCustomerData() {
                var printContents = document.getElementById('customerDataContainer').innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
         
         
         
                    $("#checkedAll").change(function() {
                        if (this.checked) {
                            $(".checkSingle").each(function() {
                                this.checked = true;
                            })
                        } else {
                            $(".checkSingle").each(function() {
                                this.checked = false;
                            })
                        }
                    });
         
                    $(".checkSingle").click(function() {
                        if ($(this).is(":checked")) {
                            var isAllChecked = 0;
                            $(".checkSingle").each(function() {
                                if (!this.checked)
                                    isAllChecked = 1;
                            })
                            if (isAllChecked == 0) {
                                $("#checkedAll").prop("checked", true);
                            }
                        } else {
                            $("#checkedAll").prop("checked", false);
                        }
                    });
         		});
         
         
         
         
                $("#customers_table").DataTable();
         
                $(document).on('keyup', '#customer_username', function() {
                    var customer_username = $("#customer_username").val();
                    $.ajax({
                        type: 'POST',
                        url: "include/customers_server.php",
                        data: {
                            current_username: customer_username
                        },
                        success: function(response) {
                            $("#usernameCheck").html(response);
                        }
                    });
                });
         
                $(document).on('change', '#customer_pop', function() {
                    var pop_id = $("#customer_pop").val();
                    //alert(pop_id);
                    $.ajax({
                        type: 'POST',
                        url: "include/customers_server.php",
                        data: {
                            current_pop_name: pop_id
                        },
                        success: function(response) {
                             $("#customer_area").html(response);
                        }
                    });
                });
                $(document).on('change', '#customer_pop', function() {
                    var pop_id = $("#customer_pop").val();
                   // alert(pop_id);
                    $.ajax({
                        type: 'POST',
                        url: "include/customers_server.php",
                        data: {
                            pop_name: pop_id,
                            getCustomerPackage:0
                        },
                        success: function(response) {
                             $("#customer_package").html(response);
                        }
                    });
                });
         
         
                $(document).on('change', '#customer_package', function() {
                    var packageId = $("#customer_package").val();
                    var pop_id = $("#customer_pop").val();
                   // alert(pop_id);
                    $.ajax({
                        type: 'POST',
                        url: "include/customers_server.php",
                        data: {
                            package_id: packageId,
                            pop_id: pop_id,
                            getPackagePrice:0
                        },
                        success: function(response) {
                             $("#customer_price").val(response);
                        }
                    });
                });
         
         
         
         
                $("#customer_add").click(function() {
                    var fullname = $("#customer_fullname").val();
                    var package = $("#customer_package").val();
                    var username = $("#customer_username").val();
                    var password = $("#customer_password").val();
                    var mobile = $("#customer_mobile").val();
                    var address = $("#customer_address").val();
                    var expire_date = $("#customer_expire_date").val();
                    var area = $("#customer_area").val();
                    var pop = $("#customer_pop").val();
                    var nid = $("#customer_nid").val();
                    var con_charge = $("#customer_con_charge").val();
                    var price = $("#customer_price").val();
                    var remarks = $("#customer_remarks").val();
                    var status = $("#customer_status").val();
                    var user_type = <?php echo $auth_usr_type; ?>;
         
                    customerAdd(user_type, fullname, package, username, password, mobile, address, expire_date, area, pop, con_charge, price, remarks, nid, status)
         
                });
         
                function customerAdd(user_type, fullname, package, username, password, mobile, address, expire_date, area, pop, con_charge, price, remarks, nid, status) {
                    if (fullname.length == 0) {
                        toastr.error("Customer name is require");
                    } else if (package.length == 0) {
                        toastr.error("Customer Package is require");
                    } else if (username.length == 0) {
                        toastr.error("Username is require");
                    } else if (password.length == 0) {
                        toastr.error("Password is require");
                    } else if (mobile.length == 0) {
                        toastr.error("Mobile number is require");
                    } else if (expire_date.length == 0) {
                        toastr.error("Expire Date is require");
                    } else if (pop.length == 0) {
                        toastr.error("POP/Branch is require");
                    } else if (area.length == 0) {
                        toastr.error("Area is require");
                    } else if (con_charge.length == 0) {
                        toastr.error("Connection Charge is require");
                    } else if (price.length == 0) {
                        toastr.error("price is require");
                    } else if (status.length == 0) {
                        toastr.error("Status is require");
                    } else {
                        $("#customer_add").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                        var addCustomerData = 0;
                        $.ajax({
                            type: 'POST',
                            url: 'include/customers_server.php',
                            data: {
                                addCustomerData: addCustomerData,
                                fullname: fullname,
                                package: package,
                                username: username,
                                password: password,
                                mobile: mobile,
                                address: address,
                                expire_date: expire_date,
                                area: area,
                                pop: pop,
                                con_charge: con_charge,
                                price: price,
                                remarks: remarks,
                                nid: nid,
                                status: status,
                                user_type: user_type,
                            },
                            success: function(responseData) {
                                if (responseData == 1) {
                                    toastr.success("Added Successfully");
                                    $("#addCustomerModal").modal('hide');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    toastr.error(responseData);
                                }
                            }
                        });
                    }
                }
            
      </script>
   </body>
</html>