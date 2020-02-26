<?php

namespace App\Services\Players;

use App\Services\AbstractBaseService;
use App\Repositories\Players\PlayersRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

abstract class AbstractPlayers extends AbstractBaseService
{
    protected $module = 'players';

    protected $version = 'v1';

    protected $playersRepository;

    public function __construct(
        Request $request, 
        PlayersRepository $playersRepository
    )
    {
        parent::__construct($request);
        $this->playersRepository = $playersRepository;
    }

    abstract public function handle(): AbstractPlayers;
}