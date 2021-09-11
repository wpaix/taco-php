<?php if(1): ?> <?php echo $__env->make('partial1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?>
<?php if(0): ?> <?php echo $__env->make('subviews/partial2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?>

<h1>I am name: <?php echo e($name); ?></h1>
<?php if(1): ?>
Something is true
<?php endif; ?>
<?php if(0): ?>
Something is not true
<?php endif; ?>
<pre>
    <?php echo e(print_r([1,2,today_date(),3,4])); ?>

</pre>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro laudantium est distinctio quaerat, magni error, quod qui accusamus velit numquam quia aliquam labore cupiditate id amet vitae dolor eveniet voluptatibus!</p><?php /**PATH /Users/william/code/tv2jul.test/app/views/joe.blade.php ENDPATH**/ ?>