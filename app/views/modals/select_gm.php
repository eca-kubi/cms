<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/17/2019
 * Time: 4:40 PM
 */
?>
<!-- Modal -->
<div class="modal fade" id="changeGM" tabindex="-1" role="dialog" aria-labelledby="changeGMLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeGMLabel">Change GM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group form-row">

                            <?php
                            $gms = getGms();
                            $current_gm = getCurrentGM();
                            echo "<label class='w-100 text-center'><label class='badge badge-outline-success' for=\"current_gm\">Current GM <i>(" . getFullName($current_gm) . ")</i>  </label></label> ";
                            ?>
                        </div>
                    </div>
                    <form class="w-100" action="<?php echo site_url('cms-forms/change-gm/') ?>" method="POST"
                          id="changeGMForm">
                        <div class="col-sm-12">
                            <div class="form-group form-row">
                                <label for="gm" class="col-sm-2 text-sm-right">
                                    GM
                                </label>
                                <div class="col-sm-10">
                                    <label class="d-none" for="gm">
                                    </label>
                                    <!--<select class="replace-multiple-select form-control"
                                            id="gm">
                                        <option class="d-none"></option>
                                    </select>-->
                                    <select class="form-control bs-select"
                                            data-none-selected-text="Select GM"
                                            name="gm" id="gm"
                                            aria-describedby="helpId"
                                            data-size="6"
                                            required>
                                        <option class="d-none"></option>
                                        <?php
                                        foreach ($gms as $gm) { ?>
                                            <option value="<?php echo $gm->user_id ?>" <?php if ($current_gm === $gm->user_id) {
                                                echo 'selected';
                                            } ?>><?php echo getFullName($gm->user_id); ?></option>
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
                <button type="submit" class="btn btn-success" form="changeGMForm">Submit</button>
            </div>
        </div>
    </div>
</div>
