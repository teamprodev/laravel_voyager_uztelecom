<form class="form-inline" method="GET" action="{{$route}}">
    @csrf
    <div class="form-group mx-sm-3 mb-2">
        <label for="dateFilter" class="sr-only">Filter</label>
        <input type="text" id="reportrange" name="reportrange" />
        <input type="hidden" name="startDate" id="startDate">
        <input type="hidden" name="endDate" id="endDate">
    </div>
    <button type="submit" class="btn btn-primary rounded">
        Submit
    </button>
</form>

<script>
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            "autoApply": true,
            locale: {
                format: 'YYYY-M-DD'
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });

        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            $('#startDate').val(picker.startDate.format('YYYY-MM-DD'));
            $('#endDate').val(picker.endDate.format('YYYY-MM-DD'));
        });
    });
</script>
