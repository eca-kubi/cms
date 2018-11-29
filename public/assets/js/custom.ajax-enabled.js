var nn = `<?php header("Content-Type: text/javascript"); ?>`;
//import bz from './bizniz.js';
//import biz from './bizniz';
var staff_table;
var department_table;
var leave_table;
var leavetransaction_table;
var leaveentitlement_table;
var leaveapplicants_table;
var singledate_picker;
var datepicker_shown = 0;
var form;
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
  yearSelect: [1900, moment().get('year')],
  startDate: '1900-01-01'
};

$(
  function () {
    domReady();
    ajaxLoad();
  }

);

ajaxLoad = function () {
  $('body').on('click', 'a.ajax-link', function () {
    var controller = $(this).attr('data-controller');
    loadPageAjax(controller);

    // $('.navbar-2').load("/sms/leaves/book #navbar2", "", function (response, status, request) {
    //   this; // dom element
    //   console.log('navbar2 loaded');
    // });
  });
}

loadPageAjax = function (url) {
  $.get({
    url: url,
    type: 'get',
    dataType: 'html',
    contentType: 'text/plain; charset=UTF-8',
    crossDomain: true,
    success: function (response, status, request) {
      maincontent = $('#maincontent');
      if (maincontent.length == 0) {
        $('<div id="maincontent">').insertBefore('.content-wrapper');
        maincontent = $('#maincontent');
      }
      $('.content-wrapper').detach();
      content = $(response).find('.content-wrapper');
      content.find('.btn-box-tool').click(boxToggle);
      maincontent.empty();
      maincontent.html(content);

      domReady();

      $('.workdays').multiselect({
        includeSelectAllOption: false,
        enableClickableOptGroups: true,
        //buttonWidth: '100%',
        maxHeight: 250,
        numberDisplayed: 7,
        allSelectedText: false
      });

      $('.multiselect-container').addClass('text-nowrap');

      $('#leavetype_table').DataTable({
        autoWidth: true,
        // columnDefs: [
        //   {
        //     "width": "10%", "targets": 0,
        //     "width": "35%", "targets": 1,
        //     "width": "30%", "targets": 2,
        //     "width": "15%", "targets": 3,
        //     "width": "10%", "targets": 4
        //   }
        // ],
        "createdRow": function (row, data, index) {
          $(row).addClass('font-bold text-capitalize');
        }
      })
        .on('click', 'tr', function () {
          $this = $(this);
          sibling = $this.siblings('.w3-gray');
          sibling.removeClass('w3-gray');
          $this.removeClass('w3-hover-light-gray');
          $this.addClass('w3-gray');
        })
        .on('mouseenter', 'tr', function () {
          $this = $(this);
          if (!$this.hasClass('w3-gray')) {
            $this.addClass('w3-hover-light-gray');
          }
        })
        .on('dblclick', 'tr.ajax-link', function () {
          var controller = $(this).attr('data-controller');
          loadPageAjax(controller);
        });
    }
  });

  /*  $.get(`${controller}`, function (response, status, request) {
     maincontent = $('#maincontent');
     if (maincontent.length == 0) {
       $('<div id="maincontent">').insertBefore('.content-wrapper');
       maincontent = $('#maincontent');
     }
     $('.content-wrapper').detach();
     content = $(response).find('.content-wrapper');
     content.find('.btn-box-tool').click(boxToggle);
     maincontent.empty();
     maincontent.html(content);
 
     domReady();
 
     $('.workdays').multiselect({
       includeSelectAllOption: false,
       enableClickableOptGroups: true,
       //buttonWidth: '100%',
       maxHeight: 250,
       numberDisplayed: 7,
       allSelectedText: false
     });
 
     $('.multiselect-container').addClass('text-nowrap');
 
     $('#leavetype_table').DataTable({
       autoWidth: true,
       // columnDefs: [
       //   {
       //     "width": "10%", "targets": 0,
       //     "width": "35%", "targets": 1,
       //     "width": "30%", "targets": 2,
       //     "width": "15%", "targets": 3,
       //     "width": "10%", "targets": 4
       //   }
       // ],
       "createdRow": function (row, data, index) {
         $(row).addClass('font-bold text-capitalize');
       }
     })
       .on('click', 'tr', function () {
         $this = $(this);
         sibling = $this.siblings('.w3-gray');
         sibling.removeClass('w3-gray');
         $this.removeClass('w3-hover-light-gray');
         $this.addClass('w3-gray');
       })
       .on('mouseenter', 'tr', function () {
         $this = $(this);
         if (!$this.hasClass('w3-gray')) {
           $this.addClass('w3-hover-light-gray');
         }
       })
       .on('dblclick', 'tr.ajax-link', function () {
         var controller = $(this).attr('data-controller');
         loadPageAjax(controller);
       });
   }); */
}

