<!DOCTYPE html>
<html>
<head>
    <title>Server Load Monitor</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas { max-width: 600px; margin: 20px auto; display: block; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Server CPU & RAM Utilization</h2>
    <canvas id="cpuChart"></canvas>
    <canvas id="ramChart"></canvas>

    <script>
        const cpuCtx = document.getElementById('cpuChart').getContext('2d');
        const ramCtx = document.getElementById('ramChart').getContext('2d');

        const cpuChart = new Chart(cpuCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'CPU Load (1 min avg)',
                    data: [],
                    borderColor: 'orange',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, max: 100 }
                }
            }
        });

        const ramChart = new Chart(ramCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'RAM Usage (%)',
                    data: [],
                    borderColor: 'blue',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, max: 100 }
                }
            }
        });

        function fetchData() {
            fetch('system_status.php')
                .then(res => res.json())
                .then(data => {
                    const now = new Date().toLocaleTimeString();
                    cpuChart.data.labels.push(now);
                    ramChart.data.labels.push(now);

                    cpuChart.data.datasets[0].data.push(data.cpu);
                    ramChart.data.datasets[0].data.push(data.ram);

                    // Keep only last 10 points
                    if (cpuChart.data.labels.length > 10) {
                        cpuChart.data.labels.shift();
                        cpuChart.data.datasets[0].data.shift();
                        ramChart.data.labels.shift();
                        ramChart.data.datasets[0].data.shift();
                    }

                    cpuChart.update();
                    ramChart.update();
                });
        }

        // Initial load
        fetchData();
        // Update every 5 seconds
        setInterval(fetchData, 5000);
    </script>
</body>
</html>
