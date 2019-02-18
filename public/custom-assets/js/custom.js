/// <reference path='../../assets/ts/kendo.all.d.ts' />
/// <reference path='../../assets/typescript/moment.d.ts' />

//let moment_format = 'DD/MM/YYYY';

let URL_ROOT = '';
let form_submit_count = 0;
let CMS_FORM_ID = 0;
let lists = [];
let ANIMATE_FLASH = 'animated flash card infinite';
//=============================================================
// Daterangepicker Plugin
/*let date_rangepicker_options = {
    singleDate: true,
    showShortcuts: false,
    autoClose: true,
    customArrowPrevSymbol: '<i class="fa fa-arrow-circle-left"></i>',
    customArrowNextSymbol: '<i class="fa fa-arrow-circle-right"></i>',
    singleMonth: true,
    monthSelect: true,
    yearSelect: true,
    format: 'ddd, MMM D, YYYY',
    //yearSelect: [1900, moment().get('year')]
    //startDate: '1900-01-01'
};*/

// noinspection JSDeprecatedSymbols
// noinspection JSCheckFunctionSignatures
// noinspection JSDeprecatedSymbols
// noinspection JSCheckFunctionSignatures
// noinspection JSDeprecatedSymbols
// noinspection JSCheckFunctionSignatures
// noinspection JSDeprecatedSymbols
$(document).ready(function () {
    let NAV_BAR_HEIGHT = $('.navbar-fixed').height();
    $('.content-wrapper').css('margin-top', NAV_BAR_HEIGHT + 'px');
    CMS_FORM_ID = $('#cms_form_id').val();
    URL_ROOT = $('#url_root').val();
    moment.modifyHolidays.add('Ghana');

    $('td.not-allowed').on('click', function () {
        let department = $(this).data('department');
        $.toast('You are not  allowed to respond to ' + department + ' Impact Assessment!');
    });

    $('.modal').on('shown.bs.modal', (e) => {

        let $this = $(e.currentTarget);
        $this.find('input:first').focus();
    });

    $(window).resize(function () {
        $('.content-wrapper').css('margin-top', $('.navbar-fixed').height() + 'px');
    });

    initList('active');
    initList('closed');
    initList('rejected');
    //$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);

    $('form').submit(function () {
        let form_is_valid = this.checkValidity();
        if (form_is_valid) {
            form_submit_count++;
            if (form_submit_count > 1) {
                return false;
            }
        }
    });
    //=============================================================
    // Datatables Plugin
    if (typeof $.fn.dataTable !== 'undefined') {
        $.extend(true, $.fn.dataTable.defaults, {
            responsive: true,
            processing: true,
            scrollY: 100,
            scrollX: false,
            deferRender: true,
            scroller: false,
            select: false,
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "language": {
                processing: true,
                "emptyTable": "No data is available ",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            },
            buttons: [
                {
                    extend: 'pdf',
                    text: 'Export to PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'excel',
                'print'
            ],
            "initComplete": function (settings, json) {
            },
            "drawCallback": function (settings) {
            }
        });
    }

    $('.bs-select')
        .selectpicker({
            liveSearch: true,
            virtualization: true,
            showTick: false,
            showContent: false
        })
        .on('loaded.bs.select show.bs.select', function () {
            $('.replace-multiple-select').remove();
            $('.multiple-hidden.bs-select').removeClass('d-none');
            $('.bs-select .dropdown-menu').addClass('p-0 rounded-0');
            $('.bs-select button').addClass('w3-hover-none rounded-0 w3-transparent w3-border');
            $('.bootstrap-select').addClass('exclude-hover');
            $('.bs-select').attr('tabindex', 1);
        });

    // '/cms-forms/add'
    $('#change_type').on('changed.bs.select', function () {
        if ($(this).has('option[value=Other]:selected').length) {
            $('#other_type').removeClass('d-none');
            $('[name=other_type]').attr('required', true);
            $('#add_cms_form').validator('update');
            $('#button_container').removeClass('col-sm-6').addClass('w-100');
        } else {
            $('#other_type').addClass('d-none');
            $('[name=other_type]').removeAttr('required');
            $('#add_cms_form').validator('update');
            $('#button_container').addClass('col-sm-6').removeClass('w-100');
        }
    });

    $('.section').on('shown.bs.collapse', function () {
        $(this).parent().find('.fa').eq(0).removeClass('fa-plus-circle').addClass('fa-minus-circle');
        resizeTables();
        return false;
    })
        .on('hidden.bs.collapse', function () {
            $(this).parent().find('.fa').eq(0).removeClass('fa-minus-circle').addClass('fa-plus-circle');
            return false;
        });

    // '/cms-forms/hod-assesment'
    $('[name=hod_approval]').on('change', function () {
        if ($(this).val() === "approved") {
            $('#hod_ref_num').removeClass('d-none');
            $('.gm.form-group').removeClass('d-none');
            $('[name=hod_ref_num], [name=gm_id]').attr('required', true);
            $('#hod_assessment_form').validator('update');
        } else {
            $('#hod_ref_num').addClass('d-none');
            $('.gm.form-group').addClass('d-none');
            $("[name=hod_ref_num], [name=gm_id]").attr('required', false);
            $('#hod_assessment_form').validator('update');
        }
    });

    // '/cms-forms/risk-assesment'
    //$('.impact_tbl').DataTable({searching: false, paging: false, info: false});

    // auto adjust dt columns
    $(window).resize(function () {
        setTimeout(function () {
            // body...
            resizeTables();
        }, 1000);
        kendo.resize($("#action_list").parent());
    });

    // fix column width for tables in collapse
    $('.hide-child').removeClass('show').trigger('hidden.bs.collapse');


    // '/cms-forms/action-list'
    let dataSource = new kendo.data.DataSource({
        pageSize: 5,
        transport: {
            read: function (options) {
                // make JSONP request to https://demos.telerik.com/kendo-ui/service/products
                $.ajax({
                    url: URL_ROOT + "/ActionLists/",
                    data: {cms_form_id: CMS_FORM_ID},
                    dataType: "jsonp", // "jsonp" is required for cross-domain requests; use "json" for same-domain requests
                    success: function (result) {
                        // notify the data source that the request succeeded
                        options.success(result.data);
                    },
                    error: function (result) {
                        // notify the data source that the request failed
                        options.error(result);
                    }
                });
            },
            update: function (options) {
                let cms_action_list_id = options.data.cms_action_list_id;
                $.ajax({
                    url: URL_ROOT + "/ActionLists/Update/" + cms_action_list_id,
                    dataType: "jsonp", // "jsonp" is required for cross-domain requests; use "json" for same-domain requests
                    // send the created data items as the "models" service parameter encoded in JSON
                    data: {
                        payload: kendo.stringify(options.data)
                    },
                    method: 'POST',
                    success: function (result) {
                        // notify the data source that the request succeeded
                        options.success(result.data);
                    },
                    error: function (result) {
                        // notify the data source that the request failed
                        options.error(result);
                    }
                });
            },
            destroy: function (options) {
                let cms_action_list_id = options.data.cms_action_list_id;
                $.ajax({
                    url: URL_ROOT + "/ActionLists/Destroy/" + cms_action_list_id,
                    dataType: "jsonp", // "jsonp" is required for cross-domain requests; use "json" for same-domain requests
                    // send the created data items as the "models" service parameter encoded in JSON
                    data: {
                        payload: kendo.stringify(options.data)
                    },
                    method: 'POST',
                    success: function (result) {
                        // notify the data source that the request succeeded
                        options.success(result.data);
                    },
                    error: function (result) {
                        // notify the data source that the request failed
                        options.error(result);
                    }
                });
            },
            create: function (options) {
                // make JSONP request to https://demos.telerik.com/kendo-ui/service/products/create
                options.data.cms_form_id = CMS_FORM_ID;
                $.ajax({
                    url: URL_ROOT + "/ActionLists/Create",
                    method: 'POST',
                    dataType: "jsonp", // "jsonp" is required for cross-domain requests; use "json" for same-domain requests
                    // send the created data items as the "models" service parameter encoded in JSON
                    data: {
                        payload: kendo.stringify(options.data)
                    },
                    success: function (result) {
                        // notify the data source that the request succeeded
                        options.success(result.data);
                    },
                    error: function (result) {
                        // notify the data source that the request failed
                        options.error(result);
                    }
                });
            },
            parameterMap: function (options, operation) {
                if (operation !== "read" && options.models) {
                    return {models: kendo.stringify(options.models)};
                }
            }
        },
        schema: {
            model: {
                id: "cms_action_list_id",
                fields: {
                    action: {
                        type: 'string',
                        validation: { //set validation rules
                            required: true
                        }
                    },
                    person_responsible: {
                        type: 'string',
                        validation: {
                            required: true
                        }
                    },
                    completed: {
                        type: 'boolean'
                    },
                    date: {
                        type: 'date'
                    },
                    cms_form_id: {
                        type: 'number'
                    },
                    cms_action_list_id: {
                        //this field will not be editable (default value is true)
                        type: 'number',
                        editable: false,
                        nullable: true
                    }
                }
            }
        }
    });
    $('#action_list').kendoGrid({
        mobile: true,
        noRecords: true,
        navigatable: true,
        toolbar: ["create"],
        editable: 'popup',
        filterable: true,
        columnMenu: true,
        sortable: true,
        groupable: true,
        height: 500,
        resizable: true,
        pageable: {
            alwaysVisible: false,
            pageSizes: [5, 10, 15, 20],
            buttonCount: 5
        },
        columns: [
            {
                field: 'action',
                title: 'Action to be Taken'
            },
            {
                field: 'person_responsible',
                title: 'Responsible Person'
            },
            {
                field: 'completed',
                title: 'Completed?',
                type: 'boolean',
                template: kendo.template("#= completed? 'Yes'   : 'No' #"),
                //editor: customBoolEditor
            },
            {
                field: 'date',
                title: 'Date',
                template: "#= dateTemplate(data.date) #"
            },
            {command: ["edit", "destroy"], title: "&nbsp;", width: "220px"}
        ],
        dataSource: dataSource,
        dataBinding: function () {
            //let no = (this.dataSource.page() - 1) * this.dataSource.pageSize();
        }
    });

    $('#action-list-read-only').kendoGrid({
        mobile: true,
        navigatable: true,
        filterable: true,
        columnMenu: true,
        sortable: true,
        noRecords: true,
        height: 500,
        resizable: true,
        pageable: {
            alwaysVisible: false,
            pageSizes: [5, 10, 15, 20],
            buttonCount: 5
        },
        columns: [
            {
                field: 'action',
                title: 'Action to be Taken'
            },
            {
                field: 'person_responsible',
                title: 'Responsible Person'
            },
            {
                field: 'completed',
                title: 'Completed?',
                type: 'boolean',
                template: kendo.template("#= completed? 'Yes'   : 'No' #"),
                //editor: customBoolEditor
            },
            {
                field: 'date',
                title: 'Date',
                template: "#= dateTemplate(data.date) #"
            },
        ],
        dataSource: dataSource
    });

    // '/cms-forms/pl-closure'

    $('.dataTables_length').addClass('d-inline-block mx-3');
    //proxyEmail();
    $('.bs-searchbox >input').attr('data-validate', false);

    /*  setTimeout(()=>{
          $('.box-header').toggleClass(ANIMATE_FLASH, false);
      }, 5000)*/
});

window.addEventListener("load", function () {
    setTimeout(() => {
        $('.content').removeClass('d-none invisible');
        $('footer').removeClass('d-none');
        setTimeout(function () {
            $.unblockUI();
            $(`.blockable`).unblock({message: null});
            $('body').scrollTo('.box', 1000, {offset: -150})
                .scrollTo('#box', 1000, {offset: -150});
        }, 1000);
    }, 500);

    let prevScrollpos = window.pageYOffset;
    $(document).on('click', '.add-input', addFormGroup);
    $(document).on('click', '.remove-input', removeFormGroup);
    $(document).on('show.bs.modal', '#stopProcess', (e) => {
        let href = $(e.relatedTarget).attr('data-href');
        $('#stopProcess .btn-primary').attr('data-href', href);
    });
    $(document).on('click', '#stopProcess .btn-primary', stopChangeProcess);

    window.onscroll = function () {
        let navbar = $('.navbar-fixed');
        let currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            navbar.prop('style').top = "0";
        } else {
            navbar.prop('style').top = "-60px";
        }
        prevScrollpos = currentScrollPos;
    };
    console.log("All resources finished loading!");
});

