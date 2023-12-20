<script src="{{ asset('public/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/lib/slick/slick.js') }}"></script>
<script src="{{ asset('public/js/html5lightbox.js') }}"></script>
<script src="{{ asset('public/js/counter.js') }}"></script>
<script src="{{ asset('public/js/wow.min.js') }}"></script>
<script src="{{ asset('public/js/scripts.js') }}"></script>
<script src="{{ asset('public/js/appear.js') }}"></script>
  <script src="{{ asset('public/js/bootstrap.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('public/js/popper.min.js') }}" ></script>
    <script src="{{ asset('public/js/select-2.js') }}" type="text/javascript"></script>
<script src="{{asset('public/admin/js/jquery.validate.js')}}"></script>
<script src="{{asset('public/js/sweet-alert.js')}}"></script>

<script>
  $(document).ready(function(){
    $("#profidrop").click(function(){
        $("#profidropdid").slideToggle();
    });
});
$(document).on('click', function () {
  var $target = $(event.target);
  if (!$target.closest('#profidropdid').length
    && !$target.closest('#profidrop').length
    && $('#profidropdid').is(":visible")) {
    $('#profidropdid').slideUp();
  }

});
</script>



<script>
  $(document).ready(function(){
    $(".mobile_menu2").click(function(){
        $("#mobile_menu_dv2").slideToggle();
    });
});
$(document).on('click', function () {
  var $target = $(event.target);
  if (!$target.closest('#profidropdid').length
    && !$target.closest('#profidrop').length
    && $('#profidropdid').is(":visible")) {
    $('#profidropdid').slideUp();
  }

});



$(document).ready(function () {

  //toggle the componenet with class accordion_body
  $(".accordion_head").click(function () {

  var id = $(this).data('id');

  if ($('.aa' + id).is(':visible')) {
    $(".aa" + id).slideUp(600);
    $(".plusminus" + id).text('+');
  } else {

    $(".accordion_body").slideUp(600);
    $(".plusminus").text('+');
    $(this).next(".accordion_body").slideDown(600);
    $(this).children(".plusminus" + id).text('-');
  }


  });


});
</script>

<script>
    $(document).ready(function() {
        $('.pdf_alrt').click(function() {
            var id = $(this).data('id');

            var checkWitness = $('.witnessExist').val();

            if(checkWitness == 1){
                Swal.fire({
                    title: 'Hope you have added all information pertaining to your assets! Do you wish to proceed with the completion of the Will?',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // window.location.href = "{{url('download-pdf')}}/" + id;
                        url = "{{url('download-pdf')}}/" + id;
                        window.open(url, '_blank');
                    } else {
                        return false;
                    }
                });

            }else{
                Swal.fire({
                    title: 'Please add atleast one Witness to proceed',
                    icon: 'danger',
                    showCancelButton: false,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Ok'
                });
            }
        });
    });
</script>
