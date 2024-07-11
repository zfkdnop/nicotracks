<div class="d-flex justify-content-center mt-8">
    <div class="d-inline-flex  w-25">
        <canvas id="canvasUOT"></canvas>
    </div>
    <div class="d-inline-flex w-25">
        <canvas id="canvasDailyTotals"></canvas>
    </div>
</div>

<script>
    function initializeCharts() {
        const ctx1 = document.getElementById('canvasUOT').getContext('2d');
        usageOverTimeChart = new Chart(ctx1, {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Average Dose (mg)',
                    backgroundColor: '#32cd32', /*green*/
                    borderColor: '#b903d8', /*purp*/
                    data: []
                    }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: { unit: 'day' },
                    },
                    y: { beginAtZero: true }
                }
            }
       });

        const ctx2 = document.getElementById('canvasDailyTotals').getContext('2d');
        dailyTotalsChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                datasets: [{
                    label: 'Daily Total (mg)',
                    backgroundColor: '#32cd32',
                    borderColor: '#b903d8',
                    borderWidth: 3,
                    data: []
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'time',
                        time: { unit: 'day' }
                    },
                    y: { beginAtZero: true }
                }
            }
        });
    }

    function updateCharts() {
        rawData = <?= json_encode($chartData??[]) ?>;
        const usageOverTimeData = rawData.map(entry => ({
            x: new dayjs(entry.ts).format(FORMATS.datetime),
            y: entry.mg * entry.ct
        }));

        usageOverTimeChart.data.datasets[0].data = usageOverTimeData;
        usageOverTimeChart.update();

        const dailyTotalsDataTally = rawData.reduce((acc, entry) => {
            const date = new dayjs(entry.ts).format(FORMATS.date);
            acc[date] = (acc[date] || 0) + entry.mg * entry.ct;
            return acc;
        }, {});

        const dailyTotalsData = Object.entries(dailyTotalsDataTally).map(([date, total]) => ({ x: date, y: total}));

        dailyTotalsChart.data.datasets[0].data = dailyTotalsData;
        dailyTotalsChart.update();
    }

    function setCurrentDateTime() {
        const now = dayjs();
        document.getElementById('date').value = now.format(FORMATS.browserdate);
        document.getElementById('time').value = now.format(FORMATS.browsertime);
    }

    setCurrentDateTime();
    initializeCharts();
    updateCharts();
</script>