domReady = function () {
  var export_to_pdf_function;
  var start_page_login_box = $('#start_page_login_box');
  var start_page_login_box_toggle_btn = $('[data-toggle="start_page_login_box"]');
  var form_page_1 = $('.form-page-1');
  var form_page_2 = $('.form-page-2');
  var form_page_1_errors = $('.form-page-1').find('.has-error');
  var form_page_2_errors = $('.form-page-2').find('.has-error');
  var form_page_1_target = $('a[data-target="form_page_1"]');
  var form_page_2_target = $('a[data-target="form_page_2"]');
  singledate_picker = $('input.singledate-picker');
  //=============================================================
  // Submit Events
  form = $('form[data-toggle=validator]').validator({ delay: '100000000' }).on('submit', function (e) {
    if (e.isDefaultPrevented()) {
      var form_page_1_errors = form_page_1.find('.has-error');
      var form_page_2_errors = form_page_2.find('.has-error');
      $('.with-errors').css('display', 'block');
      if (form_page_1_errors.length > 0) {
        form_page_1_target.click();
        var form_control = $(form_page_1_errors.get(0)).find('.form-control');
        var select2_container = $(form_page_1_errors.get(0)).find('.select2-container');
        form_control.focus().addClass('animated bounce');
        select2_container.focus().addClass('animated bounce');
        setTimeout(() => {
          form_control.removeClass('animated bounce');
          select2_container.removeClass('animated bounce');
        }, 3000);
      }
      return false;
    } else {
      $('.with-errors').css('display', 'none');
    }
  });

  $('#start_page_login_form').validator().on('submit', function (e) {
    if (e.isDefaultPrevented()) {
      return false;
    }
  });


  //=============================================================
  // Click Events
  form_page_1_target.on('click', function (e) {
    form_page_1.removeClass('d-none');
    $(this).parent('.page-item').addClass('active');
    form_page_2.addClass('d-none');
    form_page_2_target.parent('.page-item').removeClass('active');
    return false;
  });
  form_page_2_target.on('click', function (e) {
    form_page_2.removeClass('d-none');
    $(this).parent('.page-item').addClass('active');
    form_page_1.addClass('d-none');
    form_page_1_target.parent('.page-item').removeClass('active');
    return false;
  });

  start_page_login_box_toggle_btn.on('click', function () {
    $('body').scrollTo('#start_page_login_box', 1000, { offset: -120 });
  });

  $('[data-target="#start_page_login_box"]').on('click', function (e) {
    if (start_page_login_box.hasClass('d-none')) {
      start_page_login_box.removeClass('d-none');
      $('body').scrollTo('#start_page_login_box', 1000, { offset: -120 });
      return false;
    }
    if (start_page_login_box_toggle_btn.has('i.fa-plus').length > 0) {
      start_page_login_box_toggle_btn.click();
      $('body').scrollTo('#start_page_login_box', 1000, { offset: -120 });
    }
    e.preventDefault();
  });

  //=============================================================
  // Bind Events
  $(document).on('mouseover', 'td.action', function (e) {
    $(this.firstElementChild).css('display', 'inline-block');
    $(this).find('span').css('display', 'none');
  });

  $(document).on('mouseleave', 'td.action', function (e) {
    $(this.firstElementChild).css('display', 'none');
    $(this).find('span').css('display', 'block');
  });
  // select event
  $('#department').on('select', function () {
    $('#staff_manager').val($('#department option:selected').attr('data-manager'));
  })
    .select();

  //=============================================================
  // Datatables Plugin
  $.extend(true, $.fn.dataTable.defaults, {
    processing: true,
    scrollY: 300,
    scrollX: false,
    deferRender: true,
    scroller: true,
    select: false,
    "dom": 'Blrftip',
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
      //$('#table_container').addClass('animated pulse');
    },
    "drawCallback": function (settings) {
      this.api().table().columns.adjust();
    }
  });
  staff_table = $('#staff_table').DataTable({
    autoWidth: true,
    columnDefs: [
      {
        "width": "10%", "targets": 0,
        "width": "35%", "targets": 1,
        "width": "30%", "targets": 2,
        "width": "15%", "targets": 3,
        "width": "10%", "targets": 4
      }
    ],
    "createdRow": function (row, data, index) {
      $(row).addClass('font-bold text-capitalize');
    }
  });

  export_to_pdf_function = staff_table.button(0).action();
  staff_table.button(0).action(function (e, dt, button, config) {
    var newfunction = export_to_pdf_function.bind(this, e, dt, button, config);
    staff_table.column(2).visible(0);
    newfunction();
    staff_table.column(2).visible(1);
    // export_to_pdf_function.call(this,{e:e,dt:dt, button:button, config:config});
  });

  department_table = $('#department_table').DataTable({
    autoWidth: true,
    columnDefs: [
      {
        "width": "50%", "targets": 1,
        "width": "50%", "targets": 1,
        "width": "50%", "targets": 1
      }
    ],
    "createdRow": function (row, data, index) {
      $(row).addClass('font-bold text-capitalize');
    }
  });

  leave_table = $('#leave_table').DataTable({
    autoWidth: true,
    columnDefs: [
      {
        "width": "10%", "targets": 0,
        "width": "30%", "targets": 1,
        "width": "20%", "targets": 2,
        "width": "20%", "targets": 3,
        "width": "20%", "targets": 4
      }
    ],
    "createdRow": function (row, data, index) {
      $(row).addClass('font-bold text-capitalize');
    }
  });

  leavetransaction_table = $('#leavetransaction_table').DataTable({
    autoWidth: true,
    scroller: true,
    scrollY: 150,
    "dom": 'rtip',
    buttons: [
      {
        text: '<a title="New leave transaction" href="#newleavetransaction" data-target="#leavetransaction_modal" data-toggle="modal"><i class="fa fa-plus"></i></a>',
        className: 'd-inline',
        action: function (e, dt, node, config) {
          //alert('Button activated');
        }
      },
    ],
    // columnDefs: [
    //   {
    //     "width": "10%", "targets": 0,
    //     "width": "35%", "targets": 1,
    //     "width": "30%", "targets": 2,
    //     "width": "15%", "targets": 3,
    //     "width": "10%", "targets": 4
    //   }
    // ],
    "createdRow": function (row, data, index) {
      $(row).addClass('font-bold text-capitalize');
    }
  }).on('responsive-resize.dt', function (e, api, columns) {
    api.table().columns.adjust();
  });

  leaveentitlement_table = $('#leaveentitlement_table').DataTable({
    autoWidth: true,
    scroller: true,
    scrollY: 150,
    "dom": 'rtip',
    buttons: [
      {
        text: '<a title="New leave entitlement" href="#newleaveentitlement" data-target="#leaveentitlement_modal" data-toggle="modal"><i class="fa fa-plus"></i></a>',
        action: function (e, dt, node, config) {
          //alert('Button activated');
        }
      },
    ],
    // columnDefs: [
    //   {
    //     "width": "10%", "targets": 0,
    //     "width": "35%", "targets": 1,
    //     "width": "30%", "targets": 2,
    //     "width": "15%", "targets": 3,
    //     "width": "10%", "targets": 4
    //   }
    // ],
    "createdRow": function (row, data, index) {
      $(row).addClass('font-bold text-capitalize');
    }
  })

  leaveapplicants_table = $('#leaveapplicants_table').DataTable({
    autoWidth: true,
    "createdRow": function (row, data, index) {
      $(row).addClass('font-bold text-capitalize');
    },
    columnDefs: [
      {
        "width": "5%", "responsivePriority": 1, "targets": 0,
        "width": "10%", "targets": 1,
        "width": "30%", "responsivePriority": 1, "targets": 2,
        "width": "10%", "targets": 3,
        "width": "10%", "targets": 4,
        "width": "20%", "targets": 5,
        "width": "15%", "targets": 6
      }
    ],
  });

  // misc

  if (form_page_1_errors.length > 0) {
    form_page_1_target.click();
    $(form_page_1_errors.get(0)).find('.form-control').focus();
  } else if (form_page_2_errors.length > 0) {
    form_page_2_target.click();
    $(form_page_2_errors.get(0)).find('.form-control').focus();
  }

  $('.dataTables_length').addClass('d-inline-block mx-3');

  Pace.on('done', function (param) {
    $('.footer').removeClass('d-none');
  });

  // select2 init
  $('.select2').select2({
    minimumResultsForSearch: 20
  });

  $('.select2-container').addClass('p-0 col');

  // bootstrap select
  $('.bs-select').selectpicker();

  $('.bs-select[name="leave_entitlement"]').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
    e.currentTarget;
  })
    .on('loaded.bs.select', function (e, clickedIndex, isSelected, previousValue) {
      e.currentTarget;
    });
  /*   $('[name=leavetype]').inputpicker({
      data: [
        { type: 'Annual', payable: 'yes', unit: 'Days' }
      ],
      fields: [
        { name: 'type', text: 'Type' },
        { name: 'payable', text: 'Paid Leave?' },
        { name: 'unit', text: 'Unit' }
      ],
      fieldText: 'type',
      fieldValue: 'type',
      autoOpen: true,
      headShow: true,
      width: '100%'
    });
    $('[name=leaveentitlement]').inputpicker({
      data: [
        { type: 'Annual', balance: '15days', expires: `<?php echo (new \DateTime)->format('Y/n/j'); ?>` }
      ],
      fields: [
        { name: 'type', text: 'Type' },
        { name: 'balance', text: 'Balance' },
        { name: 'expires', text: 'Expires' }
      ],
      fieldText: 'type',
      fieldValue: 'type',
      autoOpen: true,
      headShow: true,
      width: '100%'
    }); */



  $('#js-example-basic-hide-search-multi').select2();

  $('#js-example-basic-hide-search-multi').on('select2:opening select2:closing', function (event) {
    var $searchfield = $(this).parent().find('.select2-search__field');
    $searchfield.prop('disabled', true);
  });

  // overide title attribute
  $('.select2-selection__rendered').hover(function () {
    $(this).attr('title', $(this).parent().attr('title'));
  });
  //If you are also dynamically adding select2 fields don't forget always to execute this code before above one:
  //This code will first remove on hover listener on all select2 fields.
  //$('.select2-selection__rendered').unbind('mouseenter mouseleave');

  /* $('#leave_type').on('change', function () {
    if (!$("#leave_type option:selected").hasClass('bereavement')) {
      $('#relationship').attr('placeholder', 'Relationship with Deceased (N/A)')
        .attr('disabled', true)
        .removeAttr('required');
      //form.validator('update');
    } else {
      $('#relationship').attr('placeholder', 'Relationship with Deceased')
        .removeAttr('disabled')
        .attr('required', true);
      //form.validator('update');
    }

  }).change(); */

  moment.modifyHolidays.add('Ghana');

  // $('body').on('mouseenter mouseleave', '.dropdown', function (e)
  // {
  //   var dropdown = $(e.target).closest('.dropdown');
  //   var menu = $('.dropdown-menu', dropdown);
  //   dropdown.addClass('show');
  //   menu.addClass('show');
  //   setTimeout(function ()
  //   {
  //     dropdown[dropdown.is(':hover') ? 'addClass' : 'removeClass']('show');
  //     menu[dropdown.is(':hover') ? 'addClass' : 'removeClass']('show');
  //   }, 300);
  // });

  // $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  //   if (!$(this).next().hasClass('show')) {
  //     $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
  //   }
  //   var $subMenu = $(this).next(".dropdown-menu");
  //   $subMenu.toggleClass('show');


  //   $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
  //     $('.dropdown-submenu .show').removeClass("show");
  //   });

  //   return false;
  // });


}

