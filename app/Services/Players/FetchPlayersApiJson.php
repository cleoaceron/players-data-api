<?php

namespace App\Services\Players;

use App\Repositories\Players\PlayersRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class FetchPlayersApiJson extends AbstractPlayers
{

    protected $request;

    protected $playersRepository;

    protected $apiData;

    protected $items;


    public function __construct(Request $request, 
        PlayersRepository $playersRepository)
    {
        $this->request = $request;
        $this->playersRepository = $playersRepository;

        parent::__construct($request, $playersRepository);
    }

    /**
     *
     * Fetch Players API
     *
     * @return AbstractPlayers
     */
    public function handle(): AbstractPlayers
    {
        $this->getApi();
        $this->setPlayersData();
       // echo "<pre>"; print_r($this->items); exit;

        $addPlayers = $this->playersRepository->insert($this->items);

        if( $addPlayers ){
            $this->response = $this->makeResponse(200, 'add_players.200');
            $this->response->model = $addPlayers;
        }
        else{
           $this->response =  $this->makeResponse(400, 'add_players.400');
           $this->response->model = null;
        }

        return $this;
    }
    
    /**
     *
     * Get api.
     *
     */
    private function getApi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://fantasy.premierleague.com/api/bootstrap-static/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        $this->apiData = json_decode($response, true);
        $err = curl_error($curl);

        curl_close($curl);
    }
    /**
     *
     * Set api.
     *
     */
    private function setPlayersData() 
    {
        $apiData = $this->apiData['elements'];
        $limit = 100;
        $items = [];

        for ($i = 0; $i <= $limit; $i++) {
            $data = [
                'uuid'          => Uuid::uuid4()->toString(),
                'player_id'     => $apiData[$i]['id'],
                'first_name'    => $apiData[$i]['first_name'],
                'second_name'   => $apiData[$i]['second_name'],
                'form'          => $apiData[$i]['form'],
                'total_points'  => $apiData[$i]['total_points'],
                'influence'     => $apiData[$i]['influence'],
                'creativity'    => $apiData[$i]['creativity'],
                'threat'        => $apiData[$i]['threat'],
                'ict_index'     => $apiData[$i]['ict_index']
            ];

            $items[] = $data;
        }

        $this->items = $items;
    }
}