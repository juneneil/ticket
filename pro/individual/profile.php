<?php
if (!isset($file_access)) die("Direct File Access Denied");
?>
<?php


?>
<!-- Content Header (Page header) -->
<!-- <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Feedback</h1>
            </div>

        </div>
    </div>
</section> -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Info:</h5>
                    We always want to hear from you!
                    Replied to within 24-hours.
                </div>



                <div class="card-body">
                    <div class="table-responsive">

                        <table style="width: 100%;" id="" style="align-items: stretch;"
                            class="table table-hover table-bordered">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userId = $_SESSION['user_id']; // Ensure this session variable is set during login
                                $row = connect()->query("SELECT * FROM passenger WHERE id = $userId");
                                
                                // This is the last code
                                // $row = connect()->query("SELECT * FROM passenger ORDER BY id DESC");
                                if ($row->num_rows < 1) echo "No Records Yet";
                                $sn = 0;
                                while ($fetch = $row->fetch_assoc()) {
                                    $id = $fetch['id']; ?><tr>
                                    <td><?php echo ++$sn; ?></td>
                                    <td><?php echo ($fetch['name']); ?></td>
                                    <td><?php echo ($fetch['email']); ?></td>
                                    <td><?php echo ($fetch['phone']); ?></td>
                                    <td><img src="<?php echo "uploads/" . ($fetch['loc']); ?>"
                                            class="img img-rounded" width="80" height="80" /></td>


                                    <td>
                                        <?php
                                            if ($fetch['status'] == 0) {
                                            ?>
                                        <a href="admin.php?page=users&status=1&id=<?php echo $id; ?>">
                                            <button
                                                onclick="return confirm('You are about allowing this user be able to login his/her account.')"
                                                type="submit" class="btn btn-success">
                                                Enable Account
                                            </button></a>
                                        <?php } else { ?>
                                        <a href="admin.php?page=users&status=0&id=<?php echo $id; ?>">
                                            <button
                                                onclick="return confirm('You are about denying this user access to  his/her account.')"
                                                type="submit" class="btn btn-danger">
                                                Delete Account
                                            </button></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>

                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <div class="modal-header">
                <h4 class="modal-title">Send New Feedback </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                Type Message : <textarea name="message" required minlength="10" id="" cols="30"
                                    rows="10" class="form-control"></textarea>
                            </div>

                        </div>


                        <hr>
                        <input type="submit" name="sendFeedback" class="btn btn-success" value="Send"></p>
                </form>


            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php

if (isset($_POST['sendFeedback'])) {
    $msg = $_POST['message'];
    $send = sendFeedback($msg);
    echo $send;
    if ($send) {
        echo "<script>alert('Feedback sent! We will get back to you');window.location='individual.php'</script>";
    } else {
        echo "<script>alert('Feedback could not be sent! Try again!');window.location='individual.php'</script>";
    }
}

?>