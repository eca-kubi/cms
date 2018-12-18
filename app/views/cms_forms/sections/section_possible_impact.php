<?php 
if ($payload['form']->next_action = ACTION_IMPACT_ASSESSMENT)
{ ?>
	<div class="col-sm-12">
    <div class="pl-2">
        <h6 class="text-bold font-italic">
            <a href="#poss_imp" data-toggle="collapse">
                <i class="fa fa-minus"></i> Possible Impacts
            </a>
        </h6>
        <div class="w-100 section collapse show" id="poss_imp">
            <?php foreach ($payload['affected_departments'] as $department_id)
                  {
                      $department = new Department($department_id);
                      $questions = getImpactQuestions($department_id)
            ?>
            
            <div class="w-100 section collapse" >
                <h6 class="text-bold font-italic">
                    <a href="#<?php strtolower( $department->department); ?>" data-toggle="collapse">
                        <i class="fa fa-minus"></i><?php $department>department; ?>
                    </a>
                </h6>
                <table class="table table-bordered table-user-information font-raleway" id="<?php strtolower( $department->department); ?>">
                    <thead class="thead-default">
                        <tr>
                            <th>Will this change:</th>
                            <th class="text-center">Yes</th>
                            <th class="text-center">No</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                      foreach ($questions as $value)

                      { ?>
                        <tr>
                            <td scope="row">
                                <span class="row-n"></span><?php echo $value->question; ?>
                            </td>
                            <td scope="row text-center">
                                <input type="radio" class="form-check mx-sm-auto" name="question_<?php echo $value->cms_impact_question_id?>" value="Yes" />
                            </td>
                            <td scope="row">
                                <input type="radio" class="form-check mx-sm-auto" name="question_<?php echo $value->cms_impact_question_id?>" value="No" />
                            </td>
                        </tr>
                        <?php   }?>

                    </tbody>
                </table>
            </div>
            <div class="dropdown-divider"></div>
             <?php     }
            ?>
            
        </div>
    </div>
</div>
<?php }
?>

