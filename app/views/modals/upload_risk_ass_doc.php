<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/17/2019
 * Time: 4:11 PM
 */
?>
<!-- Change Password Modal -->
<div class="modal fade" id="uploadRiskAssDoc" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content fa font-weight-normal">
            <div class="modal-header">
                <h6 class="modal-title" id="modelTitleId">Upload Additional Documents</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php //flash('flash'); ?>
                <div>
                    <form action="<?php /** @var array $payload */
                    echo site_url('cms-forms/upload-risk-ass-documents/' . $payload['form']->cms_form_id); ?>"
                          data-toggle="validator"
                          id="uploadRiskAssDocForm" method="post" enctype="multipart/form-data"
                          role="form">
                        <div class="form-row multiple-form-group" data-max="15">
                            <!--<label for="" class="col-sm-4 text-sm-right">
                                Additional Information <br>
                                <small>(Maximum of three)</small>
                            </label>-->
                            <div class="col-sm-12 form-group">
                                <div class="input-group">
                                    <input accept="<?php echo DOC_FILE_TYPES; ?>"
                                           class="form-control" name="additional_info[]"
                                           required type="file"/>
                                    <div class="input-group-append cursor-pointer"
                                         title="Click to add more files.">
                                        <div class="input-group-text add-input"><i
                                                    class="fas fa-plus-square text-success"></i>
                                        </div>
                                    </div>
                                </div>
                                <small class="help-block text-muted">Hint: Attach any additional
                                    documents <i>(Maximum of fifteen)</i>
                                </small>
                                <small id="helpId" class="form-text with-errors help-block"></small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col">
                    <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Cancel
                    </button>
                    <button type="submit" form="uploadRiskAssDocForm" class="btn btn-success float-right">Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
