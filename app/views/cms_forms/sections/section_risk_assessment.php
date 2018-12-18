<?php if ($payload['form']->next_action == ACTION_RISK_ASSESSMENT && isOriginator($payload['form']->cms_form_id, getUserSession()->user_id))
      { ?>
<div class="row p-2">
    <fieldset class="w-100">
        <span class="row w-100 border ml-0 p-1">
            <h6 class="text-bold font-italic col m-1">
                <a href="#section_3" data-toggle="collapse">
                    <i class="fa fa-minus" data-id></i> Section 3 - Risk Assessment
                    <br />
                    <span class="text-muted">
                        <small>
                            (Consider geographical location, processess,
                            materials, equipment, machinery, costs, tasks, people, etc. Risk assessment
                            to be conducted in terms of HSMP 2.01 PR - Health and Safety Identification
                            and Risk Assessment Procedure. Attach risk assessment to this form)
                        </small>
                    </span>
                </a>
            </h6>
            <span class="text-right float-right invisible">
                <?php if (isOriginator($payload['form']->cms_form_id, getUserSession()->user_id))
                      { ?>
                <a href="#" title="Edit this section">
                    <i class="fa fa-edit"></i>
                </a>
                <?php  } ?>
            </span>
        </span>
        <div id="section_3" class="collapse show section p-3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-row">
                        <label for="" class="col-sm-12">
                            Risk Assessment Document
                            <small class="d-sm-inline d-block">(Upload Risk Assessment Document)</small>
                        </label>
                        <div class="col-sm-8">
                            <input class="form-control" type="file" name="risk_attachment" aria-describedby="helpId" placeholder="" />
                            <small id="helpId" class="form-text with-errors"></small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group form-row">
                        <label for="" class="col-sm-12">Affected Departments</label>
                        <div class="col-sm-8">
                             <select class="replace-multiple-select form-control">
                                                    <option></option>
                             </select>
                            <select class="form-control bs-select multiple-hidden d-none" name="affected_dept" aria-describedby="helpId" placeholder="" data-size="6" data-none-selected-text="Select Affected Departments" multiple="multiple">
                              <option class="d-none"></option>
                                <?php

          foreach ($payload['departments'] as $dept)
          { 
                                ?>
            <option value="<?php echo $dept->department_id;?>"><?php echo $dept->department;?></option>
        <?php  }
        ?>
                            </select>
                            <small id="helpId" class="form-text with-errors"></small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-right mt-2">
                    <label></label>
                    <button type="submit" class="btn bg-success w3-btn">Submit</button>
                </div>
            </div>
        </div>
    </fieldset>
</div>
<?php      }
      else {
          if (!empty($payload['form']->affected_departments))
          { ?>
              <div class="row p-2">
    <fieldset class="w-100">
        <span class="row w-100 border ml-0 p-1">
            <h6 class="text-bold font-italic col m-1">
                <a href="#section_3" data-toggle="collapse">
                    <i class="fa fa-minus" data-id></i> Section 3 - Risk Assessment
                    <br />
                    <span class="text-muted">
                        <small>
                            (Consider geographical location, processess,
                            materials, equipment, machinery, costs, tasks, people, etc. Risk assessment
                            to be conducted in terms of HSMP 2.01 PR - Health and Safety Identification
                            and Risk Assessment Procedure. Attach risk assessment to this form)
                        </small>
                    </span>
                </a>
            </h6>
            <span class="text-right float-right invisible">
                <?php if (isOriginator($payload['form']->cms_form_id, getUserSession()->user_id))
                      { ?>
                <a href="#" title="Edit this section">
                    <i class="fa fa-edit"></i>
                </a>
                <?php  } ?>
            </span>
        </span>
        <div id="section_3" class="w-100 collapse show section">
            <table class="table table-bordered table-user-information font-raleway">
                <thead class="thead-default d-none">
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row" colspan="2">
                            <span class="row">
                                <span class="col-sm-4 text-sm-right" text-sm-right">
                                    <b>Affected Departments </b>
                                </span>
                                <span class="col-sm-8">
                                    <?php 
          $dept = [];
          foreach (getAffectedDepartments($payload['form']->cms_form_id) as $value)
          {
              $dept[] = $value->department;
          }
          if (count($dept) > 0)
          {
          concatWith(', ','& ', $dept);
          }
                                    ?>
                                </span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row" colspan="2">
                            <span class="row">
                                <span class="col-sm-4 text-sm-right" text-sm-right">
                                    <b>Risk Assessment</b>
                                </span>
                                <span class="col-sm-8">
                                    <a href="#" class="btn btn-primary">Download Attachment</a>
                                </span>
                            </span>
                        </td>
                    </tr>
               </tbody>
            </table>
        </div>
    </fieldset>
                    <?php require_once(APP_ROOT. '/views/cms_forms/sections/'. SECTION_3B. '.php'); ?>
    
</div>
       <?php   }
          
?>

   <?php   }
   ?>
