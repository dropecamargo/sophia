<?php

use Illuminate\Database\Seeder;
use App\Models\Tecnico\Contrato;
class ContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Contrato::create([
            'contrato_numero'=>'25-C',
            'contrato_tercero'=>1,
            'contrato_fecha'=>'2015-05-10',
            'contrato_vencimiento'=>'2015-06-11',
            'contrato_activo'=> true,
            'contrato_condiciones'=>'ok'
        ]);
    }
}
