<footer class="font-raleway w3-tiny main-footer d-none" style="z-index: 1100">
    <div class="col-8 float-left text-left">
        <strong>
            &copy; 2018 -
            <a href="<?php echo site_url('about'); ?>">Developed By Adamus IT</a>.
        </strong>
    </div>
    <div class="float-right col-4 text-right">
        <b>Version 2.0</b>
    </div>
</footer>
<!-- Modal -->
<div class="modal fade" id="stopProcess" tabindex="-1" role="dialog" aria-labelledby="stopProcessLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stopProcessLabel">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>This will cancel the Change Process!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- ./wrapper -->
<input type="hidden" value="<?php echo URL_ROOT ?>" id="url_root"/>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/jquery.min.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/blockui.js"></script>
<script>
    $.blockUI({
        message: '<i class="fa fa-spinner w3-spin" style="font-size:32px"></i>',
        css: {
            padding: 0,
            margin: 0,
            width: '0%',
            top: '40%',
            left: '50%',
            textAlign: 'center',
            color: '#000',
            border: '0',
            backgroundColor: 'rgba(0,0,0,0.5)',
            cursor: 'default'
        },
        overlayCSS: {
            backgroundColor: '#000',
            opacity: 0.0,
            cursor: 'default'
        },
        onUnblock: function () {
            $('.hide-on-init').removeClass('invisible');
            setTimeout(function () {
                $('.completed:not(.fa)').addClass('text-success fadeIn text-bold');
                $('.completed .fa').removeClass('d-none').addClass('rotateInUpLeft text-success text-bold');
                $('.incomplete').addClass('text-danger text-bold').removeClass('text-dark');
            }, 1000)
        }
    });
    $('.blockable').block({
        message: null,
        overlayCSS: {
            backgroundColor: '#000',
            opacity: 0.0,
            cursor: 'default'
        },
    });
</script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/jquery.ui.widget.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/jquery.iframe-transport.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/jquery.fileupload.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/jquery-toast.min.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/bootstrap.bundle.js"></script>
<script src="<?php echo URL_ROOT ?>/public/assets/js/shards.min.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/adminlte.min.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/adminlte-2.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/moment.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/bizniz.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/moment-business-with-holidays.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/moment-holiday.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/easter.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/ghana.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/jquery.daterange.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/jquery.scrollTo.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/letter-avatar.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/validator.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/bootstrap-select.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/pignose.calendar.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/list.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/hop.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/shards.min.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/kendo/kendo.all.min.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/custom-assets/js/custom.js?<?php echo microtime(); ?>"></script>
</body>
</html>