<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Property;
use App\Models\PropertyValue;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $items = Item::factory()->count(100)->create();
        $properties = Property::factory()->count(3)->sequence(
            ['slug' => 'color', 'name' => 'Цвет'],
            ['slug' => 'brand', 'name' => 'Бренд'],
            ['slug' => 'size', 'name' => 'Размер']
        )->create();

        $values = [
            'color' => ['зеленый', 'белый', 'черный'],
            'brand' => ['Philips', 'Horoz'],
            'size' => ['100', '200', '450', '950'],
        ];
        $properties->each(function ($property) use ($values, $items) {
            foreach ($values[$property->slug] as $value) {
                $propertyValues[] = PropertyValue::factory()->sequence(
                    ['property_id' => $property->id, 'value' => $value],
                )->create();
            }
            $items->each(function ($item) use ($propertyValues) {
                if (rand(0, 1) === 1) {
                    $item->propertyValues()->attach($propertyValues[rand(0, count($propertyValues) - 1)]);
                }
            });
        });
    }
}
