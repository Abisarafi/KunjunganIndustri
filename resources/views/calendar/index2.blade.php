
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
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
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
                // select: function(start, end, allDays) {
                //     $('#bookingModal').modal('toggle');

                //     $('#saveBtn').click(function() {
                //         var title = $('#title').val();
                //         var jurusan = $('#jurusan').val();
                //         var participant_count = $('#participant_count').val();
                //         var start_date = moment(start).format('YYYY-MM-DD');
                //         var end_date = moment(end).format('YYYY-MM-DD');

                //         $.ajax({
                //             url:"{{ route('calendar.store') }}",
                //             type:"POST",
                //             dataType:'json',
                //             data: { 
                //                 title,
                //                 start_date,
                //                 end_date,
                //                 jurusan,
                //                 participant_count,
                //             },
                //             success:function(response)
                //             {
                //                 $('#bookingModal').modal('hide')
                //                 $('#calendar').fullCalendar('renderEvent', {
                //                     'title': response.title,
                //                     'jurusan': response.jurusan, // Updated variable name
                //                     'participant_count': response.participant_count, // Updated variable name
                //                     'start' : response.start,
                //                     'end'  : response.end,
                //                     'color' : response.color
                //                 });

                //             },
                //             error:function(error)
                //             {
                //                 if(error.responseJSON.errors) {
                //                     $('#titleError').html(error.responseJSON.errors.title);
                                   
                //                 }
                //             },
                //         });
                //     });
                // },
                select: function(start, end, allDays) {
                var selectedWeekStart = moment(start).startOf('week');
                var selectedWeekEnd = moment(end).endOf('week');
                var bookingAllowed = false;
                var selectedStartDate = $('#start_date').val();
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
                    },
                    error: function(error) {
                        console.error(error);
                    },
                    complete: function() {
                        if (isWeekend) {
                            if (bookingAllowed) {
                            // Show the booking modal
                            $('#bookingModal').modal('toggle');
                            } else {
                                // Show a popup message indicating that booking is not allowed
                                alert('Booking is not allowed in a week with accepted bookings.');
                            }
                    } else {
                        // Show a popup message indicating that booking is not allowed
                        alert('Booking is not allowed in a weekends.');
                    }
                }
            });
                
                // Booking submission logic
                $('#saveBtn').click(function() {
                    var title = $('#title').val();
                    var jurusan = $('#jurusan').val();
                    var participant_count = $('#participant_count').val();
                    var start_date = moment(start).format('YYYY-MM-DD');
                    var end_date = moment(end).format('YYYY-MM-DD');

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
                        },
                        success: function(response) {
                            $('#bookingModal').modal('hide');
                            $('#calendar').fullCalendar('renderEvent', {
                                'title': response.title,
                                'jurusan': response.jurusan,
                                'participant_count': response.participant_count,
                                'start': response.start,
                                'end': response.end,
                                // 'color': response.color
                            });
                            location.reload();
                            
                        },
                        error: function(error) {
                            if (error.responseJSON.errors) {
                                $('#titleError').html(error.responseJSON.errors.title);
                            }
                        },
                    });
                });
            },
               
            eventClick: function(event) {
                var id = event.id; // Get the event ID from the clicked event

                if (confirm('Are you sure want to remove it')) {
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
            },
                selectAllow: function(event)
                {
                    return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
                },



            });


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