<?php
session_start();
if (!isset($_SESSION['amount']) || !isset($_SESSION['original']) || !isset($_SESSION['schedule']) || !isset($_SESSION['no']) || !isset($_SESSION['class'])) {
    die("Invalid session. Please go back and try again.");
}

// Simulate a payment process or integrate a payment gateway here
// For example, after the payment gateway redirects here with a success status, you would check it

// Assuming payment was successful
$paymentSuccess = true; // You can replace this with actual payment status from a gateway

if ($paymentSuccess) {
    // Process the booking and mark it as successful
    $amountPaid = $_SESSION['amount'];
    $originalFee = $_SESSION['original'];
    $scheduleId = $_SESSION['schedule'];
    $numberOfTickets = $_SESSION['no'];
    $class = $_SESSION['class'];
    $ticketId = generateTicketId(); // Function to generate a unique ticket ID

    // Insert the booking details into the database (pseudo code)
    // $db->query("INSERT INTO bookings (ticket_id, amount, schedule_id, number_of_tickets, class) VALUES (...)");

    // Clear session details
    unset($_SESSION['amount'], $_SESSION['original'], $_SESSION['schedule'], $_SESSION['no'], $_SESSION['class']);

    echo "
    <div class='content'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='card'>
                        <div class='card-header alert-success'>
                            <h5 class='m-0'></h5>
                        </div>
                        <div class='card-body'>
                            <p>Thank you for your payment!</p>
                            <p>Your booking has been confirmed.</p>
                            <p><strong>Ticket ID: </strong> $ticketId</p>
                            <p><strong>Total Amount Paid: </strong> $$amountPaid</p>
                            <a href='view_bookings.php' class='btn btn-success'>View Bookings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>";
} else {
    // Handle payment failure
    echo "
    <div class='content'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='card'>
                        <div class='card-header alert-danger'>
                            <h5 class='m-0'>Payment Failed</h5>
                        </div>
                        <div class='card-body'>
                            <p>Unfortunately, your payment was not successful.</p>
                            <p>Please try again.</p>
                            <a href='booking.php' class='btn btn-danger'>Retry Payment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>";
}

function generateTicketId() {
    // Generate a random, unique ticket ID (example)
    return strtoupper(bin2hex(random_bytes(5)));
}
