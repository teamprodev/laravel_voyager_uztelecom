

<?php $__env->startSection('center_content'); ?>
    <div class="pl-4 pt-4">
        <a href="<?php echo e(route('site.applications.edit',$application->id)); ?>" class="btn btn-success">Изменить</a>
    </div>
    <div class="px-6 pb-0 pt-6">
        <h5><strong>ID : </strong> <?php echo e($application->id); ?>

            <h5><strong><?php echo e(__('Автор заявки:')); ?></strong> <?php echo e($application->user->name); ?> ( <?php echo e($application->user->role_id ? $application->user->role->display_name : ''); ?> )</h5>
            <h5><strong><?php echo e(__('Филиал автора:')); ?></strong> <?php echo e($application->user->branch_id ? $branch_name->name : 'Он(а) не выбрал(а) филиал'); ?></h5>
            <h5><strong>Должность :</strong> <?php echo e(auth()->user()->position_id ? auth()->user()->position->name:"Нет"); ?></h5>
            <h5><strong><?php echo e(__('Номер заявки')); ?> : </strong> <?php echo e($application->number); ?> </h5>
            <h5><strong>Date : </strong>
                <?php if($application->date!=null): ?>
                    <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d', $application->date)->Format('d.m.Y')); ?><?php echo e(__('г')); ?>

                <?php endif; ?>
            </h5> <br>
            <h5><strong><?php echo e(__('Визирование заявки через:')); ?></strong>
            <?php if($application->is_more_than_limit == 1): ?>
                <?php echo e(__('Компанию')); ?>

            <?php else: ?>
            <?php echo e(__('Филиал')); ?>

            <?php endif; ?>
        </h5> <br>
        </h5>
    </div>
    <div class="flex items-baseline">
        <div class="pt-2 w-100">
            <div class="flex items-baseline">
                <div class="p-6">
                    <div class="mb-3 row">
                        <label class="col-sm-6" for="initiator" class="col-sm-2 col-form-label"><?php echo e(__('Инициатор (наименование подразделения заказчика)')); ?></label>
                        <div class="col-sm-6">
                            <?php echo e(Aire::input()
                                ->name("initiator")
                                ->value($application->initiator)
                                ->class("form-control")
                                ->disabled()); ?>

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="purchase_basis" class="col-sm-2 col-form-label"><?php echo e(__('Цель / содержание закупки (обоснование необходимости закупки)')); ?></label>
                        <div class="col-sm-6">
                            <?php echo e(Aire::textArea()
                                ->rows(3)
                                ->name("purchase_basis")
                                ->value($application->purchase_basis)
                                ->cols(40)
                                ->class("form-control")
                                ->disabled()); ?>

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="basis" class="col-sm-2 col-form-label"><?php echo e(__('Основания (план закупок, рапорт,распоряжение руководства)')); ?></label>
                        <div class="col-sm-6">
                            <?php echo e(Aire::textArea()
                                ->rows(3)
                                ->name("basis")
                                ->value($application->basis)
                                ->cols(40)
                                ->class("form-control")
                                ->disabled()); ?>

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="name" class="col-sm-2 col-form-label"><?php echo e(__('Наименование предмета закупки(товар, работа, услуги)')); ?></label>
                        <div class="col-sm-6">
                            <?php echo e(Aire::input()
                                ->name("name")
                                ->value($application->name)
                                ->class("form-control")
                                ->disabled()); ?>

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="specification" class="col-sm-2 col-form-label"><?php echo e(__('Описание предмета закупки (технические характеристики)')); ?></label>
                        <div class="col-sm-6">
                            <?php echo e(Aire::textArea()
                                ->rows(3)
                                ->name("specification")
                                ->value($application->specification)
                                ->cols(40)
                                ->class("form-control")
                                ->disabled()); ?>

                        </div>
                    </div>

                    <div class="mb-3 row w-50">
                        <label class="col-sm-6" for="date" class="col-sm-2 col-form-label"><?php echo e(__('Ожидаемый срок поставки')); ?></label>
                        <div class="col-sm-6">
                            <input class="form-control" id="date" name="delivery_date" value="<?php echo e($application->delivery_date); ?>" type="date"/>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="separate_requirements" class="col-sm-2 col-form-label"><?php echo e(__('Особые требования')); ?></label>
                        <div class="col-sm-6">
                            <?php echo e(Aire::textArea()
                                ->rows(3)
                                ->name("separate_requirements")
                                ->value($application->separate_requirements)
                                ->cols(40)
                                ->class("form-control")
                                ->disabled()); ?>

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="other_requirements" class="col-sm-2 col-form-label"><?php echo e(__('Другие требования к товару (работе, услуге)')); ?></label>
                        <div class="col-sm-6">
                            <?php echo e(Aire::textArea()
                                ->rows(3)
                                ->name("other_requirements")
                                ->value($application->other_requirements)
                                ->cols(40)
                                ->class("form-control")
                                ->disabled()); ?>

                        </div>
                    </div>

                    <div class="mb-3 row w-50">
                        <label class="col-sm-6" for="date" class="col-sm-2 col-form-label"><?php echo e(__('Гарантийный срок качества товара (работ, услуг)')); ?></label>
                        <div class="col-sm-6">
                            <input class="form-control" id="date" name="expire_warranty_date" value="<?php echo e($application->expire_warranty_date); ?>" type="date"/>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="planned_price" class="col-sm-2 col-form-label"><?php echo e(__('Планируемый бюджет закупки (сумма)')); ?></label>
                        <div class="col-sm-6">
                            <?php echo e(Aire::input()
                                ->name("planned_price")
                                ->id("planned_price")
                                ->value(number_format($application->planned_price , 0 , '' , ' '))
                                ->class("form-control")->disabled()); ?>

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="incoterms" class="col-sm-2 col-form-label"><?php echo e(__('Условия поставки по INCOTERMS (самовывоз со склада/доставка до покупателя)')); ?></label>
                        <div class="col-sm-6">
                            <?php echo e(Aire::textArea()
                                ->rows(3)
                                ->name("incoterms")
                                ->value($application->incoterms)
                                ->cols(40)
                                ->class("form-control")->disabled()); ?>

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="info_purchase_plan" class="col-sm-2 col-form-label"><?php echo e(__('Информация о наличии в «Плане закупок» приобретаемых товаров')); ?></label>
                        <div class="col-sm-6">
                            <?php echo e(Aire::textArea()
                                ->rows(3)
                                ->name("info_purchase_plan")
                                ->value($application->info_purchase_plan)
                                ->cols(40)
                                ->class("form-control")->disabled()); ?>

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="info_business_plan" class="col-sm-2 col-form-label"><?php echo e(__('Статья расходов по Бизнес плану')); ?></label>
                        <div class="col-sm-6">
                            <?php echo e(Aire::input()
                                ->name("info_business_plan")
                                ->value($application->info_business_plan)
                                ->class("form-control")->disabled()); ?>

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="comment" class="col-sm-2 col-form-label"><?php echo e(__('Комментарий')); ?></label>
                        <div class="col-sm-6">
                            <?php echo e(Aire::textArea()
                                ->rows(3)
                                ->name("comment")
                                ->value($application->comment)
                                ->cols(40)
                                ->class("form-control")
                                ->disabled()); ?>

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="currency" class="col-sm-6 col-form-label"><?php echo e(__('Валюта')); ?></label>
                        <select class="form-control col-sm-6" name="currency" id="currency">
                            <option value="UZS" <?php if($application->currency === "UZS"): ?> selected <?php endif; ?>>UZS</option>
                            <option value="USD" <?php if($application->currency === "USD"): ?> selected <?php endif; ?>>USD</option>
                        </select>
                    </div>
                    <div class="product">
                        <?php if(isset($application->resource_id)): ?>
                            <b><?php echo e(__('Продукт')); ?></b>:
                            <?php $__currentLoopData = json_decode($application->resource_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <br> <?php echo e(\App\Models\Resource::find($product)->name); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="flex-direction: column">
                        <?php if($file_basis != 'null' && $file_basis != null): ?>
                            <div class="my-5">
                                <h5 class="text-left"><?php echo e(__('Основание')); ?></h5>
                                <?php $__currentLoopData = $file_basis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(\Illuminate\Support\Str::contains($file,'jpg')||\Illuminate\Support\Str::contains($file,'png')||\Illuminate\Support\Str::contains($file,'svg')): ?>
                                        <img src="/storage/uploads/<?php echo e($file); ?>" width="500" height="500" alt="not found">
                                    <?php else: ?>
                                        <button type="button" class="btn btn-primary"><a style="color: white;" href="/storage/uploads/<?php echo e($file); ?>"><?php echo e(preg_replace('/[0-9]+_/', '', $file)); ?></a></button>
                                        <p class="my-2"><?php echo e(preg_replace('/[0-9]+_/', '', $file)); ?></p>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                        <?php if($file_tech_spec != 'null' && $file_tech_spec != null): ?>
                            <div class="mb-5">
                                <h5 class="text-left"><?php echo e(__('Техническое задание')); ?></h5>
                                <?php $__currentLoopData = $file_tech_spec; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(\Illuminate\Support\Str::contains($file,'jpg')||\Illuminate\Support\Str::contains($file,'png')||\Illuminate\Support\Str::contains($file,'svg')): ?>
                                        <img src="/storage/uploads/<?php echo e($file); ?>" width="500" height="500" alt="not found">
                                    <?php else: ?>
                                        <button type="button" class="btn btn-primary"><a style="color: white;" href="/storage/uploads/<?php echo e($file); ?>"><?php echo e(preg_replace('/[0-9]+_/', '', $file)); ?></a></button>
                                        <p class="my-2"><?php echo e(preg_replace('/[0-9]+_/', '', $file)); ?></p>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                        <?php if($other_files != 'null' && $other_files != null): ?>
                            <div class="mb-5" style="width: 80%">
                                <h5 class="text-left"><?php echo e(__('Другие документы необходимые для запуска закупочной процедуры')); ?></h5>
                                <?php $__currentLoopData = $other_files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(\Illuminate\Support\Str::contains($file,'jpg')||\Illuminate\Support\Str::contains($file,'png')||\Illuminate\Support\Str::contains($file,'svg')): ?>
                                        <img src="/storage/uploads/<?php echo e($file); ?>" width="500" height="500" alt="not found">
                                    <?php else: ?>
                                        <button type="button" class="btn btn-primary"><a style="color: white;" href="/storage/uploads/<?php echo e($file); ?>"><?php echo e(preg_replace('/[0-9]+_/', '', $file)); ?></a></button>
                                        <p class="my-2"><?php echo e(preg_replace('/[0-9]+_/', '', $file)); ?></p>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-6">
                <table id="yajra-datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo e(__('Статус заявки')); ?></th>
                            <th><?php echo e(__('Роль')); ?></th>
                            <th><?php echo e(__('Комментарий')); ?></th>
                            <th><?php echo e(__('Пользователь')); ?></th>
                            <th class="hidden">Index</th>
                            <th>Дата подписи</th>
                        </tr>
                    </thead>
                </table>
            </div>

    <script>
            $(function () {
                var table = $('#yajra-datatable').DataTable({
                    processing: true,
                    order: [[5, 'asc']],
                    serverSide: true,
                    ajax: "<?php echo e(route('site.applications.list.signedocs',$application->id)); ?>",
                    columnDefs :[
                        {
                            targets : 5,
                            className : 'hidden',
                        }
                    ],
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'status', name: 'status'},
                        {data: 'role_id', name: 'role_id'},
                        {data: 'comment', name: 'comment'},
                        {data: 'user_id', name: 'user_id'},
                        {data: 'role_index', name: 'role_index'},
                        {data: 'updated_at', name: 'updated_at'},
                    ]
                });
            })
            </script>

    <div class="px-6 pb-4">
        <?php echo e(Aire::open()
    ->route('site.applications.update',$application->id)
    ->enctype("multipart/form-data")
    ->post()); ?>

        <?php if($check && $user->hasPermission('Plan_Budget') && $application->user_id != auth()->user()->id || $user->hasPermission('Plan_Business') && $check && $application->user_id != auth()->user()->id): ?>
            <?php echo e(Aire::textArea('bio', __('Информация о наличии в «Плане закупок» приобретаемых товаров'))
                ->name('info_purchase_plan')
                ->value($application->info_purchase_plan)
                ->rows(3)
                ->cols(40)); ?>

            <?php echo e(Aire::textArea('bio', __('Статья расходов по Бизнес плану'))
                ->name('info_business_plan')
                ->value($application->info_business_plan)
                ->rows(3)
                ->cols(40)); ?>


            <?php if($check && $user->hasPermission('Number_Change')): ?>
                <?php echo e(Aire::textArea('bio', __('Номер заявки'))
                    ->name('number')
                    ->value($application->number)); ?>

                <div class="mb-3 row w-50">
                    <label class="col-sm-6" for="date" class="col-sm-2 col-form-label">
                        <?php echo e(__('Дата заявки')); ?>

                    </label>
                    <input class="form-control" id="date" name="date" type="date" value="<?php echo e($application->date); ?>"/>
                </div>
            <?php endif; ?>
            <?php echo e(Aire::submit('Save')); ?>


        <?php elseif($check && $user->hasPermission('Number_Change') && !$user->hasPermission('Plan_Budget') && !$user->hasPermission('Plan_Business') && $application->user_id != auth()->user()->id): ?>
            <?php echo e(Aire::textArea('bio', __('Номер заявки'))
                ->name('number')
                ->value($application->number)); ?>

            <div class="mb-3 row w-50">
                <label class="col-sm-6" for="date" class="col-sm-2 col-form-label">
                    <?php echo e(__('Дата заявки')); ?>

                </label>
                <div class="col-sm-6">
                    <input class="form-control" id="date" name="date" type="date" value="<?php echo e($application->date); ?>"/>
                </div>
            </div>
            <?php echo e(Aire::submit('Save')); ?>

        <?php endif; ?>
        <?php if($application->user_id != auth()->user()->id && auth()->user()->hasPermission('Company_Leader') && $application->status == 'agreed'): ?>
            <?php if(!isset($application->performer_user_id)): ?>
                <div class="pb-5">
                    <input type="text" class="hidden" value="<?php echo e(auth()->user()->id); ?>" name="branch_leader_user_id">
                    <?php echo e(Aire::textArea('bio', __('Комментарий руководства'))
                            ->name('branch_leader_comment')
                            ->value($application->branch_leader_comment)
                            ->rows(3)
                            ->cols(40)); ?>

                    <?php if($application->is_more_than_limit != 1): ?>
                        <?php echo e(Aire::select($performers_branch, 'select')
                            ->name('performer_role_id')); ?>

                    <?php else: ?>
                        <?php echo e(Aire::select($performers_company, 'select')
                            ->name('performer_role_id')); ?>

                    <?php endif; ?>
                    <button type="submit" class="btn btn-success col-md-2" ><?php echo e(__('Отправить')); ?></button>
                </div>
            <?php endif; ?>
        <?php elseif($application->user_id != auth()->user()->id && auth()->user()->hasPermission('Branch_Leader') && $application->show_leader == 1): ?>
            <?php if(!isset($application->performer_user_id)): ?>
                <div class="pb-5">
                    <input type="text" class="hidden" value="<?php echo e(auth()->user()->id); ?>" name="branch_leader_user_id">
                    <?php echo e(Aire::textArea('bio', __('Комментарий руководства'))
                            ->name('branch_leader_comment')
                            ->value($application->branch_leader_comment)
                            ->rows(3)
                            ->cols(40)); ?>

                    <?php if($application->is_more_than_limit != 1): ?>
                        <?php echo e(Aire::select($performers_branch, 'select')
                            ->name('performer_role_id')); ?>

                    <?php else: ?>
                        <?php echo e(Aire::select($performers_company, 'select')
                            ->name('performer_role_id')); ?>

                    <?php endif; ?>
                    <button type="submit" class="btn btn-success col-md-2" ><?php echo e(__('Отправить')); ?></button>
                </div>
            <?php endif; ?>
        <?php elseif($application->performer_role_id == $user->role_id && $user->leader == 1): ?>
            <?php echo e(Aire::textArea('bio', __('Комментарии начальника'))
                ->name('performer_leader_comment')
                ->value($application->performer_leader_comment)
                ->rows(3)
                ->cols(40)); ?>

            <input  class="hidden"
                    name="performer_leader_user_id"
                    value="<?php echo e(auth()->user()->id); ?>"
                    type="text">
            <div class="mt-4">
                <button type="submit" class="btn btn-success col-md-2" ><?php echo e(__('Отправить')); ?></button>
            </div>
        <?php elseif($application->performer_role_id == $user->role_id && $user->leader == 0): ?>
            <?php echo e(Aire::textArea('bio', __('Комментарий'))
                ->name('performer_comment')
                ->value($application->performer_comment)
                ->rows(3)
                ->cols(40)); ?>

            <input  class="hidden"
                    name="performer_user_id"
                    value="<?php echo e(auth()->user()->id); ?>"
                    type="text">
            <div class="mt-4">
                <button type="submit" class="btn btn-success col-md-2" ><?php echo e(__('Отправить')); ?></button>
            </div>
        <?php endif; ?>
        <?php echo e(Aire::close()); ?>

    </div>
    <?php if($access && $user->hasPermission('Company_Signer'||'Add_Company_Signer'||'Branch_Signer'||'Add_Branch_Signer'||'Company_Performer'||'Branch_Performer') || $user->role_id == 7 && $application->show_director == 1): ?>
        <div class="px-6">
            <form name="testform" action="<?php echo e(route('eimzo.sign.verify')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <label id="message"></label>
                <div class="form-group">
                    <label for="select1">
                        <?php echo e(__('Выберите ключ')); ?>

                    </label>
                    <select name="key" id="select1" onchange="cbChanged(this)"></select> <br />
                </div>
                <div class="form-group hidden">
                    <label for="exampleFormControlTextarea1">
                        <?php echo e(__('Подпись текста')); ?>

                    </label>
                    <textarea class="form-control" id="eri_data" name="data" rows="3"></textarea>
                </div>
                <div class="mb-2 text-center mr-6">
                    <?php echo e(__('Идентификатор ключа')); ?> <label id="keyId"></label><br />

                    <button onclick="generatekey()" class="hidden btn btn-success" type="button"><?php echo e(__('Подпись')); ?></button><br />
                </div>
                <div class="w-1/2">
                    <?php echo e(Aire::textArea('bio', __('Комментарий'))
                    ->name('comment')
                    ->rows(3)
                    ->cols(40)); ?>

                </div>
                <div class="form-group hidden">
                    <label for="exampleFormControlTextarea3">
                        Подписанный документ PKCS#7
                    </label>
                    <textarea   class="form-control" readonly required
                                name="pkcs7" id="exampleFormControlTextarea3"
                                rows="3"></textarea>
                </div> <br />
                <input id="status" name="status" class="hidden" type="text">
                <input value="applications" id="table_name" name="table_name" class="hidden" type="text">
                <input value="<?php echo e($application->id); ?>" id="application_id" name="application_id" class="hidden" type="text">
                <input value="<?php echo e(auth()->user()->id); ?>" name="user_id" class="hidden" type="text">
                <input value="<?php echo e(auth()->user()->role_id); ?>" name="role_id" class="hidden" type="text">
                <div class="row ml-4 pb-4">
                    <button onclick="status1()" type="submit" class="btn btn-success col-md-2" >
                        <?php echo e(__('Принять')); ?>

                    </button>
                    <button onclick="status0()" type="submit" class="btn btn-danger col-md-2 mx-2   " >
                        <?php echo e(__('Отказ')); ?>

                    </button>
                </div>
            </form>
        </div>
    <?php endif; ?>

   <div class="flex flex-row gap-x-4">
       <div class="performer-div border-2 rounded-xl border-gray-500 w-1/2 p-3 m-6 flex flex-row gap-x-4">
           <div class="w-1/2">
               <div class="w-full">
                   <?php echo e(Aire::select($branch, 'select', __('Филиал заказчик по контракту'))
                       ->value($application->branch_customer_id)
                       ->disabled()); ?>

                   <?php echo e(Aire::input('bio', __('Номер лота'))
                       ->value($application->lot_number)
                       ->disabled()); ?>

                   <?php echo e(Aire::input('bio', __('Номер договора'))
                       ->value($application->contract_number)
                       ->disabled()); ?>.
                   <?php echo e(Aire::date('date_input', __('Дата договора'))
                       ->value($application->contract_date)
                       ->disabled()); ?>

                   <?php echo e(Aire::input('bio', __('Номер протокола'))
                       ->value($application->protocol_number)
                       ->disabled()); ?>

                   <?php echo e(Aire::date('bio', __('Дата протокола'))
                       ->value($application->protocol_date)
                       ->disabled()); ?>

                   <?php echo e(Aire::textArea('bio', __('Предмет договора (контракта) и краткая характеристика'))
                       ->value($application->contract_info)
                       ->rows(3)
                       ->cols(40)
                       ->disabled()); ?>

                   <?php echo e(Aire::checkbox('checkbox', __('С НДС'))
                       ->disabled()); ?>

                   <?php echo e(Aire::input('bio', __('Cумма договора'))
                       ->value($application->contract_price)
                       ->disabled()); ?>

               </div>
               <div class="w-full">
                   <?php echo e(Aire::input('bio', __('Товары (обслуживание) страна изготовленной'))
                       ->value($application->country_produced_id)
                       ->disabled()); ?>



                   <?php echo e(Aire::input('bio', __('Наименование поставщика'))
                       ->value($application->supplier_name)
                       ->disabled()); ?>

                   <?php echo e(Aire::input('bio', __('Поставщик Перемешать номер'))
                       ->value($application->supplier_inn)
                       ->disabled()); ?>

                   <?php echo e(Aire::textArea('bio', __('Информация о товаре'))
                       ->value($application->product_info)
                       ->rows(3)
                       ->cols(40)
                       ->disabled()); ?>


                   <div class="mr-4 pt-2 pb-2 w-50">
                       <?php echo e(Aire::input( 'select', __('Предмет закупки'))
                           ->value($application->subjects->name)
                           ->disabled()); ?>

                   </div>
                   <div class="pt-2 pb-2 w-50">
                       <?php echo e(Aire::input( 'select', __('Вид закупки'))
                           ->value($application->purchase->name)
                           ->disabled()); ?>

                   </div>
                   <?php echo e(Aire::input( 'select')
                       ->value($application->performer_status)
                       ->disabled()); ?>

               </div>
           </div>
           <div class="w-1/2">
               <div class="mb-5">
                   <?php if($performer_file != 'null' && $performer_file != null): ?>
                       <h5 class="text-left"><?php echo e(__('Файл исполнителя')); ?></h5>
                       <?php $__currentLoopData = $performer_file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php if(\Illuminate\Support\Str::contains($file,'jpg')||\Illuminate\Support\Str::contains($file,'png')||\Illuminate\Support\Str::contains($file,'svg')): ?>
                               <img src="/storage/uploads/<?php echo e($file); ?>" width="500" height="500" alt="not found">
                           <?php else: ?>
                               <button type="button" class="btn btn-primary"><a style="color: white;" href="/storage/uploads/<?php echo e($file); ?>"><?php echo e(preg_replace('/[0-9]+_/', '', $file)); ?></a></button>
                               <p class="my-2"><?php echo e(preg_replace('/[0-9]+_/', '', $file)); ?></p>
                           <?php endif; ?>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
               </div>

           </div>
       </div>
       <div class="w-1/2 p-6">
           <?php if(isset($application->branch_leader_comment)): ?>
               <?php
                   $comment = \App\Models\User::find($application->branch_leader_user_id)->name;
               ?>
               <?php echo e(Aire::textArea('bio', __('Комментарий руководства') . ": {$comment}")
               ->value($application->branch_leader_comment)
               ->rows(3)
               ->cols(40)
               ->disabled()); ?>

           <?php endif; ?>
           <?php if(isset($application->performer_leader_comment)): ?>
               <?php
                   $comment = \App\Models\User::find($application->performer_leader_user_id)->name;
               ?>
               <?php echo e(Aire::textArea('bio', __('Комментарии начальника') . ": {$comment}")
                   ->value($application->performer_leader_comment)
                   ->rows(3)
                   ->cols(40)
                   ->disabled()); ?>

           <?php endif; ?>
           <?php if(isset($application->performer_comment)): ?>
               <?php
                   $comment = \App\Models\User::find($application->performer_user_id)->name;
               ?>
               <?php echo e(Aire::textArea('bio', __('Комментарии исполнителя') . ": {$comment}")
                   ->value($application->performer_comment)
                   ->rows(3)
                   ->cols(40)
                   ->disabled()); ?>

           <?php endif; ?>
           <?php if(isset($application->performer_role_id)): ?>
               <?php echo e(Aire::textArea('bio', __('Исполнитель'))
                   ->value(\App\Models\Roles::find($application->performer_role_id)->display_name)
                   ->rows(3)
                   ->cols(40)
                   ->disabled()); ?>

           <?php endif; ?>
       </div>
   </div>
    <script>
        function generatekey()
        {
            var data = "application_<?php echo e($application->id); ?>";
            document.getElementById('eri_data').value = data;
            console.log(data);
            sign();
        }
        function status1()
        {
            document.getElementById('status').value = 1;
        }
        function status0()
        {
            document.getElementById('status').value = 0;
        }
        function functionBack()
        {
            window.history.back();
        }
    </script>

<script src="<?php echo e(asset('vendor/eimzo/assets/js/eimzo/e-imzo.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/eimzo/assets/js/eimzo/e-imzo-client.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/eimzo/assets/js/eimzo/eimzo.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Develop\Panels\OpenServer\domains\laravel_voyager_uztelecom\resources\views/site/applications/show.blade.php ENDPATH**/ ?>