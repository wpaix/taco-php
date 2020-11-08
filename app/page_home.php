<?php

prevent_public_access();
$logged_in_as = get_client_by_password();

if( $logged_in_as != 'milk' ) {
    $projects = get_client_projects($logged_in_as->slug);
}

if( $logged_in_as == 'milk' ) {
    $projects = get_client_projects('*');
}

// if user is milk, show all with * above, else get logged in client and show theirs

$total_hrs = 0;
$total_dkk = 0;

$clients = get_all_clients();

foreach($projects as $p) {
    $p->client = get_client($p->client_slug);
    $p->hour_rate = get_project_hour_rate($p,$p->client);
    $p->hours_total = get_timelogs_hours_total($p->timelogs);
    $p->dkk_total = get_timelogs_dkk_total($p,$p->client);
    $total_hrs += $p->hours_total;
    $total_dkk += $p->dkk_total;
}

?>

<?php 
/*
save_client([ 'slug' => 'ctg', 'rate' => '890', ]);
save_client([ 'slug' => 'oktan', 'rate' => '890', ]);
save_client([ 'slug' => 'gottlieb', 'rate' => '790', ]);
save_client([ 'slug' => 'cso', 'rate' => '690', ]);

//save_project([ 'client_slug' => 'oktan', 'project_slug' => 'miracle-site', 'project' => (object) [ 'timelogs' => [1,2,3] ] ]);
//save_project([ 'client_slug' => 'oktan', 'project_slug' => 'friendlysales', 'project' => (object) [ 'timelogs' => [4,5,6] ] ]);

dd( get_project('oktan','xxxx') );

if( is_route('') ) { dd('home screen'); }
if( is_route('oktan') ) { dd('oktan screen'); }
if( is_route_param('oktan',0) ) { dd('oktan screen'); }
*/
?>



<?php require view('view_start'); ?>

<?php if( $logged_in_as === 'milk' ): ?>
    
<?php endif; ?>

<?php if( $logged_in_as !== 'milk' ): ?>
    
<?php endif; ?>

<div class="corset">
    <div class="card">
        <table class="table1">
            <thead>
                <tr>
                    <th class="align-l">Projekt</th>
                    <th class="align-c">Kunde</th>
                    <th class="align-c">Tracket</th>
                    <th class="align-r">Kr.</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $projects as $p ): ?>
                <tr>
                    <td class="align-l">
                        <a class="" href="/<?=$p->client_slug?>/<?=$p->slug?>">
                            <div class="colordot" style="background-color:<?=$p->color?>;"></div> <?=$p->name?>
                        </a>
                    </td>
                    <td class="align-c">
                        <a href="/<?=$p->client->slug?>"><div class="colordot" style="background-color:<?=$p->client->color?>;"></div> <?=$p->client->name?></a>
                    </td>
                    <td class="align-c"><?=$p->hours_total?> timer</td>
                    <td class="align-r"><?=$p->dkk_total?> kr</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="align-c"><b><span class="val"><?=$total_hrs?></span> timer</b></td>
                    <td class="align-r"><b><span class="val"><?=$total_dkk?></span> kr</b></td>
                </tr>
            </tfoot>
        </table>        
    </div>
</div>


<div class="corset">
    <div class="card">
        <div class="totals-line">
            <div class="hours">Arbejdstid tracket: <em><span class="val"><?=$total_hrs?></span> timer</em><br></div>
            <div class="amount"><em><span class="val"><?=$total_dkk?></span> kr.</em> ex. moms</div>
        </div>
    </div>
</div>


<?php if( $logged_in_as === 'milk' ): ?>
    <div class="corset">
        <div class="card">
            <?php foreach($clients as $c): ?>
                <a href="<?=$c->slug?>"><div class="colordot" style="background-color:<?=$c->color?>;"></div> <?=$c->name?></a><br>
            <?php endforeach; ?>
            <span class="aslink">Opret kunde</span>    
        </div>
    </div>
<?php endif; ?>

<?php require view('view_end'); ?>
