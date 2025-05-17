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

    $cars = $cars->limit(12)->get();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="bg-white text-gray-900">

    
    <section
        class="relative min-h-screen flex items-center justify-center text-center px-6 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 text-white">
        <div class="relative z-10 max-w-2xl">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4">Rental Mobil</h1>
            <p class="text-lg md:text-xl mb-6">Sewa mobil terpercaya dengan harga terjangkau dan proses mudah, kapan
                saja dan di mana saja.</p>
            <a href="<?php echo e(route('login')); ?>"
                class="inline-block bg-white text-blue-700 font-semibold px-6 py-3 rounded-lg shadow hover:bg-blue-100 transition">
                Mulai Rental
            </a>
        </div>
    </section>

    
    <section class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-6xl mx-auto">
            
            <form method="GET" class="flex flex-wrap items-center gap-4 mb-6">
                <div>
                    <label for="transmission" class="text-sm font-medium">Filter Transmisi:</label>
                    <select name="transmission" id="transmission" onchange="this.form.submit()"
                        class="border rounded-lg p-2">
                        <option value="">Semua</option>
                        <option value="manual" <?php echo e(request('transmission') === 'manual' ? 'selected' : ''); ?>>Manual
                        </option>
                        <option value="semi_otomatis"
                            <?php echo e(request('transmission') === 'semi_otomatis' ? 'selected' : ''); ?>>Semi Otomatis</option>
                        <option value="otomatis" <?php echo e(request('transmission') === 'otomatis' ? 'selected' : ''); ?>>Otomatis
                        </option>
                    </select>
                </div>

                <div>
                    <label for="sort" class="text-sm font-medium">Urutkan berdasarkan:</label>
                    <select name="sort" id="sort" onchange="this.form.submit()" class="border rounded-lg p-2">
                        <option value="">Default</option>
                        <option value="cost_asc" <?php echo e(request('sort') === 'cost_asc' ? 'selected' : ''); ?>>Harga Termurah
                        </option>
                        <option value="cost_desc" <?php echo e(request('sort') === 'cost_desc' ? 'selected' : ''); ?>>Harga Termahal
                        </option>
                        <option value="seat" <?php echo e(request('sort') === 'seat' ? 'selected' : ''); ?>>Jumlah Kursi</option>
                    </select>
                </div>
            </form>

            
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-x-4">
                <?php $__empty_1 = true; $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div>

                        <div class="rounded-xl border bg-white p-4 shadow-sm hover:shadow-md transition relative">
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
                                <a href="<?php echo e(route('login')); ?>">
                                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'pointer-events-none']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'pointer-events-none']); ?>
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
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="col-span-full text-center text-gray-500">Mobil tidak ditemukan sesuai filter.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

</body>

</html>
<?php /**PATH D:\LARAVEL\tugas-rental\resources\views/welcome.blade.php ENDPATH**/ ?>