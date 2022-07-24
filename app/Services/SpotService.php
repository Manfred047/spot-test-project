<?php

namespace App\Services;

use App\Models\Geographic;
use Illuminate\Support\Collection;

class SpotService
{
    public static function processGeographicPriceUnitPriceUnitConstruction(int $zipCode, string $aggregateType, string $constructionType): array
    {
        try {
            $geographics = Geographic::zipCode($zipCode)
                ->constructionUse($constructionType);
            $collectedData = collect();
            foreach ($geographics->lazy() as $geographic) {
                $priceUnit = static::getPriceUnit($geographic->superficie_terreno, $geographic->valor_suelo, $geographic->subsidio);
                $priceUnitConstruction = static::getPriceUnit($geographic->superficie_construccion, $geographic->valor_suelo, $geographic->subsidio);
                $collectedData->push([
                    'price_unit' => $priceUnit,
                    'price_unit_construction' => $priceUnitConstruction
                ]);
            }
            return static::makeResponse(true, $aggregateType, $collectedData);
        } catch (\Exception $exception) {
            return static::makeResponse(false);
        }
    }

    private static function getPriceUnit($superficie, $valorSuelo, $subsidio): float|int
    {
        $divisor = $valorSuelo - $subsidio;
        $divisor = (($divisor != 0) ? $divisor: 1);
        return $superficie / $divisor;
    }

    private static function byAggregate(string $type, Collection $collection, string $key) {
        return match ($type) {
            'max' => $collection->max($key),
            'min' => $collection->min($key),
            'avg' => $collection->avg($key)
        };
    }

    private static function makeResponse(bool $status, string $aggregateType = null, Collection $collectedData = null): array
    {
        if (!$status) {
            return [
                'status' => false,
                'payload' => null
            ];
        }
        return [
            'status' => true,
            'payload' => [
                'type' => $aggregateType,
                'price_unit' => static::byAggregate($aggregateType, $collectedData, 'price_unit'),
                'price_unit_construction' => static::byAggregate($aggregateType, $collectedData, 'price_unit_construction'),
                'elements' => $collectedData->count()
            ]
        ];
    }
}
