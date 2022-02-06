        <?php require("navigation.php") ?>
        <div class="col-lg-10 main-content">
            <div class="row">
                <div class="col-lg-12 p-3">
                    <h3 class="text-primary fw-bold">Dashboard</h3>
                    <hr>
                </div>
                <div class="col-lg-4 p-3 shadow-sm">
                    <div class="card">
                        <div class="card-body">
                            <h2 id="monthlyIncome" class="card-title text-primary"></h2>
                            <p class="card-text text-secondary">Monthly Total Sales</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-3 shadow-sm">
                    <div class="card">
                        <div class="card-body">
                            <h2 id="salesToday" class="card-title text-primary"></h2>
                            <p class="card-text text-secondary">Daily Income</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-3 shadow-sm">
                    <div class="card">
                        <div class="card-body">
                            <h2 id="customers" class="card-title text-primary"></h2>
                            <p class="card-text text-secondary">Number of Customers</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-3">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        prescoExecutePOST('api/AdminController/getMonthlySales', {
            "email" : Cookies.get('email')
        } ,function(res){

            if (res.response instanceof Array) {
                let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                let chartData = new Map();

                let arrIncome = [];
                let labels = [];

                if (res.chart_data instanceof Array) {
                    res.chart_data.forEach(chart_data => {
                        let date = new Date(chart_data.created_date);
                        let month = months[date.getMonth()]
                        
                        chartData.has(month) ? chartData.set(month, parseFloat(chartData.get(month)) + parseFloat(chart_data.total_price)) : chartData.set(month, parseFloat(chart_data.total_price));
                    });
                }

                for (let index = 0; index < months.length; index++) {
                    chartData.has(months[index]) || chartData.set(months[index], 0);
                }

                chartData.forEach(data => {
                    arrIncome.push(data)
                })


                for (const iterator of chartData.keys()) {
                    labels.push(iterator);
                }

                let monthlyIncome = 0;
                let dailyIncome = 0;

               
                res.response.forEach(transaction => {
                    monthlyIncome += parseFloat(transaction.total_price);
                });

                if (res.daily_income instanceof Array) {
                    res.daily_income.forEach(transaction => {
                        dailyIncome += parseFloat(transaction.total_price);
                    });   
                }

                $("#monthlyIncome").html("&#8369; " + monthlyIncome);
                $("#salesToday").html("&#8369; " + dailyIncome);
                $("#customers").html(res.num_of_user[0]['COUNT(*)']);

                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Income Per Annum',
                            data: arrIncome,
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
            }
        });
    });
</script>