<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question_id' => $this->faker->randomElement(Question::pluck('question_id')->toArray()),
            'answer_text' => $this->faker->sentence,
            'answer_score' => $this->faker->numberBetween(1, 100),
        ];
    }

    /**
     * Define the state for maximum 5 answers per question_id.
     *
     * @return Factory
     */
    public function limitedPerQuestion()
    {
        return $this->state(function (array $attributes) {
            // Retrieve the question ID from attributes
            $questionId = $attributes['question_id'];

            // Count the number of answers for the given question_id
            $answerCount = Answer::where('question_id', $questionId)->count();

            // If the count is already 5, return empty attributes to skip creation
            if ($answerCount >= 5) {
                return [];
            }

            // Otherwise, return the original attributes
            return $attributes;
        });
    }
}
