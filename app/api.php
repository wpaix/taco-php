<?php

$endpoint = get_route_param(1);

if( $endpoint == 'create_client' ) {
    $client = $input = input('get');
    $client->slug = slugify($client->name);
    $done = save_client($client);
    if(!$done) output(500, ['msg' => 'could not create']);
    output(200);
}

if( $endpoint == 'create_project' ) {
    $project = $input = input('get');
    $project->slug = slugify($project->name);
    $done = save_project($project);
    if(!$done) output(500, ['msg' => 'could not create']);
    output(200);
}

output( 200, [ 'msg' => 'hello world', 'input' => $input ] );