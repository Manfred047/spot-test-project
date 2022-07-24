<?php

namespace Database\Seeders;

use App\Models\ConstructionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConstructionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->saveToDatabase();
    }

    public function constructionTypes(): array {
        return [
            [
                'id' => 1,
                'name' => 'Áreas verdes'
            ],
            [
                'id' => 2,
                'name' => 'Centro de barrio'
            ],
            [
                'id' => 3,
                'name' => 'Equipamiento'
            ],
            [
                'id' => 4,
                'name' => 'Habitacional'
            ],
            [
                'id' => 5,
                'name' => 'Habitacional y comercial'
            ],
            [
                'id' => 6,
                'name' => 'Industrial'
            ],
            [
                'id' => 7,
                'name' => 'Sin Zonificación'
            ],
        ];
    }

    private function saveToDatabase (): void {
        ConstructionType::upsert($this->constructionTypes(), ['id'], ['name']);
    }
}
