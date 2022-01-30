<?php if(isset($menu['children'])): ?> 
    <li class="panel panel-default dropdown">
        <a data-toggle="collapse" href="#dropdown-<?php echo e($menu['id']); ?>"> 
<?php else: ?> 
    <li> 
        <?php if($menu['tree_role']===0): ?>
            <?php
                $explode=explode("|",$menu['description']);
                $description_id=$explode[1];
            ?>
            <a href="<?php echo e(route($menu['url'], $description_id)); ?>"> 
        <?php else: ?>
            <a href="<?php echo e($menu['url'] ? route($menu['url']) : '#'); ?>"> 
        <?php endif; ?>
        
<?php endif; ?>

        <?php if($menu['icon']): ?> 
            <span class="icon <?php echo e($menu['icon']); ?>"></span>
        <?php endif; ?> 

            <span class="title" title="<?php echo e(strlen($menu['display_name']) > 31 ? $menu['display_name'] : ''); ?>"><?php echo e(str_limit($menu['display_name'], 31)); ?></span>

        </a>
                
    	<?php if(isset($menu['children'])): ?>
    	    <div id="dropdown-<?php echo e($menu['id']); ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="nav navbar-nav">
                        <?php $__currentLoopData = $menu['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('layouts.admin.sidebar-menu', $menu, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>            
        <?php endif; ?>
    </li>
  
