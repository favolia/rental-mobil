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
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Mobil')); ?>

            </h2>


            <div x-data="{ open: false }">
                <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['@click' => 'open = true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click' => 'open = true']); ?>Tambah Mobil <?php echo $__env->renderComponent(); ?>
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
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-x-4">
                        <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div x-data="{ open: false }">
                                
                                

                                
                                <div
                                    class="rounded-xl border bg-white p-4 shadow-sm hover:shadow-md transition relative">
                                    <img src="<?php echo e($car->image); ?>" alt="<?php echo e($car->name); ?>"
                                        class="h-60 md:h-[28rem] lg:h-40 w-full object-cover object-center rounded-lg mb-4">

                                    <div class="space-y-1">
                                        <h2 class="text-lg font-semibold text-gray-800"><?php echo e($car->name); ?></h2>
                                        <p class="text-sm text-gray-600">Transmisi:
                                            <?php echo e(ucwords(str_replace('_', ' ', $car->transmission))); ?></p>
                                        <p class="text-sm text-gray-600">Kursi: <?php echo e($car->seat); ?></p>
                                        <p class="text-sm text-gray-600">Harga: Rp
                                            <?php echo e(number_format($car->cost, 0, ',', '.')); ?></p>
                                        <div class="text-sm text-gray-600 flex justify-start items-center gap-1">Status:
                                            <div class="relative">
                                                <span
                                                    class="<?php echo e($car->status == '1' ? 'bg-green-600' : 'bg-red-600'); ?> size-3 rounded-full block absolute"></span>
                                                <span
                                                    class="<?php echo e($car->status == '1' ? 'bg-green-600' : 'bg-red-600'); ?> size-3 rounded-full animate-ping block"></span>
                                            </div>
                                        </div>
                                    </div>


                                    
                                    <div class="absolute scale-[.8] origin-top-right top-0 right-0">
                                        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit']); ?>
                                            Rental
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
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div></div>

     <?php $__env->slot('script', null, []); ?> 
        <script>
            // document.querySelectorAll('form[id^="carForm-"]').forEach(form => {
            //     form.addEventListener('submit', async function(e) {
            //         e.preventDefault();

            //         const formData = new FormData(form);
            //         const csrf = form.querySelector('input[name="_token"]').value;
            //         const methodInput = form.querySelector('input[name="_method"]');
            //         const method = methodInput ? methodInput.value : 'POST';

            //         try {
            //             const res = await fetch(form.action, {
            //                 method: method,
            //                 headers: {
            //                     'X-CSRF-TOKEN': csrf
            //                 },
            //                 body: formData
            //             });

            //             const data = await res.json();

            //             if (data.status === 'success') {
            //                 window.location.reload();
            //             } else {
            //                 alert(data.message || 'Gagal menyimpan data.');
            //             }
            //         } catch (error) {
            //             console.error(error);
            //             alert('Terjadi kesalahan saat mengirim data.');
            //         }
            //     });
            // });
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
<?php /**PATH D:\LARAVEL\tugas-rental\resources\views/cars_view_guest.blade.php ENDPATH**/ ?>