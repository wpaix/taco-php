<?php load_view('_html_start'); ?>

<div class="corset">
    <div class="card">

        <form action="" method="POST">      
            <div class="inputfield">
                <div class="label" for="id922">Username</div>
                <input class="styled" type="text" id="id922" name="u92728" value="<?=$admin_username?>" placeholder="Username" />
            </div>
            <br>
            <div class="inputfield">
                <div class="label" for="id823">Password ("password")</div>
                <input class="styled" type="password" id="id823" name="p92729" value="" placeholder="Password" />
            </div>
            <br>
            <input type="submit" class="btn" value="Log in" />
        </form>
        
    </div>
</div>

<?php load_view('_html_end'); ?>