/*function isOffDay(date) {
    return bizniz.isWeekendDay(date);
}

function getWeekendDays(startMoment, endMoment) {
    startMoment.toDate();
    endMoment.toDate();
    return Math.abs(bizniz.default.weekendDaysBetween(s, e));
}

function getWeekDays(startMoment, endMoment) {
    startMoment.toDate();
    endMoment.toDate();
    return Math.abs(bizniz.default.weekDaysBetween(s, e));
}

function proxyEmail() {
    $.get(URL_ROOT + "/helpers/proxymail", {name: "value"},
        function (data, textStatus) {
            console.log(textStatus);
        }
    );
}

function getUrlParam(parameter, defaultvalue) {
    let url_parameter = defaultvalue;
    if (window.location.href.indexOf(parameter) > -1) url_parameter = getUrlVars()[parameter];
    return url_parameter;
}

function getUrlVars() {
    let vars = {};
    window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    return vars;
}

function nextWeekDay(moment_date) {
    return moment(moment_date.toDate(), moment_format).weekday(8);
}

function nextWorkingDay(moment_start_date) {
    /!*do {
        bizniz.default.addWeekDays(moment_day.toDate(), 1);
    } while (!moment_day.isHoliday());*!/
    return moment(moment_start_date.toDate(), moment_format);
}

function getDays(moment_start_date, moment_resume_date) {
    let holidays = moment_start_date.holidaysBetween(moment_resume_date);
    let holiday_count = holidays ? holidays.length : 0;
    let days_applied_for = moment_start_date.businessDiff(moment_resume_date);
    return {
        'holiday_count': holiday_count,
        'days_applied_for': days_applied_for
    }
}*/

