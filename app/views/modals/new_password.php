<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/17/2019
 * Time: 4:08 PM
 */
?>
<!-- New Password Modal -->
<div class="modal fade" id="new_password_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
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
                <?php flash('flash'); ?>
                <div>
                    <form method="post" action="<?php echo site_url('users/new-password'); ?>" id="new_password_form"
                          role="form">
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Enter your new password" required>
                            <small class="with-errors help-block"></small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="confirm_password"
                                   placeholder="Confirm Password" data-match-error="The passwords must match"
                                   data-match="#password" required>
                            <small class="with-errors help-block"></small>
                        </div>
                        <input type="hidden" name="email" value="<?php /** @var array $payload */
                        echo $payload['post']['email']; ?>">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col">
                    <button type="button" class="btn btn-secondary float-left" onclick="window.history.back();">Go
                        Back
                    </button>
                    <button type="submit" form="new_password_form" class="btn btn-success float-right">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
