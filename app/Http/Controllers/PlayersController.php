<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Players\PlayersInterface as Service;

class PlayersController extends Controller
{
    const PLAYER_VALIDATION = [
        'firstname' => 'required',
        'second_name' => 'required'
    ];

    protected $service;

    public function __construct(Service $service)
    {
        $this->service =  $service;
    }

    /**
     * View a player.
     *
     * @return void
     */
    public function viewPlayer($uuid) 
    {

        $result = $this->service->viewPlayer($uuid);

        if ($result->status == 200) {
            return response()->json([
                        "message" => $result->message,
                        "model" => $result->model,
            ]);
        }

        return response()->json([
                    "model" => null,
                    "message" => $result->message,
                        ], $result->status);
    }

    /**
     * Get player list.
     *
     * @return void
     */
    public function getPlayerList(Request $request, $page = 1) 
    {

        $getList = $this->service->getPlayerList($request->toArray(), $page);

        if ($getList->status == 200) {
            return response()->json([
                        "message" => $getList->message,
                        "list" => $getList->list,
                        "max_page" => $getList->max_page,
                        "prev_page" => $getList->prev_page,
                        "next_page" => $getList->next_page
            ]);
        }

        return response()->json([
                    "list" => null,
                    "message" => $getList->message,
                    "max_page" => null,
                    "prev_page" => null,
                    "next_page" => null
                        ], $getList->status);
    }
}
