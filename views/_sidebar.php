

<p>
  <a href="<?=$this->url?>/">Hello</a>
</p>

<p>
  <a href="<?=$this->url?>/products">Products</a>
</p>

<p>
  <a href="<?=$this->url?>/brokenlink">Broken link</a>
</p>


<!--
<div id="console">
  
  <p>
    <b>Router input:</b><br />
    {foreach $this->route->input as $item}
      {$item}, 
    {/foreach}
    
    
    <? foreach ($this->route->input as $key => $value) { ?>
        X
    <? } ?>
    
  </p>
  
  
  <p>
    <b>Controller:</b><br />
    {$this->route->controller}
  </p>
    
  <p>
    <b>View:</b><br />
    {$this->route->view}
  </p>
  
  
  <p>
    <b>{$this->route->view|capitalize} CSS asset:</b><br />
    {if isset($this->route->css)}Yes{else}No{/if}
  </p>
  
  <p>
    <b>{$this->route->view|capitalize} JS asset:</b><br />
    {if isset($this->route->js)}Yes{else}No{/if}
  </p>
  
</div>
-->