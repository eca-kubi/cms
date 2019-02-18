<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/17/2019
 * Time: 4:11 PM
 */
?>
<!-- Change Password Modal -->
<div class="modal fade" id="change_password_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content fa font-weight-normal">
            <div class="modal-header">
                <h6 class="modal-title" id="modelTitleId">Password Reset</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php //flash('flash'); ?>
                <div>
                    <form action="<?php echo site_url('users/change-password'); ?>" data-toggle="validator"
                          id="change_password_form" method="post"
                          role="form">
                        <div class="form-group">
                            <input type="password" class="form-control mb-1" id="current_password"
                                   name="current_password"
                                   placeholder="Current Password" required>
                            <small class="with-errors help-block"></small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control mb-1" id="password" name="password"
                                   placeholder="New Password" required>
                            <small class="with-errors help-block "></small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control mb-1" name="confirm_password"
                                   placeholder="Confirm New Password" data-match-error="The passwords must match"
                                   data-match="#password" required>
                            <small class="with-errors help-block text-muted"></small>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col">
                    <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Cancel
                    </button>
                    <button type="submit" form="change_password_form" class="btn btn-success float-right">Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
