<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
// If session is not set
if(!isset($_SESSION['user_uid']))
{
    if(isset($_SESSION['current_url']))
    {
        $current_url = $_SESSION['current_url'];

        $current_url = base64_decode($current_url);

        ?>
            <script>
                $(document).ready(function(){
                    $("#messageModal #modal_message").html("<div class='alert alert-info'><strong>Please select a Working User.</strong></div>");
                    $("#messageModal").modal("show");
                });
            </script>
        <?php
    }
    else
    {
        $current_url = '';
    }
}
else
{
    $current_url = '';
}

?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">

        <h2>Settings</h2>

        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="col-lg-4 p20 text-right">
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>All User</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">

                    <?php   # If the session message is set then print message
                    if(!is_null($this->session->flashdata('message')))
                    {
                        ?>
                        <div class="alert alert-info alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?= form_open('Settings', ''); ?>
                    <input type="hidden" name="current_url" value="<?= $current_url; ?>">
                    <div class="table-responsive">
                        <table id="users_dataTable" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($users as $user)
                            {
                                if(isset($_SESSION['user_uid']) && $user['user_id'] == $_SESSION['user_uid'])
                                {
                                    $checked = 'checked="checked"';
                                    $class = 'active';
                                }
                                else
                                {
                                    $checked = '';
                                    $class = '';
                                }
                                ?>
                                <tr class="gradeX <?= $class; ?>">
                                    <td>
                                        <input type="radio" name="user_uid" name="user_uid_<?= $user['user_id']; ?>" value="<?= $user['user_id']; ?>" <?= $checked; ?> style="left:30px;opacity:1;">
                                    </td>
                                    <td><?= $user['fname']." ".$user['lname']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td><?= $user['phone']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            <button type="submit" id="saveUser" name="saveUser" class="btn btn-w-m btn-primary dim">Save</button>
                            <button type="submit" id="clearUser" name="clearUser" class="btn btn-w-m btn-primary dim">Clear</button>
                        </div>
                        <?= form_close(); ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="messageModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Message Modal</h4>
      </div>
      <div class="modal-body">
        <p id="modal_message"></p>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
            <button type="button" class="btn btn-raised g-bg-blush2" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>

  </div>
</div>