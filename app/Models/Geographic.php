<?php

namespace App\Models;

use App\Utils\Utils;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geographic extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fid' => 'integer',
        'geo_shape' => 'array',
        'call_numero' => 'string',
        'codigo_postal' => 'integer',
        'colonia_predio' => 'string',
        'superficie_terreno' => 'decimal:19,2',
        'superficie_construccion' => 'decimal:19,2',
        'uso_construccion' => 'integer',
        'clave_rango_nivel' => 'integer',
        'anio_construccion' => 'integer',
        'instalaciones_especiales' => 'string',
        'valor_unitario_suelo' => 'decimal:19,2',
        'valor_suelo' => 'decimal:19,2',
        'clave_valor_unitario_suelo' => 'string',
        'colonia_cumpliemiento' => 'string',
        'alcaldia_cumplimiento' => 'string',
        'subsidio' => 'decimal:19,2'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fid',
        'geo_shape',
        'call_numero',
        'codigo_postal',
        'colonia_predio',
        'superficie_terreno',
        'superficie_construccion',
        'uso_construccion',
        'clave_rango_nivel',
        'anio_construccion',
        'instalaciones_especiales',
        'valor_unitario_suelo',
        'valor_suelo',
        'clave_valor_unitario_suelo',
        'colonia_cumpliemiento',
        'alcaldia_cumplimiento',
        'subsidio'
    ];

    // RELATIONS

    /**
     * Get the construction type associated with the geographic.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function constructionType()
    {
        return $this->hasOne(ConstructionType::class);
    }


    // SETTERS AND GETTERS

    /**
     * Guardar como default null.
     *
     * @return Attribute
     */
    protected function Fid(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => !Utils::isInteger($value) ? null : $value
        );
    }

    /**
     * Guardar como JSON.
     *
     * @return Attribute
     */
    protected function GeoShape(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => empty($value) ? null : json_encode($value)
        );
    }

    /**
     * Remueve espacios innecesarios.
     *
     * @return Attribute
     */
    protected function CallNumero(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Utils::trimmed($value, true)
        );
    }

    /**
     * Guardar como default null.
     *
     * @return Attribute
     */
    protected function CodigoPostal(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => !Utils::isInteger($value) ? null : $value
        );
    }

    /**
     * Remueve espacios innecesarios.
     *
     * @return Attribute
     */
    protected function ColoniaPredio(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Utils::trimmed($value, true)
        );
    }

    /**
     * Guardar como default null.
     *
     * @return Attribute
     */
    protected function SuperficieTerreno(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => !Utils::isNumeric($value) ? null : $value
        );
    }

    /**
     * Guardar como default null.
     *
     * @return Attribute
     */
    protected function SuperficieConstruccion(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => !Utils::isNumeric($value) ? null : $value
        );
    }


    /**
     * Guardar como default null.
     *
     * @return Attribute
     */
    protected function UsoConstruccion(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => !Utils::isInteger($value) ? null : $value
        );
    }

    /**
     * Guardar como default null.
     *
     * @return Attribute
     */
    protected function ClaveRangoNivel(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => !Utils::isInteger($value) ? null : $value
        );
    }

    /**
     * Guardar como default null.
     *
     * @return Attribute
     */
    protected function AnioConstruccion(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => !Utils::isInteger($value) ? null : $value
        );
    }

    /**
     * Remueve espacios innecesarios.
     *
     * @return Attribute
     */
    protected function InstalacionesEspeciales(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Utils::trimmed($value, true)
        );
    }

    /**
     * Guardar como default null.
     *
     * @return Attribute
     */
    protected function ValorUnitarioSuelo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => !Utils::isNumeric($value) ? null : $value
        );
    }

    /**
     * Guardar como default null.
     *
     * @return Attribute
     */
    protected function ValorSuelo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => !Utils::isNumeric($value) ? null : $value
        );
    }

    /**
     * Remueve espacios innecesarios.
     *
     * @return Attribute
     */
    protected function ClaveValorUnitarioSuelo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Utils::trimmed($value, true)
        );
    }

    /**
     * Remueve espacios innecesarios.
     *
     * @return Attribute
     */
    protected function ColoniaCumpliemiento(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Utils::trimmed($value, true)
        );
    }

    /**
     * Remueve espacios innecesarios.
     *
     * @return Attribute
     */
    protected function AlcaldiaCumpliemiento(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Utils::trimmed($value, true)
        );
    }

    /**
     * Guardar como default null.
     *
     * @return Attribute
     */
    protected function Subsidio(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => !Utils::isNumeric($value) ? null : $value
        );
    }
}