/*function capitalize(s) {
    if (typeof s !== 'string') return '';
    return s.split(/[\s,-.]+/).map(function (line) {
        line = line[0].toUpperCase() + line.substr(1);
        return line;
    }).join(" ");
}*/

function resizeTables() {
    if (typeof $.fn.dataTable === 'undefined') {
        return
    }
    $.fn.dataTable.tables({visible: true, api: true})
        .columns.adjust();
}

/*
function customBoolEditor(container, options) {
    let guid = kendo.guid();
    $('<input class="k-checkbox" id="' + guid + '" type="checkbox" name="completed" data-type="boolean" data-bind="checked:checkedCompleted">').appendTo(container);
    $('<label class="k-checkbox-label" for="' + guid + '">&#8203;</label>').appendTo(container);
    /!*if (options.model.checkedCompleted) {
        options.model.completed = 1;
    } else {
        options.model.completed = 0;
    }
}*/


function dateTemplate(date) {
    let m = new moment(date);
    return m.isValid() ? m.format("ddd, MMM D YYYY") : '';
    //return m.isValid() ? (m.calendar().split(" at"))[0] : '';
}

function initList(id) {
    let options = {
        valueNames: ['ref_num', 'originator', 'date', 'change_type'],
        searchClass: 'search',
        item: `<div class="col-sm-5 mx-sm-5">
        <dl>
            <dt></dt><dd class="ref_num"></dd>
            <dt></dt><dd class="originator"></dd>
            <dt></dt><dd class="date"></dd>
            <dt></dt><dd class="change_type"></dd>
            <dt></dt><dd></dd>
        </dl>
        </div>`
    };

    lists['list_' + id] = new List('list_container_' + id, options);
}

