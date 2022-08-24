<?php $__env->startSection('center_content'); ?>
    <!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"/>

    <link href="https://releases.transloadit.com/uppy/v2.4.1/uppy.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchbuilder/1.3.2/css/searchBuilder.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.0.0/css/searchPanes.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchbuilder/1.3.3/css/searchBuilder.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/date-1.0.3/r-2.2.7/sb-1.0.1/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css"/>
</head>

<div id="fortext"></div>
<?php echo e(Aire::open()
  ->route('request')
  ->enctype("multipart/form-data")
  ->post()); ?>

<div style="text-align: center; display: flex; justify-content: end; align-items: center; column-gap: 10px; margin-right: 20px">
    <?php echo e(Aire::month('m', __('Месяц'))->value(Illuminate\Support\Facades\Cache::get('date_3_month'))->name('date_3_month')); ?>


    <button type="submit" class="btn btn-success" style="margin-top: 8px;"><?php echo e(__('Выбрать')); ?></button>
</div>
<?php echo e(Aire::close()); ?>

<?php if(Illuminate\Support\Facades\Cache::get('date_3_month') != null): ?>
    <table id="example" class="display wrap table-bordered dt-responsive" style="border-collapse: collapse; width: 100%; padding-top: 10px">
        <thead class="border border-dark">

        <tr class="border border-dark">
            <th style="text-align: center;" class="border border-dark" rowspan="2"> <?php echo e(__('ID')); ?></th>
            <th style="text-align: center;" class="border border-dark" rowspan="2"><?php echo e(__('Филиал')); ?></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><b><?php echo e(__('товар')); ?></b></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><b><?php echo e(__('работа')); ?></b></th>
            <th style="text-align: center;" class="border border-dark" colspan="2"><b><?php echo e(__('услуга')); ?></b></th>
        </tr>
        <tr class="border border-dark">
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
                    return '__('Товар') ' + data;
                case 4:
                case 5:
                    return '__('Работа') ' + data;
                case 6:
                case 7:
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
        ];
        var getData = "<?php echo e(route('report','3')); ?>";
        var tableTitle = "<?php echo e(__('3 - Отчет за год')); ?>";
    </script>
<?php echo $__env->make('site.components.yajra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\OpenServer\domains\laravel_voyager_uztelecom\resources\views/site/report/3.blade.php ENDPATH**/ ?>