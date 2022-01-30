<nav class="navbar navbar-default" role="navigation">
    <div class="side-menu-container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <div class="col-xs-4"><img src="<?php echo e(asset('img/logo_gilat.png')); ?>" height="30"></div>
                <span class="title">GILAT</span>
            </a>
            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                <i class="fa fa-times icon"></i>
            </button>
        </div>
        <ul class="nav navbar-nav">
            <?php echo $__env->renderEach('layouts.admin.sidebar-menu', $sidebarMenu, 'menu', 'layouts.admin.sidebar-menu-none'); ?>
        </ul>
    </div>
</nav>
