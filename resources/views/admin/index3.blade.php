<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (your head content) -->
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <!-- ... (your navigation bar content) -->
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

    <!-- Booking Modal -->
    <div id="bookingModal" class="modal fade" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="bookingForm">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                            <span id="titleError" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Class</label>
                            <input type="text" class="form-control" id="kelas" name="kelas">
                        </div>
                        <div class="mb-3">
                            <label for="participant_count" class="form-label">Participant Count</label>
                            <input type="text" class="form-control" id="participant_count" name="participant_count">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="accept-booking">Accept</button>
                    <button type="button" class="btn btn-danger" id="reject-booking">Reject</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include necessary JavaScript libraries -->
    <!-- ... (your script includes) -->

    <script>
        $(document).ready(function () {
            // ... (your other JavaScript code)

            var bookingId; // Define a variable to store the selected booking ID

            $('#calendar').fullCalendar({
                // ... (your calendar configuration)

                eventClick: function (event) {
                    bookingId = event.id; // Store the selected booking ID when an event is clicked
                    // Show the modal when an event is clicked
                    $('#bookingModal').modal('show');
                }
            });

            // Handle the "Accept" button click
            $('#accept-booking').click(function () {
                changeBookingStatus(bookingId, 'accepted'); // Call your function with 'accepted' status
            });

            // Handle the "Reject" button click
            $('#reject-booking').click(function () {
                changeBookingStatus(bookingId, 'rejected'); // Call your function with 'rejected' status
            });

            // ... (rest of your JavaScript code)
        });
    </script>
</body>
</html>
