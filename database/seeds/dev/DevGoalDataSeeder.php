<?php

use Illuminate\Database\Seeder;

class DevGoalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numGoals = 3;
        $numDays = 365;

        foreach(range(1, $numGoals) as $goalIndex) {
            $theDate = date('Y-m-d H:i:s', time() - ($numDays * 24 * 60 * 60));

            $goal = factory(App\Models\Goal::class)->create();

            foreach (range(1, $numDays) as $index) {
                $theDate = date('Y-m-d H:i:s', strtotime($theDate . ' +1 day'));

                factory(App\Models\GoalEntry::class)->create([
                    'goal_id' => $goal->id,
                    'recorded_at' => $theDate
                ]);
            }
        }
    }
}
