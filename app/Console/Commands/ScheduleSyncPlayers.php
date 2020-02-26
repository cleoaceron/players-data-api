<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Bus;
use Carbon\Carbon;
use App\Services\Players\PlayersInterface as PlayerService;

class ScheduleSyncPlayers extends Command {

    protected $signature = "dispatch:sync_players";

    protected $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService =  $playerService;

        parent::__construct();
    }

    public function handle() {
        Log::info('Running Sync Players command.');

        $notify = $this->playerService->fetchPlayersApi();

        Log::info('Done...');
    }
}
