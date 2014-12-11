
    </div> <!-- #mainarea -->
    
  
  
<script type="text/javascript" src="<?= $this->url ?>/assets/plugins/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?= $this->url ?>/assets/plugins/prefixfree.min.js"></script>
<script type="text/javascript" src="<?= $this->url ?>/assets/js/main.js"></script>

<?php if(!empty($this->route->js_libraries)) { echo $this->route->js_libraries; } ?>

<? if(file_exists('assets/js/view/'.$this->route->view.'.js')) { echo '<script type="text/javascript" src="'.$this->url.'/assets/js/view/'.$this->route->view.'.js"></script>'; } ?>


<? if(!$this->dev_mode) { ?>
    <script>alert("Insert Google Analytics tracking, plz.");</script>
<? } ?>

</body>
</html>

<? if($this->dev_mode) { ?>
    <!-- <? print_r($this) ?> -->
<? } ?>
