<?php

namespace App\Services\Players;

interface PlayersInterface {

    public function fetchPlayersApi();

    public function viewPlayer($uuid);

    public function getPlayerList($request, $page);
    
}