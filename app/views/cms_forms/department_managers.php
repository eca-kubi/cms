<?php require_once APP_ROOT . '\views\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\includes\navbar.php'; ?>
<?php require_once APP_ROOT . '\views\includes\sidebar.php'; ?>
<?php
$user = getUserSession();
?>
    <!-- .content-wrapper -->
    <div class="content-wrapper animated fadeInRight" style="margin-top: <?php echo NAVBAR_MT; ?>">
        <!-- .content-header-->
        <section class="content-header d-none">
            <!-- .container-fluid -->
            <div class="container-fluid">
                <!-- .row -->
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">
                                <a href="javascript: window.history.back();" class="btn w3-btn bg-gray">
                                    <i class="fa fa-backward"></i> Go Back
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <h1>
                            <?php echo APP_NAME; ?>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content-header-->
        <!-- content -->
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h5>
                        <?php flash('flash_department_managers'); ?>
                    </h5>
                    <h3 class="box-title text-bold d-none">
                        <?php /** @var array $payload */
                        echo $payload['title']; ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body pt-0">
                    <form class="w-100" action="<?php echo site_url('cms-forms/department-managers/') ?>" method="POST">
                        <table class="table-striped table-active table table-bordered table-user-information font-raleway mb-0">
                            <thead class="thead-default">
                            <tr>
                                <th>Department</th>
                                <th>Manager</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-right">
                                <td colspan="2"><input class="btn btn-outline-success" type="submit"></td>
                            </tr>
                            <?php
                            $departments = (new DepartmentModel())->getAllDepartments();
                            foreach ($departments as $department) {
                                $current_mgr = getCurrentManager($department->department_id);
                                $members = getDepartmentMembers($department->department_id);
                                ?>
                                <tr>
                                    <td><?php echo $department->department; ?></td>
                                    <td>
                                        <select class="form-control bs-select" data-none-selected-text="Select Manager"
                                                name="mgrs[]"
                                                aria-describedby="helpId"
                                                data-size="6">
                                            <option class="d-none"></option>
                                            <?php
                                            foreach ($members as $member) { ?>
                                                <option value="<?php echo $member->user_id ?>" <?php if ($current_mgr === $member->user_id) {
                                                    echo 'selected';
                                                } ?>><?php echo concatNameWithUserId($member->user_id); ?></option>
                                            <?php }
                                            ?>}
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                            <tr class="text-right">
                                <td colspan="2"><input class="btn btn-outline-success" type="submit" value="Submit">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer"></div>
                <!-- /.box-footer-->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<?php require_once APP_ROOT . '\views\includes\footer.php'; ?>