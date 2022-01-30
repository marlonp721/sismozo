<?php $__env->startSection('breadcrumb'); ?>
    <li>INICIO</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">

                <div class="card-title">
                    <h3>Bienvenido, <?php echo e(auth()->user()->fullname); ?> ( <?php echo e(auth()->user()->username); ?> )</h3>
                </div>
                <div class="card-action">
                    <h3 class="pull-right"><?php echo e(fulldate()); ?></h3>
                </div>
            <div class="clearfix"></div>
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

            <!-- <div class="k-card k-card-type-rich">
                <img src="<?php echo e(asset('img/mesa2.jpg')); ?>" alt="undefined" class="k-card-image">

                <div class="k-card-actions k-card-actions-stretched k-card-actions-vertical">
                    <span class="k-card-action">
                    <button type="button" class="k-button btn btn-primary"  data-toggle="modal" data-target="#myModal" id="mesa5" value="MESA 5" onclick="fid(this)">Registrar Pedido</button>
                    </span>
                </div>
            </div> -->

        </div>
        <button class="k-button k-button-solid-base k-button-solid k-button-rectangle k-button-md k-rounded-md k-flat k-icon-button k-button-scroll">
            <span class="k-icon k-i-arrow-chevron-right"></span>
        </button>
    </div>

    <script>
        function scrollButtonClick(e) {
            var button = $(e.currentTarget);
            var scrollToLeft = button.find(".k-i-arrow-chevron-left").length !== 0;
            var scrollContainer = $(".k-card-deck").eq(0);
            var lastCard = scrollContainer.find(".k-card").last();
            var cardWidth = lastCard.outerWidth(true);


            if (scrollToLeft) {
                scrollContainer.scrollLeft(scrollContainer.scrollLeft() - cardWidth);
            } else {
                scrollContainer.scrollLeft(scrollContainer.scrollLeft() + cardWidth);
            }
        };

        $(document).ready(function () {
            var cardDeck = $(".k-card-deck-scrollwrap").eq(0);

            cardDeck.on("click", ".k-button-scroll", scrollButtonClick);
        });
    </script>

    <style>
        #example {
            display: flex;
            justify-content: center;
        }

        .k-card-deck-scrollwrap {
            max-width: 2000px;
        }

        .k-card-deck {
            box-sizing: border-box;
            margin-left: -16px;
            margin-right: -16px;
            padding: 16px 16px 16px;
            overflow-y: hidden;
            overflow-x: auto;
        }

        .k-card-action > .k-button{
            width: 100%;
        }
    </style>
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

<!-- DELETE FORM -->

<?php echo Form::open([ 'route' => ['pedidos.destroy', ':ROW_ID'], 'method' => 'DELETE', 'id' => 'form-pedido-delete']); ?>


<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.assets.libraries.kendo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.datetime', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.jquery-validation', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.checkbox', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.select2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startPush('scripts'); ?>

<script id="command-template" type="text/x-kendo-template">
    <a title="Editar"   href="\#" class="edit-pedido-entity kendo-buttons">
        <i class="fa fa-lg fa-pencil"></i>
    </a>
    <a title="Eliminar" href="\#" class="delete-pedido-entity">
        <i class="fa fa-lg fa-trash"></i>
    </a>
</script>

<script type="text/javascript">

    var permission_search_role = "";

    var pedidos_url = "<?php echo e(route('pedidos.load')); ?>";
    var PedidosSettings = newModalSettings();
    var PedidoCRUD = newModalCRUD();
    PedidosSettings.entity     = 'PEDIDO';
    PedidosSettings.selector   = 'pedido';
    PedidosSettings.edit.url   = "<?php echo e(route('pedidos.edit', ':ROW_ID')); ?>";
    PedidosSettings.create.url = "<?php echo e(route('pedidos.create')); ?>";
    PedidosSettings.delete.url = "<?php echo e(route('pedidos.delete', ':ROW_ID')); ?>";
    PedidoCRUD.init(PedidosSettings);
</script>
<script src="<?php echo e(asset('js/modules/pedidos/index.js')); ?>"></script>
<script src="<?php echo e(asset('js/modules/maintenance/station_base/filter-ubigeo.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>