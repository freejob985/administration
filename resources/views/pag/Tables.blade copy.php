<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Design</title>
    <!-- CSS links and styles -->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="card-container" id="newCardContainer">
                <!-- Cards will be dynamically added here -->
            </div>
        </div>
    </div>

    <!-- Modal for creating a new notepad -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        // JavaScript code
        $(document).ready(function() {
            fetchNotepads();

            // Other event handlers and AJAX requests
        });



        $(document).on('click', '.copy-button', function() {
            // Code to copy text to clipboard
        });

        $(document).on('click', '.open-button', function() {
            var card = $(this).closest('.card');
            var fileName = card.data('file-name');

            if (fileName) {
                var fileURL = '/administration/public/notepads/file/' + fileName;
                window.open(fileURL, '_blank');
            } else {
                console.error('File name not found');
            }
        });

        // Other JavaScript functions and event handlers
    </script>
</body>
</html>
