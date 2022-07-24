<?php

namespace Tests\Feature;

use App\Models\ConstructionType;
use App\Models\Geographic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpotTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_api()
    {
        $zipCode = 7800;
        $constructionType = 4;
        $aggregate = 'max';
        $response = $this->get("api/price-m2/zip-codes/{$zipCode}/aggregate/{$aggregate}?construction_type={$constructionType}");
        $response->assertJsonStructure([
            'status',
            'payload' => [
                'type',
                'price_unit',
                'price_unit_construction',
                'elements'
            ]
        ]);
        $response->assertStatus(200);
    }
}
