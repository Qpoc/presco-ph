        <?php require("navigation.php") ?>
        <div class="col-lg-10 main-content">
            <div class="row">
                <div class="col-lg-12 p-3">
                    <h3 class="text-primary fw-bold">Dashboard</h3>
                    <hr>
                </div>
                <div class="col-lg-4 p-3 shadow-sm">
                    <p class="text-primary">Important Details</p>
                </div>
                <div class="col-lg-4 p-3 shadow-sm">
                    <p class="text-primary">Important Details</p>
                </div>
                <div class="col-lg-4 p-3 shadow-sm">
                    <p class="text-primary">Important Details</p>
                </div>
                <div class="col-lg-12 mt-3">
                    <canvas id="myChart"></canvas>
                    <script>
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['July', 'August', 'September', 'October', 'November', 'December'],
                            datasets: [{
                                label: '# Sample Sales',
                                data: [12, 19, 3, 5, 2, 3],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>