boxToggle = function () {
  boxbody = $(this).parents('.box').find('.box-body');
  boxfooter = $(this).parents('.box').find('.box-footer');
  if (boxbody.css('display') == 'none') {
    boxbody.slideDown();
    boxfooter.css('display', 'block')
  } else {
    boxbody.slideUp();
    boxfooter.css('display', 'none');
  }
}

/* function isOffDay(date, workday_scheme = window.workday_scheme) {
  return workday_scheme[date.getDay()] == 0;
} */

function isOffDay(date) {
  return bizniz.default.isWeekendDay(date);
}

function getWeekendDays(startMoment, endMoment) {
  /* s = startMoment.getDate().toISOString().replace(/T.+/, '');
  e = endMoment.getDate().toISOString().replace(/T.+/, '');
  return Math.abs(bizniz.weekendDays(s, e)); */
  s = startMoment.toDate();
  e = endMoment.toDate();
  return Math.abs(bizniz.default.weekendDaysBetween(s, e));
}

function getWeekDays(startMoment, endMoment) {
  /* s = moment(startMoment.toDate().toISOString().replace(/T.+/, ''));
  e = moment(endMoment.toDate().toISOString().replace(/T.+/, ''));
  return Math.abs(bizniz.weekDays(s, e)); */
  s = startMoment.toDate();
  e = endMoment.toDate();
  return Math.abs(bizniz.default.weekDaysBetween(s, e));
}