<?php

prevent_public_access();
$logged_in_as = get_client_by_password();

$client_slug = get_route_param(0);
$client = get_client( $client_slug );

$can_view = ( $logged_in_as === 'milk' || $logged_in_as->slug === $client_slug );
$can_edit = ( $logged_in_as === 'milk' );

if(!$can_view) dd('no-auth');

$project_slug = get_route_param(1);
$project = get_project( $client_slug, $project_slug );

$hour_rate = $client->hour_rate;
if( isset($project->hour_rate) ) $hour_rate = $project->hour_rate;

$total_hours = 17.25; // DUMMY
$amount_dkk = $total_hours * $hour_rate; // DUMMY

?>

<?php require view('view_start'); ?>


<div class="corset">
    <div class="cols cols-3">
        <div class="card align-l">
            <a href="/<?=$client->slug?>"><?=$client->name?></a><br>
            <?=$project->name?>
        </div>
        <div class="card align-l">
            <?php if(!empty($project->invoice_no)): ?>
                <b>Faktura nr.</b><br>
                <?=$project->invoice_no?>
            <?php else: ?>      
                Ikke faktureret
            <?php endif; ?>      
        </div>
        <div class="card align-l">
            <?php if( $can_edit ) : ?>
                <div class="btn add-timelog-btn">Tilføj timelog +</div>
            <?php endif; ?>
        </div>
    </div>
</div>


<div class="corset">
    <table class="table1 timelogs-table <?php if($can_edit) echo 'can-edit'?> ">
        <thead>
            <tr>
                <th class="align-c">Tid</th>
                <th class="align-c">Note</th>
                <th class="align-c">Medarbejder</th>
                <th class="align-c">Dato</th>
                <?php if( $can_edit ) : ?>
                <th class="align-c">Slet</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $project->timelogs as $timelog ) :?>
                <tr>
                    <td class="align-c">
                        <?php if( $can_edit ) : ?>
                            <div class="edit"><input type="number" class="input-hrs" step="0.25" value="1.25"></div>                        
                        <?php else: ?>
                            <div class="view value-hrs">1,25 t</div>
                        <?php endif; ?>
                    </td>
                    <td class="align-c" data-field="note">
                        <?php if( $can_edit ) : ?>
                            <div class="edit"><textarea>Frontend tilretninger til signup modul</textarea></div>
                        <?php else: ?>
                            <div class="view">Frontend tilretninger til signup modul</div>
                        <?php endif; ?>
                    </td>
                    <td class="align-c" data-field="who">
                        <?php if( $can_edit ) : ?>
                            <div class="edit"><input type="text" value="William"></div>
                        <?php else: ?>
                            <div class="view">William</div>
                        <?php endif; ?>
                    </td>
                    <td class="align-c" data-field="date">
                        <?php if( $can_edit ) : ?>
                            <div class="edit"><input type="text" value="01/07/2020 18:22"></div>
                        <?php else: ?>
                            <div class="view">01/07/2020 18:22</div>
                        <?php endif; ?>
                    </td>
                    <?php if( $can_edit ) : ?>
                        <td class="align-c"><div class="row-remove-btn">X</div></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>        
    </table>
    <br>   
</div>

<br>

<div class="corset">
    <div class="cols cols-3">
        <div class="card">
            <b>Timepris</b><br>
            <?=$hour_rate?> kr.
        </div>
        <div class="card">
            <div class="hours"><b>Arbejdstid tracket</b><br><span class="val"><?=$total_hours?></span> timer<br></div>
        </div>
        <div class="card">
            <div class="amount"><b>Til fakturering</b><br><span class="val"><?=$amount_dkk?></span> kr. ex. moms</div>
        </div>
    </div>
</div>

<?php require view('view_end'); ?>