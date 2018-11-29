$(function () {
  $('.bs-select')
    .addClass('exclude-hover ')
    .on('loaded.bs.select show.bs.select', function (e, clickedIndex, isSelected, previousValue) {
      $('.bs-select .dropdown-menu').addClass('p-0 rounded-0');
      $('.bs-select button').addClass('w3-hover-none rounded-0 w3-transparent w3-border');
      //$('.bootstrap-select .dropdown-menu li a').addClass('bg-gray-active');
    });


  /* $('body').on('mouseenter', '.bs-select a.dropdown-item', function () {
    $this =  $(this)
    $(this).parent().siblings().children('a.dropdown-item').removeClass('active')
    $this.addClass('active active-added-on-mousenter')
  })
  .on('mouseleave', '.bs-select a.dropdown-item', function () {
    $this =  $(this)
    if ($this.hasClass('active-added-on-mousenter')) {
      $this.removeClass('active active-added-on-mousenter')
    } 
    $(this).parent().siblings().children('a.dropdown-item').removeClass('active')
  }); */
});