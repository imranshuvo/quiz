<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title><?php echo e($title ?? 'Laravel'); ?></title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
<?php echo app('flux')->fluxAppearance(); ?>

<?php /**PATH /Users/imrankhan/Sites/quiz/resources/views/partials/head.blade.php ENDPATH**/ ?>