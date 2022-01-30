<?php $__env->startSection('breadcrumb'); ?>
    <li>INICIO</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3><?php echo e(greetings()); ?>, <?php echo e(auth()->user()->fullname); ?> ( <?php echo e(auth()->user()->username); ?> )</h3>
                </div>
                <div class="card-action">
                    <h3 class="pull-right"><?php echo e(fulldate()); ?></h3>
                </div>
            <div class="clearfix">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">

                    <!--  Card Body -->
                    <div id="example">
                        <div class="k-card-deck-scrollwrap">
                            <button class="k-button k-button-solid-base k-button-solid k-button-rectangle k-button-md k-rounded-md k-flat k-icon-button k-button-scroll">
                                <span class="k-button-icon k-icon k-i-arrow-chevron-left"></span>
                            </button>
                            <div class="k-card-deck">
                                <div class="k-card k-card-type-rich">
                                    <div class="new-pedido-entity" id="num_mesa1" onclick="obtenerid(this.id)">
                                    <img src="<?php echo e(asset('img/mesa1.jpg')); ?>" alt="undefined" class="k-card-image">
                                    <div class="k-card-actions k-card-actions-stretched k-card-actions-vertical">
                                    <span class="k-card-action">
                                    <button type="button" class="k-button btn btn-primary">Registrar Pedido</button>
                                    </span>
                                    </div>
                                </div>                                 
                            </div>
                            <div class="k-card k-card-type-rich">
                                <div class="new-pedido-entity" id="num_mesa2" onclick="obtenerid(this.id)">
                                    <img src="<?php echo e(asset('img/mesa2.jpg')); ?>" alt="undefined" class="k-card-image">  
                                    <div class="k-card-actions k-card-actions-stretched k-card-actions-vertical">
                                        <span class="k-card-action">
                                            <button type="button" class="k-button btn btn-primary">Registrar Pedido</button>
                                        </span>
                                    </div>
                                </div>                                  
                            </div>
                            <div class="k-card k-card-type-rich">
                                <div class="new-pedido-entity" id="num_mesa3" onclick="obtenerid(this.id)">
                                    <img src="<?php echo e(asset('img/mesa3.jpg')); ?>" alt="undefined" class="k-card-image">                            
                                    <div class="k-card-actions k-card-actions-stretched k-card-actions-vertical">
                                        <span class="k-card-action">
                                            <button type="button" class="k-button btn btn-primary">Registrar Pedido</button>
                                        </span>
                                    </div>
                                </div>    
                            </div>
                            <div class="k-card k-card-type-rich">
                                <div class="new-pedido-entity" id="num_mesa4" onclick="obtenerid(this.id)">
                                    <img src="<?php echo e(asset('img/mesa4.jpg')); ?>" alt="undefined" class="k-card-image">                              
                                    <div class="k-card-actions k-card-actions-stretched k-card-actions-vertical">
                                        <span class="k-card-action">
                                            <button type="button" class="k-button btn btn-primary">Registrar Pedido</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="k-card k-card-type-rich">
                                <div class="new-pedido-entity"  id="num_mesa5" onclick="obtenerid(this.id)">
                                    <img src="<?php echo e(asset('img/mesa5.jpg')); ?>" alt="undefined" class="k-card-image">
                                    <div class="k-card-actions k-card-actions-stretched k-card-actions-vertical">
                                        <span class="k-card-action">
                                            <button type="button" class="k-button btn btn-primary">Registrar Pedido</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="k-card k-card-type-rich">
                                <div class="new-pedido-entity"  id="num_mesa6" onclick="obtenerid(this.id)">
                                    <img src="<?php echo e(asset('img/mesa6.jpg')); ?>" alt="undefined" class="k-card-image"> 
                                    <div class="k-card-actions k-card-actions-stretched k-card-actions-vertical">
                                        <span class="k-card-action">
                                            <button type="button" class="k-button btn btn-primary">Registrar Pedido</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <button class="k-button k-button-solid-base k-button-solid k-button-rectangle k-button-md k-rounded-md k-flat k-icon-button k-button-scroll">
                            <span class="k-icon k-i-arrow-chevron-right"></span>
                        </button>
                    </div>
                </div>
                <!-- end Card Body-->

            </div>
        </div>
    </div>
</div>
        <div class="card-body">
            <div class="content-kendo"></div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.foot', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>