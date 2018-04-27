<?php

namespace Tests\Listeners;

use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation as DefaultImplementation;
use PHPUnit\Framework\TestSuite;
use Tests\CreatesApplication;

/**
 * Refresh the database and seed it with data before and/or after all testing.
 */
class DatabasePreparationListener implements TestListener
{
    use DefaultImplementation;
    use CreatesApplication;

    /**
     * The database seeders to run before testing.
     *
     * @var array
     */
    private $beforeSeeders = [];

    /**
     * The database seeders to run after testing.
     *
     * @var array
     */
    private $afterSeeders = ['DevDatabaseSeeder'];

    /**
     * A test suite has started.
     *
     * @param \PHPUnit\Framework\TestSuite  $suite
     * @return void
     */
    public function startTestSuite(TestSuite $suite): void
    {
        // A test suite with no name "wraps" the set of defined test suites
        if (! $suite->getName()) {
            $this->prepareDatabase('before');
        }
    }

    /**
     * A test suite has ended.
     *
     * @param \PHPUnit\Framework\TestSuite  $suite
     * @return void
     */
    public function endTestSuite(TestSuite $suite): void
    {
        // A test suite with no name "wraps" the set of defined test suites
        if (! $suite->getName()) {
            $this->prepareDatabase('after');
        }
    }

    /**
     * Prepare the database for testing.
     *
     * @param string    $type   whether this preparation takes place "before" or "after" testing
     * @return void
     */
    private function prepareDatabase(string $type)
    {
        $this->createApplication();
        $this->refreshDatabase();
        $this->seedDatabase($type);
    }

    /**
     * Run the artisan migrate:fresh command to drop all tables and re-run all migrations.
     *
     * @return void
     */
    private function refreshDatabase()
    {
        printf("\nRefreshing database......");

        \Artisan::call('migrate:fresh');

        printf("Done!\n");
    }

    /**
     * Run database seeders to add data to the database.
     *
     * @param string    $seederType     the type of seeder(s) to run (before or after)
     * @return void
     */
    private function seedDatabase(string $seederType = 'after')
    {
        $seeders = $seederType == 'before' ? $this->beforeSeeders : $this->afterSeeders;

        if (!$seeders) {
            return;
        }

        printf("Seeding database......");

        foreach ($seeders as $seederClass) {
            $seeder = new $seederClass();
            $seeder->run();
        }

        printf("Done!\n");
    }
}
