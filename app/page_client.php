<?php

prevent_public_access();
$logged_in_as = get_client_by_password();

$client_slug = get_route_param(0);

$can_view = ( $logged_in_as === 'milk' || $logged_in_as->slug === $client_slug );
if(!$can_view) dd('no-auth');

$client = get_client( $client_slug );
$projects = get_client_projects( $client_slug );

$total_hrs = 0;
$total_dkk = 0;

foreach($projects as $p) {
    $p->hour_rate = get_project_hour_rate($p,$client);
    $p->hours_total = get_timelogs_hours_total($p->timelogs);
    $p->dkk_total = get_timelogs_dkk_total($p,$client);
    $total_hrs += $p->hours_total;
    $total_dkk += $p->dkk_total;
}

?>

<?php require view('view_start'); ?>

<div class="corset">
    <div class="cols cols-4">
        <div class="card">
            <b>Kunde</b><br>
            <?=$client->name?>
        </div>
        <div class="card">
            <b>Timepris</b><br>
            <span class="edit-rate"><?=$client->hour_rate?></span> kr.
        </div>
        <div class="card">            
            <div class="btn create-project-btn" data-client-slug="<?=$client->slug?>">Opret projekt</div>
        </div>
        <div class="card">
            
        </div>
    </div>
</div>


<div class="corset">
    <div class="card">
        <?php foreach( $projects as $p ): ?>
            <p>
                <a class="btn" style="background-color:<?=$p->color?>" href="/<?=$client_slug?>/<?=$p->slug?>">
                    <?=$p->name?>: ( <?=$p->hours_total?> t / <?=$p->dkk_total?> dkk ex moms )
                </a>
            </p>
        <?php endforeach; ?>
    </div>
</div>

<div class="corset">
    <div class="card">
        <p>Total arbejdstid tracket: <?=$total_hrs;?> t</p>
        <p>Total: <?=$total_dkk;?> kr. ex moms</p>
    </div>
</div>

<?php require view('view_end'); ?>