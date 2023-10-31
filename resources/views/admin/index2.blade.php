
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Full Calendar js</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <!-- Place any navbar links here if needed -->
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Your content should be placed here, outside the navbar container -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mt-5">FullCalendar js Laravel series with Career Development Lab</h3>
                <div class="col-md-11 offset-1 mt-5 mb-5">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking Details Modal -->
    {{-- <div class="modal fade" id="bookingDetailsModal" tabindex="-1" role="dialog" aria-labelledby="bookingDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingDetailsModalLabel">Booking Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Title:</strong> <span id="booking-title"></span></p>
                    <p><strong>Class:</strong> <span id="booking-class"></span></p>
                    <p><strong>Participant Count:</strong> <span id="booking-participant-count"></span></p>
                    <p><strong>Start Date:</strong> <span id="booking-start"></span></p>
                    <p><strong>End Date:</strong> <span id="booking-end"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="accept-booking" value="accepted">Accept</button>
                    <button type="button" class="btn btn-danger" id="reject-booking" value="rejected">Reject</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-success accept-booking" data-status="accepted">Accept</button>
                    <button type="button" class="btn btn-danger reject-booking" data-status="rejected">Reject</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Booking Details Modal -->
    <div class="modal fade" id="bookingDetailsModal" tabindex="-1" role="dialog" aria-labelledby="bookingDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingDetailsModalLabel">Booking Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Sekolah :</strong> <span id="booking-title"></span></p>
                    <p><strong>Jurusan :</strong> <span id="booking-jurusan"></span></p>
                    <p><strong>Jumlah:</strong> <span id="booking-participant-count"></span></p>
                    <p><strong>Tanggal :</strong> <span id="booking-start"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="accept-booking">Accept</button>
                    <button type="button" class="btn btn-danger" id="reject-booking">Reject</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mt-5">FullCalendar js Laravel series with Career Development Lab</h3>
                <div class="col-md-11 offset-1 mt-5 mb-5">

                    <div id="calendar">

                    </div>

                </div>
            </div>
        </div>
    </div> --}}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
       

        $(document).ready(function() {

            

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var booking = @json($events);
             var bookingId; // Define a variable to store the selected booking ID

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next',
                    center: 'title',
                    right: 'today',
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                editable: true,

                

                // event click
                eventClick: function(event) {
                var id = event.id;
                bookingId = event.id; // Store the selected booking ID when an event is clicked
                var title = event.title;
                var jurusan = event.jurusan;
                var participant_count = event.participant_count;
                var start_date = event.start.format('YYYY-MM-DD');
                var end_date = event.end.format('YYYY-MM-DD');
                bookingId = event.id; // Store the selected booking ID when an event is clicked
                // Show the modal when an event is clicked
                var status = $('#status').val();

                // Populate your modal with the event details
                $('#bookingDetailsModal').modal('show');
                $('#booking-title').text(title);
                $('#booking-jurusan').text(jurusan);
                $('#booking-participant-count').text(participant_count);
                $('#booking-start').text(start_date);

                

                // Handle the "Accept" button click
                $('#accept-booking').click(function() {
                    var status = 'accepted'; // Set status as 'accepted'
                    updateBookingStatus(bookingId, status);
                    $('#bookingDetailsModal').modal('hide'); // Hide the modal here
                });

                // Handle the "Reject" button click
                $('#reject-booking').click(function() {
                    var status = 'rejected'; // Set status as 'rejected'
                    updateBookingStatus(bookingId, status);
                    $('#bookingDetailsModal').modal('hide'); // Hide the modal here
                });

                // Handle the "x" button click
                $('#close').click(function() {
                    $('#bookingDetailsModal').modal('hide'); // Hide the modal here
                });

                // // Handle the "Accept" button click
                // $('.accept-booking').click(function () {
                //     var bookingId = $(this).data('booking-id');
                //     var status = $(this).data('status');

                //     $.ajax({
                //         url: "{{ route('admin.calendar.update-booking-status') }}",
                //         type: "POST",
                //         dataType: 'json',
                //         data: {
                //             booking_id: bookingId,
                //             status: status
                //         },
                //         success: function(response) {
                //             $('#bookingDetailsModal').modal('hide');
                //             // You can update the event status here if needed
                //         },
                //         error: function(error) {
                //             // Handle errors
                //             console.log(error);
                //         }
                //     });
                // });

                // // Handle the "Reject" button click
                // $('.reject-booking').click(function () {
                //     var bookingId = $(this).data('booking-id');
                //     var status = $(this).data('status');

                //     $.ajax({
                //         url: "{{ route('admin.calendar.update-booking-status') }}",
                //         type: "POST",
                //         dataType: 'json',
                //         data: {
                //             booking_id: bookingId,
                //             status: status
                //         },
                //         success: function(response) {
                //             $('#bookingDetailsModal').modal('hide');
                //             // You can update the event status here if needed
                //         },
                //         error: function(error) {
                //             // Handle errors
                //             console.log(error);
                //         }
                //     });
                // });

                // // Handle the "Accept" button click
                // $('#accept-booking').click(function () {
                //     updateBookingStatus(bookingId, 'accepted'); // Call your function with 'accepted' status
                // });

                // // Handle the "Reject" button click
                // $('#reject-booking').click(function () {
                //     updateBookingStatus(bookingId, 'rejected'); // Call your function with 'rejected' status
                // });
                // Close the modal when either button is clicked

            },


                selectAllow: function(event)
                {
                    return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
                },



            });

            // Function to update booking status
            function updateBookingStatus(bookingId, status) {
                $.ajax({
                    url: status === 'accepted' ? "{{ route('admin.calendar.accept') }}" : "{{ route('admin.calendar.reject') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        booking_id: bookingId,
                        status: status
                    },
                    success: function(response) {
                        // Handle success, e.g., update the UI
                        console.log(response);
                    },
                    error: function(error) {
                        // Handle errors
                        console.error(error);
                    }
                });
            }


            // $("#bookingDetailsModal").on("hidden.bs.modal", function () {
            //     $('#saveBtn').unbind();
            // });

            $('.fc-event').css('font-size', '13px');
            $('.fc-event').css('width', '20px');
            $('.fc-event').css('border-radius', '50%');


        });
    </script>
</body>
</html>
