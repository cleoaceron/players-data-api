<?php

use Ramsey\Uuid\Uuid;

class PlayerTest extends TestCase
{
    /**
     * View Player Test Case
     *
     * @return void
     */
    public function testViewPlayer() 
    {

        //404
        $response = $this->get("admin/players/view/1");
        $response->assertResponseStatus(404);

        //Create player factory
        $player = factory(\App\Models\Player::class)->create();
        
        //200
        $response = $this->get("admin/players/view/{$player->uuid}");
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            "message",
            "model" => [
                "uuid",
                "player_id",
                "first_name",
                "second_name",
                "form",
                "total_points",
                "influence",
                "creativity",
                "threat",
                "ict_index"
            ]
        ]);
    }

    /**
     * Get Players Test Case
     *
     * @return void
     */
    public function testPlayerList() 
    {

        //Create player factory
        $player = factory(\App\Models\Player::class, 9)->create();
        $player = factory(\App\Models\Player::class)->create([
            'first_name' => 'John'
        ]);

        //list order
        $response = $this->post("admin/players/list", [
            "keyword" => ""
        ]);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            "message",
            "list" => [
                "*" => [
                    "player_id",
                    "first_name",
                    "second_name",
                    "form",
                    "total_points",
                    "influence",
                    "creativity",
                    "threat",
                    "ict_index"
                ]
            ],
            "max_page",
            "next_page",
            "prev_page"
        ]);
    }
}