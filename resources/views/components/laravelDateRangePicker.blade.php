<form class="form-inline daterangepicker-form" method="GET" action="{{$route}}" id="daterangepicker-form">
    @csrf
{{--    <div class="form-group mx-sm-3 mb-2">--}}
{{--        <label for="dateFilter" class="sr-only">Filter</label>--}}
{{--        <input type="text" id="reportrange" name="reportrange" />--}}
{{--        <input type="hidden" name="startDate" id="startDate">--}}
{{--        <input type="hidden" name="endDate" id="endDate">--}}
{{--    </div>--}}
    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
        <i class="fa fa-calendar"></i>&nbsp;
        <span></span> <i class="fa fa-caret-down"></i>
        <input type="hidden" name="startDate" id="startDate">
        <input type="hidden" name="endDate" id="endDate">
    </div>
    <button type="submit" class="btn btn-primary rounded">
        {{ __('Применить') }}
    </button>
</form>

<script>
    $(function() {

        var start = moment().subtract(30, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };
        moment.locale('ru');
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            "autoApply": true,
            "showDropdowns": true,
            "locale": {
                "format": "YYYY-M-DD",
                "separator": " - ",
                "applyLabel": "Применить",
                "cancelLabel": "Отмена",
                "fromLabel": "От",
                "toLabel": "До",
                "customRangeLabel": "Произвольный",
                "weekLabel": "W",
                "daysOfWeek": [
                    "Вс",
                    "Пн",
                    "Вт",
                    "Ср",
                    "Чт",
                    "Пт",
                    "Сб"
                ],
                "monthNames": [
                    "Январь",
                    "Февраль",
                    "Март",
                    "Апрель",
                    "Май",
                    "Июнь",
                    "Июль",
                    "Август",
                    "Сентрябрь",
                    "Октрябрь",
                    "Ноябрь",
                    "Декабрь"
                ],
                "firstDay": 1
            },
            ranges: {
                'Сегодня': [moment(), moment()],
                'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
                'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
                'Этот Месяц': [moment().startOf('month'), moment().endOf('month')],
                'Прошлый месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },

        }, cb);

        cb(start, end);

        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            $('#startDate').val(picker.startDate.format('YYYY-MM-DD'));
            $('#endDate').val(picker.endDate.format('YYYY-MM-DD'));
        });

    });
</script>