function searchList(element) {
    let $this = $(element);
    let list = lists[$this.attr('data-list-id')];
    let keyword = $this.val();
    list.search(keyword);
}

let addFormGroup = function () {
    let $inputGroup = $(this).closest('.input-group');
    let $multipleFormGroup = $inputGroup.closest('.multiple-form-group');
    let $lastInputGroupLast = $multipleFormGroup.find('.input-group:last');

    if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
        $lastInputGroupLast.find('.add-input').addClass('cursor-disabled');
        $.toast('You can only add up to three files!');
        return;
    }
    let $inputGroupClone = $inputGroup.clone();
    $(this)
        .toggleClass('add-input remove-input')
        .html('<i class="fas fa-minus-square text-danger"></i>');
    $inputGroup.addClass('mb-1');
    $inputGroupClone.find('input').val('');
    $inputGroupClone.insertAfter($inputGroup);
    $('form[data-toggle=validator]').validator('update')

};

let removeFormGroup = function () {
    let $formGroup = $(this).closest('.input-group');
    let $multipleFormGroup = $formGroup.closest('.multiple-form-group');

    let $lastFormGroupLast = $multipleFormGroup.find('.input-group:last');
    if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
        $lastFormGroupLast.find('.add-input').removeClass('cursor-disabled');
    }
    $formGroup.remove();
    $('form[data-toggle=validator]').validator('update')
};

let countFormGroup = function ($form) {
    return $form.find('.input-group').length;
};

let stopChangeProcess = function (e) {
    let redirect = window.location.href;
    window.location.href = $(this).attr('data-href') + '?redirect=' + redirect;
};
