
<?php if(!has_body_cls('login-screen')): ?>
<div class="footer">
	<div class="corset">
        Built using Taco PHP
    </div>
</div>
<?php endif; ?>

<script>
    var base_url = '<?=base_url()?>';
    var env_name = '<?=env_name()?>';
</script>

<?php if( is_production() ): ?>
    <?php // Analytics, tracking, scripts, etc  ?>    
<?php endif; ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url()?>assets/js/all.min.js?<?=filemtime('assets/js/all.min.js')?>"></script>

</body>
</html>
