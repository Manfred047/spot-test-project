<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geographics', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('fid')
                ->nullable()
                ->default(null)
                ->comment('Código numérico único asignado a un predio. Los predios que tienen más de un número interior tienen el mismo identificador único del predio');

            $table->json('geo_shape')
                ->nullable()
                ->default(null);

            $table->string('call_numero', 191)
                ->nullable()
                ->default(null)
                ->comment('Nombre de la calle o avenida y número exterior e interior del domicilio donde se ubica el predio. Esta dirección corresponde al registrado en el catastro de la Ciudad de México.');

            $table->unsignedInteger('codigo_postal')
                ->nullable()
                ->default(null)
                ->comment('Código de cinco dígitos usado para la ubicación de zonas dentro de la CDMX. Corresponde al CP registrado en el catastro.');

            $table->string('colonia_predio', 191)
                ->nullable()
                ->default(null)
                ->comment('Colonia a la que pertenece el domicilio del predio. Una colonia corresponde a una delimitación territorial interna de las Alcaldías. Corresponde a la colonia registrada en el catastro.');

            $table->unsignedDecimal('superficie_terreno', 19, 2)
                ->nullable()
                ->default(null)
                ->comment('Área que corresponde a la delimitación del terreno del predio, expresada en metros cuadrados.');

            $table->unsignedDecimal('superficie_construccion', 19, 2)
                ->nullable()
                ->default(null)
                ->comment('Área que corresponde a la delimitación de la construcción dentro del predio, expresada en metros cuadrados.');

            $table->unsignedBigInteger('uso_construccion')
                ->nullable(true)
                ->default(null)
                ->comment('Corresponde al fin del objeto de la construcción. Los predios habitacionales califican para subsidios. Ver columna subsidios. Ver apartado definiciones del Código Fiscal de la Ciudad de México.');

            $table->unsignedInteger('clave_rango_nivel')
                ->nullable()
                ->default(null)
                ->comment('Corresponde a un rango del número de pisos que tiene una construcción. Ver apartado definiciones del Código Fiscal de la Ciudad de México.');

            $table->unsignedInteger('anio_construccion')
                ->nullable()
                ->default(null)
                ->comment('Indica el año en el que se realizó la construcción del predio o el año de la última remodelación. Se usa el dato más reciente.');

            $table->string('instalaciones_especiales', 191)
                ->nullable()
                ->default(null)
                ->comment('Se entiende por instalaciones especiales, aquellas que se consideran indispensables o necesarias para el funcionamiento operacional del inmueble de acuerdo a su uso específico, tales como elevadores, escaleras electromecánicas, equipos de calefacción o aire lavado, sistema hidroneumático, equipos contra incendio. Ver apartado definiciones del Código Fiscal de la Ciudad de México.');

            $table->unsignedDecimal('valor_unitario_suelo', 19, 2)
                ->nullable()
                ->default(null)
                ->comment('Corresponde al precio unitario por metro cuadrado. Este valor sólo es válido para cálculos del impuesto predial.');

            $table->unsignedDecimal('valor_suelo', 19, 2)
                ->nullable()
                ->default(null)
                ->comment('Corresponde al resultado de la multiplicación del valor unitario del suelo por la superficie del terreno de la construcción.');

            $table->string('clave_valor_unitario_suelo', 191)
                ->nullable()
                ->default(null)
                ->comment('Corresponde a la colonia catastral a la que pertenece el predio. (Hay tres tipos (área, corredor, enclave)');

            $table->string('colonia_cumpliemiento', 191)
                ->nullable()
                ->default(null)
                ->comment('Corresponde al índice porcentual promedio de pago a nivel de colonia. Es decir, porcentaje de monto a nivel colonia.');

            $table->string('alcaldia_cumplimiento', 191)
                ->nullable()
                ->default(null)
                ->comment('Corresponde al índice porcentual promedio de pago a nivel de alcaldía. Es decir, porcentaje de monto a nivel alcaldía.');

            $table->unsignedDecimal('subsidio', 19, 2)
                ->nullable()
                ->default(null)
                ->comment('Corresponde al monto otorgado como el resultado de la aplicación de un beneficio por ser de uso habitacional. Son descuentos de cuota fija para los rangos de tarifa que se encuentran en el código fiscal sección 130: A, B, C y D porcentajes de descuento para rangos E, F, G y descuentos para personas adultas mayores.');

            $table->timestamps();

            // RELATIONS
            $table->foreign('uso_construccion')
                ->references('id')
                ->on('construction_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geographics');
    }
};
