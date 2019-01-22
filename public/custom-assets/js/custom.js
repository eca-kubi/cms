/// <reference path='../../assets/ts/kendo.all.d.ts' />

let moment_format = 'DD/MM/YYYY';
let URL_ROOT = '';
let form_submit_count = 0;
//=============================================================
// Daterangepicker Plugin
let date_rangepicker_options = {
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
};

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
    $('#change_type').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        let found;
        found = previousValue ? previousValue.find(function (element) {
            return element === 'Other';
        }) : '';
        if (isSelected && clickedIndex === 8 || (isSelected && found)) {
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
        $(this).parent().find('.fa').eq(0).removeClass('fa-plus').addClass('fa-minus');
        resizeTables();
        return false;
    })
        .on('hidden.bs.collapse', function () {
            $(this).parent().find('.fa').eq(0).removeClass('fa-minus').addClass('fa-plus');
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
    $('#action_list').kendoGrid({
        columns: [
            {
                field: 'no',
                title: 'No.'
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
                field: 'date',
                title: 'Date'
            },
            {
                field: 'completed',
                title: 'Completed?',
                type: 'boolean'
            },
            {
                command: "destroy"
            }
        ],
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

function isOffDay(date) {
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

function capitalize(s) {
    if (typeof s !== 'string') return '';
    return s.split(/[\s,-.]+/).map(function (line) {
        line = line[0].toUpperCase() + line.substr(1);
        return line;
    }).join(" ");
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
    /*do {
        bizniz.default.addWeekDays(moment_day.toDate(), 1);
    } while (!moment_day.isHoliday());*/
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
}

function resizeTables() {
    if (typeof $.fn.dataTable === 'undefined') {
        return
    }
    $.fn.dataTable
        .tables({visible: true, api: true})
        .columns.adjust();
}