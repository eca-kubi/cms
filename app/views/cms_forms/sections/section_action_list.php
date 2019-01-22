<?php /** @var  array $payload */ ?>

<div class="row p-2">
    <form class="w-100"
          action="<?php echo URL_ROOT . '/cms-forms/action-list/' . $payload['form']->cms_form_id ?>"
          method="post" data-toggle="validator" role="form"
          enctype="multipart/form-data">
        <fieldset class="w-100">
            <div class="w-100 row border ml-0 p-1">
                <h6 class="text-bold font-italic col m-1">
                    <a href="#section_6" data-toggle="collapse">
                        <i class="fa fa-plus" data-id></i> Section 6 - Action List
                        <span class="text-muted d-sm-inline d-block">
                            (To be Completed by - Project Leader)
                        </span>
                    </a>
                </h6>
                <span class="text-right float-right invisible">
                        <a href="#" title="Edit this section">
                        <i class="fa fa-edit"></i>
                    </a>
                </span>
            </div>
            <div id="section_6" class="collapse section border p-3">
                <div class="row hide-on-init invisible">
                    <table class="" id="action_list">
                        <thead class="thead-default">
                        <tr>
                            <th>No.</th>
                            <th>Action to be Taken</th>
                            <th>Responsible Person</th>
                            <th>Date</th>
                            <th>Completed?</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </fieldset>
    </form>
</div>