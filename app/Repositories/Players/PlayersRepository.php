<?php

namespace App\Repositories\Players;

use App\Repositories\AbstractBaseRepository;
use App\Models\Player as Model;
use DB;

class PlayersRepository extends AbstractBaseRepository {

	protected $searchFields = [
        'uuid',
        'player_id',
        'first_name',
        'second_name',
        'form',
        'total_points',
        'influence',
        'creativity',
        'threat',
        'ict_index'
	];

    public function __construct(Model $model) {
        parent::__construct($model);
    }

    public function paginate($request, $perpage, $page) {
        
        $items = $this->model;

        //check keyword
        if (isset($request['keyword']) && $request['keyword'] !== null && $request['keyword'] !== '') {
            $items = $items->where(function ($query) use ($request) {
            	foreach( $this->searchFields as $key => $field ){
            		if( $key == 0 ){
            			$query->where('players.'.$field, 'like', '%' . $request['keyword'] . '%');
            		}
            		else{
            			$query->orWhere('players.'.$field, 'like', '%' . $request['keyword'] . '%');
            		}
            	}
            });
        }
        
        return $this->model::paginate($items, $perpage, $page);
    }
    
}