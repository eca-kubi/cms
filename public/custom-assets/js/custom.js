/// <reference path='../../assets/ts/kendo.all.d.ts' />
var datepicker_shown = 0;
var moment_format = 'DD/MM/YYYY';
var URL_ROOT = '';
//=============================================================
// Daterangepicker Plugin
var date_rangepicker_options = {
    singleDate: true,
    showShortcuts: false,
    autoClose: true,
    customArrowPrevSymbol: '<i class="fa fa-arrow-circle-left"></i>',
    customArrowNextSymbol: '<i class="fa fa-arrow-circle-right"></i>',
    singleMonth: true,
    monthSelect: true,
    yearSelect: true,
    format: 'ddd, MMM D, YYYY',
    yearSelect: [1900, moment().get('year')]
    //startDate: '1900-01-01'
};

$( function ()
{
    $( '.content-wrapper' ).css( 'margin-top', $( '.navbar-fixed' ).height() + 'px' );
    URL_ROOT = $( '#url_root' ).val();
    moment.modifyHolidays.add( 'Ghana' );

    $( window ).resize( function ()
    {
        $( '.content-wrapper' ).css( 'margin-top', $( '.navbar-fixed' ).height() + 'px' );
    } );

    //=============================================================
    // Datatables Plugin
    if ( typeof $.fn.dataTable !== 'undefined' )
    {
        $.extend( true, $.fn.dataTable.defaults, {
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
            "initComplete": function ( settings, json )
            {
            },
            "drawCallback": function ( settings )
            {
            }
        } );
    }

    $( '.bs-select' )
        .selectpicker( {
            liveSearch: true,
            virtualization: true,
            showTick: false,
            showContent: false
        } )
        .on( 'loaded.bs.select show.bs.select', function ( e, clickedIndex, isSelected, previousValue )
        {
            $( '.bs-select .dropdown-menu' ).addClass( 'p-0 rounded-0' );
            $( '.bs-select button' ).addClass( 'w3-hover-none rounded-0 w3-transparent w3-border' );
            $( '.bootstrap-select' ).addClass( 'exclude-hover' );
            $( '.bs-select' ).attr( 'tabindex', 1 );
        } );

    // '/cms-forms/add'
    $( '#change_type' ).on( 'changed.bs.select', function ( e, clickedIndex, isSelected, previousValue )
    {
        var selected_option = $( this ).find( ':selected' );
        var found = previousValue.find( function ( element )
        {
            return element == 'Other';
        } );
        if ( isSelected && clickedIndex == 8 || ( isSelected && found ) )
        {
            $( '#other_type' ).parents( '.row:eq(0)' ).removeClass( 'd-none' )
            $( '[name=other_type]' ).attr( 'required', true );
            $( '#add_cms_form' ).validator( 'update' );
        }
        else
        {
            $( '#other_type' ).parents( '.row:eq(0)' ).addClass( 'd-none' )
            $( '[name=other_type]' ).removeAttr( 'required');
            $( '#add_cms_form' ).validator( 'update' );
        }
    } );

    $( '.section' ).on( 'shown.bs.collapse', function ( e )
    {
        $( this ).parent().find( '.fa' ).eq( 0 ).removeClass( 'fa-plus' ).addClass( 'fa-minus' )
        resizeTables();
        return false;
    } )
        .on( 'hidden.bs.collapse', function ( e )
        {
            $( this ).parent().find( '.fa' ).eq( 0 ).removeClass( 'fa-minus' ).addClass( 'fa-plus' )
            return false;
        } );

    // '/cms-forms/hod-assesment'
    $( '[name=hod_approval]' ).on( 'change', function ( e )
    {
        if ( $( this ).val() == 'approved' )
        {
            $( '#ref_num' ).removeClass( 'd-none' )
        }
        else
        {
            $( '#hod_ref_num' ).addClass( 'd-none' )
        }
    } );

    // '/cms-forms/risk-assesment'
    $( '.impact_tbl' ).DataTable( { searching: false, paging: false, info: false } );

    // auto adjust dt columns
    $( window ).resize( function ()
    {
        setTimeout( function ()
        {
            // body...
            resizeTables();
        }, 1000 );
        kendo.resize( $( "#action_list" ).parent() );
    } );

    // fix column width for tables in collapse
    $( '.hide-child' ).removeClass( 'show' ).trigger( 'hidden.bs.collapse' )

    // '/cms-forms/action-list'
    $( '#action_list' ).kendoGrid( {
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
                field: 'res_person',
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
    } );

    // '/cms-forms/pl-closure'

    $( '.dataTables_length' ).addClass( 'd-inline-block mx-3' );
    proxyEmail();
} );

window.addEventListener("load", function (event) {
    setTimeout(() => {
        $('.content').removeClass('d-none invisible')
        $('footer').removeClass('d-none');
        setTimeout(function () {
            $('body').scrollTo('.box', 1000, { offset: -150 });
            $('body').scrollTo('#box', 1000, { offset: -150 });
        }, 1000);
    }, 500);

    console.log("All resources finished loading!");
});

function isOffDay(date) {
    return bizniz.isWeekendDay(date);
}

function getWeekendDays(startMoment, endMoment) {
    s = startMoment.toDate();
    e = endMoment.toDate();
    return Math.abs(bizniz.default.weekendDaysBetween(s, e));
}

function getWeekDays(startMoment, endMoment) {
    s = startMoment.toDate();
    e = endMoment.toDate();
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
    $.get(URL_ROOT + "/helpers/proxymail", { name: "value" },
        function (data, textStatus, jqXHR) {
            console.log(textStatus);
        }
    );
}

function getUrlParam(parameter, defaultvalue) {
    var urlparameter = defaultvalue;
    if (window.location.href.indexOf(parameter) > -1) {
        urlparameter = getUrlVars()[parameter];
    }
    return urlparameter;
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    return vars;
}


function nextWeekDay(moment_date) {
    return moment(moment_date.toDate(), moment_format).weekday(8);
}

function nextWorkingDay(moment_start_date) {
    var moment_day = moment(moment_start_date.toDate(), moment_format);
    /*do {
        bizniz.default.addWeekDays(moment_day.toDate(), 1);
    } while (!moment_day.isHoliday());*/
    return moment_day;
}

function getDays(moment_start_date, moment_resume_date) {
    var holidays = moment_start_date.holidaysBetween(moment_resume_date);
    var holiday_count = holidays ? holidays.length : 0;
    var days_applied_for = moment_start_date.businessDiff(moment_resume_date)
    return {
        'holiday_count' : holiday_count,
        'days_applied_for': days_applied_for
    }
}

function resizeTables() {
    $.fn.dataTable
        .tables({ visible: true, api: true})
        .columns.adjust();
}