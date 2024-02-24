<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category' => $this->faker->randomElement(['TKP', 'TIU', 'TWK']),
            'sub_category' => $this->faker->word,
            'question_image_url' => 'question_image/Frame 3.png',
            'question_text' => $this->faker->sentence,
            'user_id' => 3,
            'exam_type' => $this->faker->randomElement(['Simulasi', 'Test']),
        ];
    }
}
