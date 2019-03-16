<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/17/2019
 * Time: 4:40 PM
 */
$user = getUserSession();
?>
<!-- Modal -->
<div class="modal fade" id="changeManager" tabindex="-1" role="dialog" aria-labelledby="changeManagerLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeManagerLabel">Change <?php echo getDepartment($user->user_id) ?>
                    Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group form-row">

                            <?php
                            $department_id = getUserSession()->department_id;
                            $members = getDepartmentMembers($department_id);
                            $current_mgr = getCurrentManager($department_id);
                            if (isset($current_mgr)) {
                                echo "<label class='w-100 text-center'><label class='badge badge-outline-success' for=\"current_mgr\">Current Manager <i>(" . concatNameWithUserId($current_mgr) . ")</i>  </label></label> ";
                            }
                            ?>
                        </div>
                    </div>
                    <form class="w-100" action="<?php echo site_url('cms-forms/change-manager/' . $department_id) ?>"
                          method="POST"
                          id="changeMgrForm">
                        <div class="col-sm-12">
                            <div class="form-group form-row">
                                <label for="gm" class="col-sm-2 text-sm-right">
                                    Manager
                                </label>
                                <div class="col-sm-10">
                                    <label class="d-none" for="mgr">
                                    </label>
                                    <!--<select class="replace-multiple-select form-control"
                                            id="gm">
                                        <option class="d-none"></option>
                                    </select>-->
                                    <select class="form-control bs-select"
                                            data-none-selected-text="Select Manager"
                                            name="mgr" id="mgr"
                                            aria-describedby="helpId"
                                            data-size="6"
                                            required>
                                        <option class="d-none"></option>
                                        <?php
                                        foreach ($members as $member) { ?>
                                            <option value="<?php echo $member->user_id ?>" <?php if ($current_mgr === $member->user_id) {
                                                echo 'selected';
                                            } ?>><?php echo concatNameWithUserId($member->user_id); ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <small class="form-text with-errors help-block"></small>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" form="changeMgrForm">Submit</button>
            </div>
        </div>
    </div>
</div>
