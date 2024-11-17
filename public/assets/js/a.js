<script>
    // Biểu đồ cho số lượng đặt phòng
    var bookingCtx = document.getElementById('bookingChart').getContext('2d');
    var bookingChart = new Chart(bookingCtx, {
        type: 'bar',
        data: {
            labels: ['Hôm nay', 'Tuần này', 'Tháng này'],  // Các mốc thời gian
            datasets: [{
                label: 'Số lượng đặt phòng',
                data: [{{ todayBookings }}, {{ weekBookings }}, {{ monthBookings }}],  // Dữ liệu từ Controller
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Biểu đồ cho doanh thu
    var revenueCtx = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Hôm nay', 'Tuần này', 'Tháng này'],
            datasets: [{
                label: 'Doanh thu',
                data: [{{ todayRevenue }}, {{ weekRevenue }}, {{ monthRevenue }}],
                fill: false,
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>