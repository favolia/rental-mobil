<?php
    use App\Models\Car;

    $cars = Car::query();

    // Filter transmisi
    if (request('transmission')) {
        $cars->where('transmission', request('transmission'));
    }

    // Sortir
    switch (request('sort')) {
        case 'cost_asc':
            $cars->orderBy('cost', 'asc');
            break;
        case 'cost_desc':
            $cars->orderBy('cost', 'desc');
            break;
        case 'seat':
            $cars->orderBy('seat');
            break;
        default:
            $cars->latest();
    }

    $cars = $cars->latest()->get();
?>

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
                Mobil
            </h2>

            <div>
                <form method="GET" class="flex flex-wrap items-center gap-4">
                    <div>
                        <label for="transmission" class="text-sm font-medium">Filter Transmisi:</label>
                        <select name="transmission" id="transmission" onchange="this.form.submit()"
                            class="border rounded-lg px-2 py-1">
                            <option value="">Semua</option>
                            <option value="manual" <?php echo e(request('transmission') === 'manual' ? 'selected' : ''); ?>>
                                Manual
                            </option>
                            <option value="semi_otomatis"
                                <?php echo e(request('transmission') === 'semi_otomatis' ? 'selected' : ''); ?>>Semi Otomatis
                            </option>
                            <option value="otomatis" <?php echo e(request('transmission') === 'otomatis' ? 'selected' : ''); ?>>
                                Otomatis
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="sort" class="text-sm font-medium">Urutkan berdasarkan:</label>
                        <select name="sort" id="sort" onchange="this.form.submit()"
                            class="border rounded-lg px-2 py-1">
                            <option value="">Default</option>
                            <option value="cost_asc" <?php echo e(request('sort') === 'cost_asc' ? 'selected' : ''); ?>>Harga
                                Termurah
                            </option>
                            <option value="cost_desc" <?php echo e(request('sort') === 'cost_desc' ? 'selected' : ''); ?>>Harga
                                Termahal
                            </option>
                            <option value="seat" <?php echo e(request('sort') === 'seat' ? 'selected' : ''); ?>>Jumlah Kursi
                            </option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-x-4">
                        <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($car->status == 1 ? route('rent', $car->id) : '#'); ?>"
                                class="<?php echo e($car->status == 1 ? 'opacity-100' : 'opacity-70 pointer-events-none'); ?>">
                                <div class="pointer-events-none">

                                    <div
                                        class="rounded-xl border bg-white p-4 shadow-sm hover:shadow-md transition relative">
                                        <img src="<?php echo e($car->image); ?>" alt="<?php echo e($car->name); ?>"
                                            class="h-60 md:h-[28rem] lg:h-40 w-full object-cover object-center rounded-lg mb-4"
                                            draggable="false">

                                        <div class="space-y-1">
                                            <h2 class="text-lg font-semibold text-gray-800"><?php echo e($car->name); ?></h2>
                                            <p class="text-sm text-gray-600">Transmisi:
                                                <?php echo e(ucwords(str_replace('_', ' ', $car->transmission))); ?></p>
                                            <p class="text-sm text-gray-600">Kursi: <?php echo e($car->seat); ?></p>
                                            <p class="text-sm text-gray-600">Harga: Rp
                                                <?php echo e(number_format($car->cost, 0, ',', '.')); ?></p>
                                            <div class="text-sm text-gray-600 flex justify-start items-center gap-1">
                                                Status:
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['type' => 'submit','class' => ''.e($car->status !== 1 ? 'bg-red-600' : '').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','class' => ''.e($car->status !== 1 ? 'bg-red-600' : '').'']); ?>
                                                <?php echo e($car->status !== 1 ? 'Tidak tersedia' : 'Rental'); ?>

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
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div></div>

     <?php $__env->slot('script', null, []); ?> 
        <?php if(session('error')): ?>
            <script>
                alert('<?php echo e(session('error')); ?>');
            </script>
        <?php endif; ?>
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
<?php /**PATH D:\LARAVEL\tugas-rental\resources\views/cars_view_user.blade.php ENDPATH**/ ?>