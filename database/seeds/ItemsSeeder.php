<?php

use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'Dócil',
            'Pequeno Porte',
            'Médio Porte',
            'Pêlo Curto',
            'Pêlo Longo',
            'Sem Raça Definida'
        ];

        foreach ($items as $item) {
            $item = \App\Models\Item::create([
                'name' => $item,
            ]);
        }
    }
}
