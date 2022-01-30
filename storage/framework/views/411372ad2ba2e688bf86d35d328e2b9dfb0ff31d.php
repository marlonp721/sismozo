<?php $__env->startPush('css'); ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('libraries/select2/css/select2.min.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startPush('libraries'); ?>

    <script src="<?php echo e(asset('libraries/select2/js/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libraries/select2/js/i18n/es.js')); ?>"></script>
    
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    
    <script type="text/javascript">

        $(document).on('change','.select2', function () {

            if ( typeof $(this).attr('aria-required') != 'undefined' )
            {
                var select2_container = $(this).next('.select2-container');

                if( $(this).val() )
                {
                    select2_container.find('.select2-selection').removeClass('error');
                    select2_container.next().hide();

                }
                else if( $(this).next('.select2-container').next('label').hasClass('error') )
                {
                    select2_container.find('.select2-selection').addClass('error');
                    select2_container.next().show();
               }
            }
        });
        
    </script>
    
<?php $__env->stopPush(); ?>