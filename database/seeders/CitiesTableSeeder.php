<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        $cities = [
            ['name' => 'Paris ', 'carpooling_location' =>  ' 6 Rue St Sabin, 75011 Paris'],
            ['name' => 'Marseille ', 'carpooling_location' =>  ' Parking Saint Charles, Bd Voltaire, 13001 Marseille'],
            ['name' => 'Lyon ', 'carpooling_location' =>  ' 87 Quai Perrache, 69002 Lyon'],
            ['name' => 'Toulouse ', 'carpooling_location' =>  ' Aire de covoiturage Tisséo Borderouge, 31200 Toulouse'],
            ['name' => 'Nice ', 'carpooling_location' =>  ' 35-29 Bd Victor Hugo, 06000 Nice'],
            ['name' => 'Nantes ', 'carpooling_location' =>  '  Aire de covoiturage, 44800 Saint-Herblain'],
            ['name' => 'Montpellier ', 'carpooling_location' =>  '  35 Rue des Écoles, 34660 Cournonsec'],
            ['name' => 'Strasbourg ', 'carpooling_location' =>  ' Parking de covoiturage de Brumath ZI'],
            ['name' => 'Bordeaux ', 'carpooling_location' =>  ' 6 Av. de la Prairie, 33370 Artigues-près-Bordeaux'],
            ['name' => 'Lille ', 'carpooling_location' =>  ' 10 Rue de la Piquerie, 59800 Lille'],
            ['name' => 'Rennes ', 'carpooling_location' =>  ' Kennedy Guyenne, 35000 Rennes'],
            ['name' => 'Reims ', 'carpooling_location' =>  ' 4B Bd Joffre, 51100 Reims'],
            ['name' => 'Toulon ', 'carpooling_location' =>  ' Rue Henri Matisse, 83100 Toulon']];

        City::insert($cities);
    }
}



