
<?php
include('header.php');

$res = mysqli_query($conn, "SELECT * FROM `customers` WHERE appliedby='$s_phone' AND status='pending' AND type='2' OR appliedby='$s_phone' AND status='pending' AND type='3' OR appliedby='$s_phone' AND status='pending' AND type='4' OR appliedby='$s_phone' AND status='pending' AND type='6'");
//echo "<pre>"; print_r($res);
if(isset($_POST['delete']) && $_POST['delete'] == "ahkwebsolutions"){
    $id = base64_decode($_POST['id']);
    $del = mysqli_query($conn,"DELETE FROM `customers` WHERE id='$id'");
    if($del){
        ?>
        <script>
            $(function(){
                Swal.fire(
                    'Success',
                    'Data Deleted Success!',
                    'success'
                )
            });
            window.setTimeout(function() {
  window.location.href = "democustomerlist.php";
  }, 1500);
        </script>
        <?php
    }else{
        ?>
        <script>
            $(function(){
                Swal.fire(
                    'Opps',
                    'Data Not Deleted !',
                    'error'
                )
            });
        </script>
        <?php
    }
}
?>

<!-- Content Wrapper. Contains page content -->
      <div class="container-fluid">

                <div class="row page-header">
        <div class="col-lg-6 align-self-center ">
            <h2>View Customers Data</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">View Customers Data</li>
            </ol>
        </div>
        <div class="col-lg-6 align-self-center text-right">
            <a href="add-customer.php" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Create New</a>
        </div>
    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                    <div class="card-header card-default">
                        View Customers Data - <?php echo $udata['name'] ?> <?php echo $udata['usertype'] ?> </div>
                        <div class="card-body">


                                          <div class="table-responsive">
                                <table id="table_id" class="table table-striped table-bordered table-hover">
                             
                                <thead>
                                    <tr>
                                    <th style="width: 50px;" class="text-center">S/NO</th>

                                        <th class="text-center" style="width:80px;">Old Name</th>
                                         <th style="width: 20px;" class="text-center">New Name</th>
                                        <th style="width: 10px;" class="text-center">Aadhaar No</th>
                                        <th class="text-center" style="width:80px;">Mobile No</th>
                                        <th class="text-center" style="width:80px;">Gender</th>
                                        <th class="text-center" style="width:30px;">DOB</th>
										 <th class="text-center" style="width:30px;">Address</th>
                                       
                                        <th style="width: 20px;" class="text-center">Remark</th>
                                        <th style="width: 50px;" class="text-center">date</th>
                                        <th style="width: 120px;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                <?php
                                    if(mysqli_num_rows($res)>0){
                                        $slno = 1;
                                        while($data = mysqli_fetch_array($res)){
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $slno?></td>
                                                 <td> <?php echo $data['name'] ?>
												  <?php if(!empty($data['new_name'])){ echo '<br />English  - ' .$data['new_name']; } ?>
												  <?php if(!empty($data['hindinew_name'])){ echo '<br />Hindi  - ' .$data['hindinew_name']; } ?>
												</td>
												 <td class="text-center"> <?php echo $data['purpose'] ?>
                                                </td>
                                                <td class="text-center"><?php echo $data['aadhaar_no'] ?></td>
                                              
                                                <td><?php echo $data['mobile_no'] ?></td>
                                                <td> <?php echo $data['gender'] ?><?php if(!empty($data['gender'])){ echo '<br />New Gender - ' .$data['new_gender']; } ?></td>
                                                
                                                 <td class="text-center">  <?php echo $data['dob'] ?><?php if(!empty($data['dob'])){ echo '<br />New DOB - ' .$data['new_dob']; } ?>
                                                </td>
												<td class="text-center"> <?php echo $data['address'] ?>
                                               
                                                <td class="text-center"> <a href="#" button class="btn btn-warning"><?php echo $data['status'] ?></button></a>
                                                </td>
                                                <td class="text-center"><?php echo $data['date'] ?></td>
                                                <td class="text-center">


                                                    
                                                    <a href="viewcust.php?id=<?php echo base64_encode($data['id']) ?>" class="btn btn-warning btn-sm ml-2"><i class="fa fa-eye"></i></a>
                                                    <form action="" method="post" class="d-inline">
                                                        <input type="hidden" name="id" value="<?php echo base64_encode($data['id'])  ?>">
                                                        <!--<input type="hidden" name="delete" value="ahkwebsolutions"> <input type="hidden" name="_method" value="DELETE"> <button type="button" class="btn btn-danger btn-sm ml-2" onclick="deleteRecord(this)"><i class="fa fa-trash"></i></button>-->
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                    $slno++;
                                    
                                        }
                                        
                                    }
                                    ?>




                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->

<!-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer> -->

<!-- Control Sidebar -->
<!-- <aside class="control-sidebar control-sidebar-dark"> -->
<!-- Control sidebar content goes here -->
<!-- </aside> -->
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
            $('#table_id').DataTable({

                dom: 'Bfrtip',
                responsive: true,
                pageLength: 25000000000000,
                // lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],

                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]

            });
        });
</script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function alertMessage(type, message) {
        if (type == 'error') {
            type = 'danger';
        }

        return "<div class='alert alert-" + type + " alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> " + message + " </div>";
    }
</script>

<!--<script>-->
<!--    $(function() {-->
<!--        $('#example2').DataTable({-->
<!--            "paging": true,-->
<!--            "lengthChange": true,-->
<!--            "searching": true,-->
<!--            "ordering": true,-->
<!--            "info": true,-->
<!--            "autoWidth": false,-->
<!--            "responsive": true,-->
<!--        });-->
<!--    });-->

    
<!--    }-->
<!--</script>-->

</body>

</html>