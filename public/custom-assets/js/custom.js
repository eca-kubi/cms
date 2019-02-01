/// <reference path='../../assets/ts/kendo.all.d.ts' />
/// <reference path='../../assets/typescript/moment.d.ts' />

//let moment_format = 'DD/MM/YYYY';

let URL_ROOT = '';
let form_submit_count = 0;
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
    $('.content-wrapper').css('margin-top', $('.navbar-fixed').height() + 'px');
    URL_ROOT = $('#url_root').val();
    moment.modifyHolidays.add('Ghana');

    $('td.not-allowed').on('click', function () {
        let department = $(this).data('department');
        $.toast('You are not  allowed to respond to ' + department + ' Impact Assessment!');
    });

    $(window).resize(function () {
        $('.content-wrapper').css('margin-top', $('.navbar-fixed').height() + 'px');
    });
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
        transport: {
            read: {
                url: URL_ROOT + "/ActionLists/index/" + $('#cms_form_id').val(),
                dataType: "json"
            },
            update: {
                url: "/ActionLists/Update",
                type: "POST",
                dataType: "json"
            },
            destroy: {
                url: "/ActionLists/Destroy",
                type: "POST"
            },
            create: {
                url: "/ActionLists/Create",
                type: "POST"
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
                    no: {
                        editable: false,
                    },
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
        navigatable: true,
        columns: [
            {
                field: 'no',
                title: 'No.',
                editable: false,
            },
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
                template: kendo.template("#= dateTemplate(data.date) #")
            },
            {
                command: "destroy"
            }
        ],
        dataSource: dataSource,
        dataBinding: function () {
            //let no = (this.dataSource.page() - 1) * this.dataSource.pageSize();
        },
        toolbar: ["create", "save", "cancel"],
        editable: true
    });

    // '/cms-forms/pl-closure'

    $('.dataTables_length').addClass('d-inline-block mx-3');
    //proxyEmail();
    $('.bs-searchbox >input').attr('data-validate', false);
});

window.addEventListener("load", function () {
    setTimeout(() => {
        $('.content').removeClass('d-none invisible');
        $('footer').removeClass('d-none');

        setTimeout(function () {
            $.unblockUI();
            $('.blockable').unblock({message: null});
            $('body').scrollTo('.box', 1000, {offset: -150})
                .scrollTo('#box', 1000, {offset: -150});
        }, 1000);
    }, 500);

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
    let m = moment(date);
    m = moment(m.format("DD-MM-YYYY"), "DD-MM-YYYY");
    return m.isValid() ? (m.calendar().split(" at"))[0] : '';
}
