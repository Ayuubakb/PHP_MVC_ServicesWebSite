<?php
require_once 'assets.php'; // Include the assets file

// Generate the header
generateHeader();

?>

<div class="container" style="display: flex; justify-content: space-between;">
    <!-- Chart for Total Users (Clients and Partners) -->
    <div class="chart-container" style="margin-top:100px; width: 30%;">
        <canvas id="total-users-chart"></canvas>
    </div>

    <!-- Chart for Reservations by Status -->
    <div class="chart-container" style="margin-top:100px;width: 30%;">
        <canvas id="reservations-by-status-chart"></canvas>
    </div>

    <!-- Chart for Comments by Time -->
    <div class="chart-container" style="margin-top:100px;width: 30%;">
        <canvas id="comments-by-time-chart"></canvas>
    </div>
</div>

<?php

// Generate the footer
generateFooter();

?>

<script>
    // Data for charts
    var totalClients = <?php echo $stats['total_clients']; ?>;
    var totalPartners = <?php echo $stats['total_partners']; ?>;
    var commentsByTime = <?php echo json_encode($stats['comments_by_time']); ?>;
    var reservationsByStatus = <?php echo json_encode($stats['reservations_by_status']); ?>;

    // Chart configuration for Total Users
    var ctxUsers = document.getElementById('total-users-chart').getContext('2d');
    var usersChart = new Chart(ctxUsers, {
        type: 'pie',
        data: {
            labels: ['Clients', 'Partners'],
            datasets: [{
                label: 'Total Users',
                data: [totalClients, totalPartners],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)', // Blue for clients
                    'rgba(255, 206, 86, 0.2)' // Yellow for partners
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                }
            }
        }
    });

    // Chart configuration for Comments by Time
    var ctxComments = document.getElementById('comments-by-time-chart').getContext('2d');
    var commentsChart = new Chart(ctxComments, {
        type: 'line',
        data: {
            labels: commentsByTime.map(data => data.post_month), // Change to post_day for day intervals
            datasets: [{
                label: 'Comments Count',
                data: commentsByTime.map(data => data.comment_count),
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
// Array of colors for each status
var statusColors = [
    'rgba(169, 169, 169, 0.2)',   // Waiting (Gray)
    'rgba(0, 128, 0, 0.2)',       // Confirmed (Green)
    'rgba(255, 0, 0, 0.2)',       // Refused (Red)
    'rgba(0, 0, 255, 0.2)'        // Finished (Blue)
];

// Chart configuration for Reservations by Status
var ctxReservations = document.getElementById('reservations-by-status-chart').getContext('2d');
var reservationsChart = new Chart(ctxReservations, {
    type: 'pie',
    data: {
        labels: ['Waiting', 'Confirmed', 'Refused', 'Finished'], // Updated labels
        datasets: [{
            label: 'Reservations Count',
            data: reservationsByStatus.map(data => data.reservation_count),
            backgroundColor: statusColors,
            borderColor: statusColors.map(color => color.replace('0.2', '1')), // Darker border color
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'right',
            }
        }
    }
});



</script>
