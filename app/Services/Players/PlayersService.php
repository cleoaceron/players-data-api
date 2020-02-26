<?php

namespace App\Services\Players;

use Ramsey\Uuid\Uuid;
use App\Services\AbstractBaseService;
use App\Services\Players\FetchPlayersApiJson;
use App\Repositories\Players\PlayersRepository as Repository;
use Illuminate\Http\Request;

class PlayersService extends AbstractBaseService implements PlayersInterface {

    protected $module = 'players';
    protected $repository;
    protected $request;

    const PERPAGE = 10;

    public function __construct(Request $request, Repository $repository) 
    {
        $this->repository = $repository;
        $this->request = $request;
        parent::__construct($request);
    }

    /**
     * Fetch Players Service
     *
     * @param none
     * @return response
     */
    public function fetchPlayersApi() 
    {
        return (new FetchPlayersApiJson($this->request, $this->repository))->handle()->response();
        //return (new FetchPlayersApiXML($this->request, $this->repository))->handle()->response();
    }

    /**
     * View Players Service
     *
     * @param String $uuid
     * @return response
     */
    public function viewPlayer($uuid) 
    {
        $model = $this->repository->find('uuid', $uuid);
        $this->response = $this->makeResponse(200, 'view_players.200');

        $this->response->model = $model;
        return $this->response;
    }

    /**
     * Get Players List Service
     *
     * @param String $uuid
     * @return response
     */
    public function getPlayerList($request, $page) 
    {
        $list = $this->repository->paginate($request, static::PERPAGE, $page);
        $this->response = $this->makeResponse(200, 'list_players.200');
        
        $this->response->list = $list->list;
        $this->response->max_page = $list->max_page;
        $this->response->next_page = $list->next_page;
        $this->response->prev_page = $list->prev_page;

        return $this->response;
    }
}