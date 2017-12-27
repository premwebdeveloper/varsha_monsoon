    <!-- Mainly scripts -->

    <script src="<?= base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?= base_url(); ?>assets/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="<?= base_url(); ?>assets/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?= base_url(); ?>assets/js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/inspinia.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/slick/slick.min.js"></script>

    <!-- jQuery UI
    <script src="<?= base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script> -->

    <!-- GITTER -->
    <script src="<?= base_url(); ?>assets/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="<?= base_url(); ?>assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?= base_url(); ?>assets/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?= base_url(); ?>assets/js/plugins/chartJs/Chart.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

    <!-- Toastr -->
    <script src="<?= base_url(); ?>assets/js/plugins/toastr/toastr.min.js"></script>

    <script src="<?= base_url(); ?>assets/js/bootstrap-confirmation.min.js"></script>

    <?php $this->load->view('templates/_parts/auth_app_scripts'); ?>
    <script type="text/javascript">
        //View Image on Food Lising View on Admin Console
         $(document).ready(function(){
            $('.product-images').slick({
                dots: true
            });

        });
    </script>

</body>

</html>