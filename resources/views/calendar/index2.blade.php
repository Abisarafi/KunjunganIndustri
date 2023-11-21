
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kunjungan Industri SIMS Lifemedia</title>
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
                {{ config('app.name', 'Kunjungan Industri SIMS Lifemedia') }}
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

      <!-- Modal -->
  <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Booking title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="text" class="form-control" id="title" placeholder="Nama Sekolah" name="title">
            <select class="form-control" id="jurusan" name="jurusan" required>
                <option value="" disabled selected>Jurusan</option>
                <option value="TKJ">TKJ</option>
                <option value="SIJA">SIJA</option>
                <option value="TJA">TJA</option>
                <option value="MM">MM</option>
                <option value="RPL">RPL</option>
                <option value="Broadcasting">Broadcasting</option>
            </select>
            <select class="form-control" id="participant_count" name="participant_count" required>
                <option value="" disabled selected>Jumlah Kelas (1 kelas max 30 orang)</option>
                <option value="1">1 Kelas</option>
                <option value="2">2 Kelas</option>
            </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

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
                    <p><strong>Jumlah Kelas :</strong> <span id="booking-participant-count"></span></p>
                    <p><strong>Tanggal :</strong> <span id="booking-start"></span></p>
                    <p><strong>Status :</strong> <span id="booking-status"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="delete-booking">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Your content should be placed here, outside the navbar container -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mt-5">Aplikasi Kunjungan Industri SIMS Lifemedia</h3>
                <div class="col-md-11 offset-1 mt-5 mb-5">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var booking = @json($events);

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next',
                    center: 'title',
                    right: 'today',
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                loading: function(bool) {
                // If the calendar is loading (true), refetch events
                if (bool) {
                    $('#calendar').fullCalendar('refetchEvents');
                }
            },
                
                // saat click tanggal kalender
                select: function(start, end, allDays) {

                var selectedWeekStart = moment(start).startOf('week');
                var selectedWeekEnd = moment(end).endOf('week');
                var bookingAllowed = false;
                var selectedStartDate = moment(start).format('YYYY-MM-DD'); // Use selected date in the format you need
                var selectedWeekday = moment(selectedStartDate).isoWeekday(); // Get the ISO weekday (1 = Monday, 7 = Sunday)
                

                $.ajax({
                    url: "{{ route('calendar.check') }}",
                    type: "GET",
                    dataType: 'json',
                    data: {
                        start: selectedWeekStart.format('YYYY-MM-DD'),
                        end: selectedWeekEnd.format('YYYY-MM-DD'),
                        start_date: selectedStartDate,
                    },
                    success: function(response) {
                        bookingAllowed = !response.hasAcceptedBookings;
                        isWeekend = !response.isWeekend;
                        isTomorrow = response.isTomorrow;
                        isMoreThan7Days = response.isMoreThan7Days;
                    },
                    error: function(error) {
                        console.error(error);
                    },
                    complete: function() {
                        if (isTomorrow) {
                            if (isWeekend) {
                                if (isMoreThan7Days) {
                                    if (bookingAllowed) {
                                        // Show the booking modal
                                        $('#bookingModal').modal('toggle');
                                    } else {
                                        // Show a popup message indicating that booking is not allowed
                                        alert('Sudah ada kunjungan industri di minggu ini, silahkan pilih tanggal lainnya.');
                                        location.reload();
                                    }
                                } else {
                                    // Show a popup message indicating that booking is not allowed
                                    alert('Tanggal yang dipilih minimal 7 hari setelah tanggal Anda melakukan pengajuan.');
                                    location.reload();
                                }
                            } else {
                                // Show a popup message indicating that booking is not allowed
                                alert('Kami libur hari minggu, silahkan pilih hari senin - sabtu.');
                                location.reload();
                            }
                        } else{
                            // Show a popup message indicating that booking is not allowed
                            alert('Tidak boleh mengajukan kunjungan industri sebelum hari ini.');
                            location.reload();
                        }
                        
                }
            });
                
                // Booking submission logic

                $('#saveBtn').click(function() {
                var title = $('#title').val();
                var jurusan = $('#jurusan').val();
                var participant_count = $('#participant_count').val();
                var status = "processed";
                var start_date = moment(start).format('YYYY-MM-DD');
                var end_date = moment(end).format('YYYY-MM-DD');
                var kelas = jurusan; // Assuming that 'jurusan' contains the class name

                // Define the maximum participant counts for each class
                var maxCounts = {
                    'TKJ': 2,
                    'SIJA': 2,
                    'TJA': 2,
                    'MM': 1,
                    'RPL': 1,
                    'Broadcasting': 1,
                };

                if (participant_count <= maxCounts[kelas]) {
                    $.ajax({
                        url: "{{ route('calendar.store') }}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            title,
                            start_date,
                            end_date,
                            jurusan,
                            participant_count,
                            status,
                        },
                        success: function(response) {
                            $('#bookingModal').modal('hide');
                            $('#calendar').fullCalendar('renderEvent', {
                                'title': response.title,
                                'jurusan': response.jurusan,
                                'participant_count': response.participant_count,
                                'status': response.status,
                                'start': response.start,
                                'end': response.end,
                                'color': response.color
                            });
                            location.reload();
                        },
                        error: function(error) {
                            if (error.responseJSON.errors) {
                                $('#titleError').html(error.responseJSON.errors.title);
                            }
                        },
                    });
                } else {
                    alert('jurusan RPL, MM, dan Broadcasting hanya boleh 1 kelas.');
                    // Delay the location.reload by 5 seconds (1000 milliseconds)
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            });
              
    },
               
            
    
            // event click
            eventClick: function(event) {
                var id = event.id;
                bookingId = event.id; // Store the selected booking ID when an event is clicked
                var title = event.title;
                var jurusan = event.jurusan;
                var status = event.status;
                var participant_count = event.participant_count;
                var start_date = event.start.format('YYYY-MM-DD');
                var end_date = event.end.format('YYYY-MM-DD');
                bookingId = event.id; // Store the selected booking ID when an event is clicked
                // // Show the modal when an event is clicked
                // var status = $('#status').val();

                // Populate your modal with the event details
                $('#bookingDetailsModal').modal('show');
                $('#booking-title').text(title);
                $('#booking-jurusan').text(jurusan);
                $('#booking-participant-count').text(participant_count);
                $('#booking-start').text(start_date);
                $('#booking-status').text(status);

               

                // Handle the "Hapus" button click
                $('#delete-booking').click(function() {
                    var idEvent = event.id;
                    deleteBooking(idEvent);
                    $('#bookingDetailsModal').modal('hide'); // Hide the modal here
                });

                // Handle the "x" button click
                $('#close').click(function() {
                    $('#bookingDetailsModal').modal('hide'); // Hide the modal here
                });

            },
               
                
                selectAllow: function(event)
                {
                    return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
                },
            });

            // Function to delete booking
            function deleteBooking(idEvent) {
                id = idEvent;
                    $.ajax({
                        url: "{{ route('calendar.destroy', '') }}" + '/' + id, // Use the correct event ID
                        type: "DELETE",
                        dataType: 'json',
                        success: function (response) {
                            $('#calendar').fullCalendar('removeEvents', response);
                        },
                        error: function (error) {
                            console.log(error);
                        },
                    });
            }


            $("#bookingModal").on("hidden.bs.modal", function () {
                $('#saveBtn').unbind();
            });

            $('.fc-event').css('font-size', '13px');
            $('.fc-event').css('width', '20px');
            $('.fc-event').css('border-radius', '50%');


        });
    </script>
</body>
</html>