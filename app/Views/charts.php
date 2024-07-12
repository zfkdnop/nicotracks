<div class="d-flex justify-content-center mt-8">
    <div class="d-inline-flex w-25">
        <canvas id="canvasUOT"></canvas>
    </div>
    <div class="d-inline-flex w-25">
        <canvas id="canvasDailyTotals"></canvas>
    </div>
</div>
<!-- https://github.com/bolstycjw/chartjs-adapter-dayjs-4/issues/4#issuecomment-1528916300 -->
<!-- https://jsfiddle.net/Lfgv26rz/1/ -->
<script src="https://d3js.org/d3.v7.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/dayjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/plugin/customParseFormat.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/plugin/advancedFormat.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/plugin/isoWeek.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/plugin/quarterOfYear.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/plugin/localizedFormat.js"></script>
<script>
    'use strict';
    var chart_js = Chart;
    var CustomParseFormat = dayjs_plugin_customParseFormat;
    var AdvancedFormat = dayjs_plugin_advancedFormat;
    // var QuarterOfYear = dayjs_plugin_quarterOfYear;
    var LocalizedFormat = dayjs_plugin_localizedFormat;
    var isoWeek = dayjs_plugin_isoWeek;

    dayjs.extend(AdvancedFormat);
    // dayjs.extend(QuarterOfYear);
    dayjs.extend(LocalizedFormat);
    dayjs.extend(CustomParseFormat);
    dayjs.extend(isoWeek);
    var FORMATS = {
        // datetime: 'MMM D, YYYY, h:mm:ss a',
        datetime:   'MMM-DD-YYYY HH:mm:ss',
        date:       'MMM-DD-YYYY',
        time:       'HH:mm:ss',
        browserdate:'YYYY-MM-DD',
        browsertime:'HH:mm',
        // millisecond: 'h:mm:ss.SSS a',
        second:     'HH:mm:ss',
        minute:     'HH:mm',
        hour:       'HH',
        day:        'MMM DD',
        month:      'MM YYYY',
        year:       'YYYY'
    };
    chart_js._adapters._date.override({
        formats: function formats() {
            return FORMATS;
        },
        parse: function parse(value, format) {
            var valueType = typeof value;
            if (value === null || valueType === 'undefined') {
                return null;
            }
            if (valueType === 'string' && typeof format === 'string') {
                return dayjs(value, format).isValid() ? dayjs(value, format).valueOf() : null;
            } else if (!(value instanceof dayjs)) {
                return dayjs(value).isValid() ? dayjs(value).valueOf() : null;
            }
            return null;
        },
        format: function format(time, _format) {
            return dayjs(time).format(_format);
        },
        add: function add(time, amount, unit) {
            return dayjs(time).add(amount, unit).valueOf();
        },
        diff: function diff(max, min, unit) {
            return dayjs(max).diff(dayjs(min), unit);
        },
        startOf: function startOf(time, unit, weekday) {
            if (unit === 'isoWeek') {
                // Ensure that weekday has a valid format
                //const formattedWeekday
                var validatedWeekday = typeof weekday === 'number' && weekday > 0 && weekday < 7 ? weekday : 1;
                return dayjs(time).isoWeekday(validatedWeekday).startOf('day').valueOf();
            }
            return dayjs(time).startOf(unit).valueOf();
        },
        endOf: function endOf(time, unit) {
            return dayjs(time).endOf(unit).valueOf();
        }
    });
</script>
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
