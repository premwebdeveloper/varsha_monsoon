        <!-- Date Picker -->
        <script src="<?= base_url(); ?>frontend_assets/js/bootstrap-datepicker.min.js"></script>
        <script src="<?= base_url(); ?>frontend_assets/js/bootstrap-datetimepicker.min.js"></script>

        <!-- Theme Scripts -->
        <script src="<?= base_url(); ?>frontend_assets/js/idangerous.swiper.min.js"></script>
        <script src="<?= base_url(); ?>frontend_assets/js/global.js"></script>

    	<!-- JQUERY VALIDATION ENGINE -->
    	<script type="text/javascript" src="<?= base_url(); ?>frontend_assets/js/jquery_validation_engine/jquery.validationEngine.js"></script>
    	<script type="text/javascript" src="<?= base_url(); ?>frontend_assets/js/jquery_validation_engine/jquery.validationEngine-en.js"></script>

        <!-- custom scrollbar -->
        <script src="<?= base_url(); ?>frontend_assets/js/jquery.mousewheel.js"></script>
        <script src="<?= base_url(); ?>frontend_assets/js/jquery.jscrollpane.min.js"></script>
        <script src="<?= base_url(); ?>frontend_assets/js/jquery-ui.min.js"></script>

        <!-- Get Current Loaction from Google API -->
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

        <!-- Jquery Scripts -->
        <?php $this->load->view('templates/_parts/public_app_scripts'); ?>

        <!-- Angular Scripts -->
    	<?php $this->load->view('templates/_parts/public_app_angular_scripts'); ?>

    </body>
</html>