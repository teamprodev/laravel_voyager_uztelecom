<script>
        $(function () {
            var table = $('#yajra-datatable').DataTable({
                columnDefs: [
                    {
                        targets: [0,1,2,3,4,5,6,8,9,10,11,12],
                        className: 'dt-body-center dt-head-center'
                    },
                    {
                        targets: 7,
                        className: 'dt-body-right dt-head-center'
                    }
                ],
                order: [[ 0, "desc" ]],
                "language": {
                    "lengthMenu": "Показать _MENU_ записей",
                    "info":      'Показаны записи в диапазоне от _START_ до _END_ (В общем _TOTAL_)',
                    "search":  'Поиск',
                    "paginate": {
                        "previous": "Назад",
                        "next": "Дальше"
                    }

                },
                processing: false,
                serverSide: true,
                ajax: getData,

                columns: columns,
            });


        });
</script>
