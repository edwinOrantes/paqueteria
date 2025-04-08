(function($) {
  'use strict';

  toastr.options =
  {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "2000",

  }

  $("#toast-success").on("click", function(){
    toastr.remove();
    toastr.options.positionClass = "toast-top-left";
    toastr.success('This is a Success Toast', 'lorem ipsum asit');
  });
  $("#toast-danger").on("click", function(){
    toastr.remove();
    toastr.options.positionClass = "toast-top-right";
    toastr.error('This is a Danger Toast', 'lorem ipsum asit');
  });
  $("#toast-warning").on("click", function(){
    toastr.remove();
    toastr.options.positionClass = "toast-bottom-left";
    toastr.warning('This is a Warning Toast', 'lorem ipsum asit');
  });
  $("#toast-info").on("click", function(){
    toastr.remove();
    toastr.options.positionClass = "toast-bottom-right";
    toastr.info('This is an Info Toast', 'lorem ipsum asit');
  });

})(jQuery);
