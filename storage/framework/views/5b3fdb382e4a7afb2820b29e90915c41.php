<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e($car->name); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col w-full items-center justify-between bg-white pb-16">
                <div class="w-full space-y-10">
                    <div class="">
                        <img src="<?php echo e(url($car->image)); ?>" alt="<?php echo e($car->name); ?>" class="w-full object-cover">
                    </div>

                    <div class="flex flex-col justify-center items-center gap-y-2">
                        <p class="text-4xl font-bold">Rp
                            <?php echo e(number_format($car->cost, 0, ',', '.')); ?></p>
                        <p class="text-2xl text-gray-600">Transmisi:
                            <?php echo e(ucwords(str_replace('_', ' ', $car->transmission))); ?></p>
                        <p class="text-xl text-gray-600">
                            Kursi: <?php echo e($car->seat); ?>

                        </p>
                    </div>

                </div>

                <div class="max-w-4xl mx-auto mt-16">
                    <form action="<?php echo e(route('rent.store', $car->id)); ?>" method="POST" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="w-full">
                                <label for="tgl_mulai" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Mulai:
                                </label>
                                <div class="flex items-center border rounded-lg px-3 py-2">
                                    <span class="mr-2 text-gray-500">📅</span>
                                    <input type="date" id="tgl_mulai" name="tgl_mulai"
                                        class="w-full outline-none border-0 focus:ring-0" required>
                                </div>
                            </div>

                            <div class="w-full">
                                <label for="tgl_selesai" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Selesai:
                                </label>
                                <div class="flex items-center border rounded-lg px-3 py-2">
                                    <span class="mr-2 text-gray-500">📅</span>
                                    <input type="date" id="tgl_selesai" name="tgl_selesai"
                                        class="w-full outline-none border-0 focus:ring-0" required>
                                </div>
                            </div>
                        </div>

                        
                        <div>
                            <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['type' => 'submit','class' => 'w-full items-center justify-center !text-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','class' => 'w-full items-center justify-center !text-lg']); ?>
                                Rental Sekarang
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

     <?php $__env->slot('script', null, []); ?> 
        <script>
            const car = <?php echo json_encode($car, 15, 512) ?>;
            if (car.status != 1) {
                alert("Mobil ini tidak tersedia untuk dibooking!");
                window.history.back();
            };
        </script>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH D:\LARAVEL\tugas-rental\resources\views/rent-view.blade.php ENDPATH**/ ?>