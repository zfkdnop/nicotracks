<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/icon" href="favicon.ico" />
	<!-- <link href="bootshkrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" /> -->
    <link href="bootstrap-yeti.min.css" rel="stylesheet" crossorigin="anonymous" />
	<link href="styles.css" rel="stylesheet" crossorigin="anonymous" />
	<title>NicoTracks by lowkey.link</title>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <!-- Error: This method is not implemented: Check that a complete date adapter is provided -->

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
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card m-4">
                    <h3 class="card-header text-center">NicoTracks</h3>