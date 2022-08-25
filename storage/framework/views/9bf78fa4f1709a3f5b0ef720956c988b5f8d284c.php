<?php $__env->startSection('center_content'); ?>
    <!doctype html>
<html lang="en">
<head>
    <link href="https://releases.transloadit.com/uppy/v2.4.1/uppy.min.css" rel="stylesheet">
    <!--Regular Datatables CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchbuilder/1.3.2/css/searchBuilder.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.0.0/css/searchPanes.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"/>

</head>

<div id="fortext"></div>
<?php echo e(Aire::open()
  ->route('request')
  ->enctype("multipart/form-data")
  ->post()); ?>

<div style="text-align: center; display: flex; justify-content: end; align-items: center; column-gap: 10px; margin-right: 20px">
    <?php echo e(Aire::select([2021 => '2021', 2022 => '2022', 2023 => '2023',2024 => '2024'], 'select', __('Год'))->value(Illuminate\Support\Facades\Cache::get('date_2'))->name('date_2')); ?>


    <button type="submit" class="btn btn-success" style="margin-top: 8px;"><?php echo e(__('Выбрать')); ?></button>
</div>
<?php echo e(Aire::close()); ?>

<?php if(Illuminate\Support\Facades\Cache::get('date_2') != null): ?>
    <table id="example" class="display wrap table-bordered dt-responsive" style="border-collapse: collapse; width: 100%; padding-top: 10px">
        <thead class="border border-dark">
        <tr>
            <th style="text-align: center;" class="border border-dark" rowspan="3"><?php echo e(__('ID')); ?></th>
            <th style="text-align: center;" class="border border-dark" rowspan="3"><?php echo e(__('Филиал')); ?></th>
            <th colspan="6" style="text-align: center;" class="border border-dark"><?php echo e(__('1 - Квартал')); ?></th>
            <th colspan="6" style="text-align: center;" class="border border-dark"><?php echo e(__('2 - Квартал')); ?></th>
            <th colspan="6" style="text-align: center;" class="border border-dark"><?php echo e(__('3 - Квартал')); ?></th>
            <th colspan="6" style="text-align: center;" class="border border-dark"><?php echo e(__('4 - Квартал')); ?></th>
        </tr>
        <tr class="border border-dark">
            <th style="text-align: center;" class="border border-dark" colspan="2"><?php echo e(__('Товар')); ?></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><?php echo e(__('Работа')); ?></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><?php echo e(__('Услуга')); ?></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><?php echo e(__('Товар')); ?></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><?php echo e(__('Работа')); ?></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><?php echo e(__('Услуга')); ?></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><?php echo e(__('Товар')); ?></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><?php echo e(__('Работа')); ?></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><?php echo e(__('Услуга')); ?></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><?php echo e(__('Товар')); ?></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><?php echo e(__('Работа')); ?></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><?php echo e(__('Услуга')); ?></th>
        </tr>
        <tr class="border border-dark">
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('Без НДС')); ?></th>
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('С НДС')); ?></th>

            <th style="text-align: center;" class="border border-dark"><?php echo e(__('Без НДС')); ?></th>
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('С НДС')); ?></th>

            <th style="text-align: center;" class="border border-dark"><?php echo e(__('Без НДС')); ?></th>
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('С НДС')); ?></th>

            <th style="text-align: center;" class="border border-dark"><?php echo e(__('Без НДС')); ?></th>
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('С НДС')); ?></th>

            <th style="text-align: center;" class="border border-dark"><?php echo e(__('Без НДС')); ?></th>
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('С НДС')); ?></th>

            <th style="text-align: center;" class="border border-dark"><?php echo e(__('Без НДС')); ?></th>
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('С НДС')); ?></th>

            <th style="text-align: center;" class="border border-dark"><?php echo e(__('Без НДС')); ?></th>
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('С НДС')); ?></th>

            <th style="text-align: center;" class="border border-dark"><?php echo e(__('Без НДС')); ?></th>
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('С НДС')); ?></th>

            <th style="text-align: center;" class="border border-dark"><?php echo e(__('Без НДС')); ?></th>
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('С НДС')); ?></th>

            <th style="text-align: center;" class="border border-dark"><?php echo e(__('Без НДС')); ?></th>
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('С НДС')); ?></th>

            <th style="text-align: center;" class="border border-dark"><?php echo e(__('Без НДС')); ?></th>
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('С НДС')); ?></th>

            <th style="text-align: center;" class="border border-dark"><?php echo e(__('Без НДС')); ?></th>
            <th style="text-align: center;" class="border border-dark"><?php echo e(__('С НДС')); ?></th>
        </tr>
        </thead>
    </table>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/searchbuilder/1.3.2/js/dataTables.searchBuilder.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/searchpanes/2.0.0/js/dataTables.searchPanes.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.4.1/js/all.js" integrity="sha384-L469/ELG4Bg9sDQbl0hvjMq8pOcqFgkSpwhwnslzvVVGpDjYJ6wJJyYjvG3u8XW7" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>


    <script>
        function export_format(data, columnIdx){
            switch (columnIdx) {
                case 2:
                case 3:
                case 8:
                case 9:
                case 14:
                case 15:
                case 20:
                case 21:
                    return '__('Товар') ' + data;
                case 4:
                case 5:
                case 10:
                case 11:
                case 16:
                case 17:
                case 22:
                case 23:
                    return '__('Работа') ' + data;
                case 6:
                case 7:
                case 12:
                case 13:
                case 18:
                case 19:
                case 24:
                case 25:
                    return '__('Услуга') ' + data;
                default:
                    return data;
            }
        }
        var columns = [
            {data: "id", name: 'id'},
            {data: 'name', name: 'name'},

            {data: 'tovar_1', name: 'tovar_1'},
            {data: 'tovar_1_nds', name: 'tovar_1_nds'},

            {data: 'rabota_1', name: 'rabota_1'},
            {data: 'rabota_1_nds', name: 'rabota_1_nds'},

            {data: 'usluga_1', name: 'usluga_1'},
            {data: 'usluga_1_nds', name: 'usluga_1_nds'},


            {data: 'tovar_2', name: 'tovar_2'},
            {data: 'tovar_2_nds', name: 'tovar_2_nds'},

            {data: 'rabota_2', name: 'rabota_2'},
            {data: 'rabota_2_nds', name: 'rabota_2_nds'},

            {data: 'usluga_2', name: 'usluga_2'},
            {data: 'usluga_2_nds', name: 'usluga_2_nds'},


            {data: 'tovar_3', name: 'tovar_3'},
            {data: 'tovar_3_nds', name: 'tovar_3_nds'},

            {data: 'rabota_3', name: 'rabota_3'},
            {data: 'rabota_3_nds', name: 'rabota_3_nds'},

            {data: 'usluga_3', name: 'usluga_3'},
            {data: 'usluga_3_nds', name: 'usluga_3_nds'},


            {data: 'tovar_4', name: 'tovar_4'},
            {data: 'tovar_4_nds', name: 'tovar_4_nds'},

            {data: 'rabota_4', name: 'rabota_4'},
            {data: 'rabota_4_nds', name: 'rabota_4_nds'},

            {data: 'usluga_4', name: 'usluga_4'},
            {data: 'usluga_4_nds', name: 'usluga_4_nds'},
        ];
        var getData = "<?php echo e(route('report','22')); ?>";
        var tableTitle = "<?php echo e(__('2 - Отчет квартальный плановый')); ?>";
    </script>
<?php endif; ?>
<?php echo $__env->make('site.components.yajra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\OpenServer\domains\laravel_voyager_uztelecom\resources\views/site/report/22.blade.php ENDPATH**/ ?>