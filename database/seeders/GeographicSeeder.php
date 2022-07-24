<?php

namespace Database\Seeders;

use App\Models\Geographic;
use App\Utils\Utils;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class GeographicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Iniciando seed de GeographicSeeder, este proceso puede demorar.');
        $this->processData();
    }

    private function processData() {
        DB::table('geographics')->delete();
        $filename = $this->fileBuildPath(__DIR__, 'file-data', 'sig_cdmx_GUSTAVO_A_MADERO_08-2020.csv');
        LazyCollection::make(function () use ($filename) {
            $file = fopen($filename, 'r');
            while ($data = fgetcsv($file)) {
                yield $data;
            }
        })->skip(1)->each(function ($data) {
            $preparedData = $this->buildData($data);
            $this->saveDataToDatabase($preparedData);
        });
    }

    private function fileBuildPath(...$segments): string {
        return join(DIRECTORY_SEPARATOR, $segments);
    }

    private function saveDataToDatabase(array $data) {
        $geographic = new Geographic();
        $geographic->fill($data);
        $geographic->save();
    }

    private function buildData(array $data): array
    {
        return [
            'fid' => $data[0],
            'geo_shape' => $data[1],
            'call_numero' => $data[2],
            'codigo_postal' => $data[3],
            'colonia_predio' => $data[4],
            'superficie_terreno' => $data[5],
            'superficie_construccion' => $data[6],
            'uso_construccion' => $this->getConstructionType($data[7]),
            'clave_rango_nivel' => $data[8],
            'anio_construccion' => $data[9],
            'instalaciones_especiales' => $data[10],
            'valor_unitario_suelo' => $data[11],
            'valor_suelo' => $data[12],
            'clave_valor_unitario_suelo' => $data[13],
            'colonia_cumpliemiento' => $data[14],
            'alcaldia_cumplimiento' => $data[15],
            'subsidio' => $data[16]
        ];
    }

    private function getConstructionType(?string $constructionUse): ?int {
        $constructionTypes = collect((new ConstructionTypeSeeder())->constructionTypes());
        $constructionUse = Utils::trimmed($constructionUse, true);
        if (empty($constructionUse)) {
            return null;
        }
        $constructionType = collect($constructionTypes->firstWhere('name', $constructionUse));
        return $constructionType->get('id', null);
    }
}
