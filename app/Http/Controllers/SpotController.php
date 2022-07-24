<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpotShowRequest;
use App\Services\SpotService;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    public function show(SpotShowRequest $request, int $zipCode, string $aggregateType) {
        $constructionType = $request->input('construction_type');
        return SpotService::processGeographicPriceUnitPriceUnitConstruction($zipCode, $aggregateType, $constructionType);
    }
}
