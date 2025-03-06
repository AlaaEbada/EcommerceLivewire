@stack('scripts')

<script src="{{ asset('assets') }}/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets') }}/js/jquery.min.js"></script>
<script src="{{ asset('assets') }}/js/popper.min.js"></script>
<script src="{{ asset('assets') }}/js/moment.min.js"></script>
<script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/js/simplebar.min.js"></script>
<script src='{{ asset('assets') }}/js/daterangepicker.js'></script>
<script src='{{ asset('assets') }}/js/jquery.stickOnScroll.js'></script>
<script src="{{ asset('assets') }}/js/tinycolor-min.js"></script>
<script src="{{ asset('assets') }}/js/config.js"></script>
<script src="{{ asset('assets') }}/js/d3.min.js"></script>
<script src="{{ asset('assets') }}/js/topojson.min.js"></script>
<script src="{{ asset('assets') }}/js/datamaps.all.min.js"></script>
<script src="{{ asset('assets') }}/js/datamaps-zoomto.js"></script>
<script src="{{ asset('assets') }}/js/datamaps.custom.js"></script>
<script src="{{ asset('assets') }}/js/Chart.min.js"></script>
<script src="{{ asset('assets') }}/js/gauge.min.js"></script>
<script src="{{ asset('assets') }}/js/jquery.sparkline.min.js"></script>
<script src="{{ asset('assets') }}/js/apexcharts.min.js"></script>
<script src="{{ asset('assets') }}/js/apexcharts.custom.js"></script>
<script src='{{ asset('assets') }}/js/jquery.mask.min.js'></script>
<script src='{{ asset('assets') }}/js/select2.min.js'></script>
<script src='{{ asset('assets') }}/js/jquery.steps.min.js'></script>
<script src='{{ asset('assets') }}/js/jquery.validate.min.js'></script>
<script src='{{ asset('assets') }}/js/jquery.timepicker.js'></script>
<script src='{{ asset('assets') }}/js/dropzone.min.js'></script>
<script src='{{ asset('assets') }}/js/uppy.min.js'></script>
<script src='{{ asset('assets') }}/js/quill.min.js'></script>

{{-- <script>
    $(document).ready(function() {

        // Mark All Messages To Read

        $(document).on("click", ".notifications-icon", function() {
            event.preventDefault();

            $.ajax({
                url: "{{ route('admin.notifications.read') }}",
                method: "GET",

                success: function(data) {
                    console.log('Success:', data);
                    $("#notificationsIconCounter").load(" #notificationsIconCounter > *");
                    $("#notificationsModal").load(" #notificationsModal > *");
                },
                error: function() {
                    alert('Please Try Again');
                }
            });
        });

        // Clear User Notification

        $(document).on("click", "#clearNotifications", function() {
            event.preventDefault();

            $.ajax({
                url: "{{ route('admin.notifications.clear') }}",
                method: "GET",

                success: function(data) {
                    console.log('Success:', data);
                    $("#notificationsIconCounter").load(" #notificationsIconCounter > *");
                    $("#notificationsModal").load(" #notificationsModal > *");
                },
                error: function(xhr, status, error) {
                    alert('Please Try Again');
                }
            });
        });


    });



</script> --}}
<script>
   $(document).ready(function() {
    $(".collapseSidebar").on("click", function(e) {
        e.preventDefault();
        $(".vertical").toggleClass("collapsed");

    });

    $(".nav-item").on("click", function(e) {
        e.preventDefault();

        if ($(".vertical").hasClass("collapsed")) {
            $(".vertical").removeClass("collapsed");
        }
    });

    // // غلق جميع الـ submenu لما يتقفل الـ sidebar
    // $(".collapseSidebar").click(function () {
    //     $(".nav-item ul").slideUp();
    // });



});

</script>
