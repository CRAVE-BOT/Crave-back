<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $usedNames = []; // تخزين الكلمات المستخدمة

        $productNames = [
            'Fresh Chicken', 'Beef', 'Ground Meat', 'Fish Fillet', 'Shrimp', 'Liver',
            'Tomato', 'Cucumber', 'Lettuce', 'Onion', 'Potato', 'Bell Pepper', 'Garlic', 'Parsley', 'Lemon', 'Apple', 'Orange',
            'Burger Buns', 'Tortilla Bread', 'French Bread', 'Pasta', 'Rice', 'Flour', 'Frozen French Fries',
            'Cheddar Cheese', 'Mozzarella Cheese', 'Cream Cheese', 'Milk', 'Butter',
            'Sunflower Oil', 'Olive Oil', 'Salt', 'Black Pepper', 'Cumin', 'Paprika', 'Ketchup', 'Mayonnaise', 'Mustard', 'BBQ Sauce', 'Tomato Sauce',
            'Mineral Water', 'Orange Juice', 'Apple Juice', 'Soft Drinks', 'Tea', 'Coffee',
            'Sugar', 'Whipping Cream', 'Chocolate Syrup', 'Dried Fruits', 'Nuts',
            'Cardboard Boxes', 'Paper Bags', 'Plastic Cutlery', 'Paper Coffee Cups', 'Napkins'
        ];

        // اختيار كلمة عشوائية غير مستخدمة
        do {
            $name = fake()->randomElement($productNames);
        } while (in_array($name, $usedNames));

        $usedNames[] = $name;

        $previousPrice = fake()->numberBetween(200, 1000);
        $currentPrice = fake()->numberBetween(100, $previousPrice);

        return [
            'name' => $name,
            'quantity' => fake()->numberBetween(50, 100),
            'Previous_price' => $previousPrice,
            'Current_price' => $currentPrice,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
