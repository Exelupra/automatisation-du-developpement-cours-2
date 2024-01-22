<?php

namespace App\Console;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Office;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Facades\Schema;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Slim\App;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Faker\Factory;

class PopulateDatabaseCommand extends Command
{
    private App $app;
    private $faker;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->faker = Factory::create();
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('db:populate');
        $this->setDescription('Populate database');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Populate database...');

        /** @var Manager $db */
        $db = $this->app->getContainer()->get('db');

        $db->getConnection()->statement("SET FOREIGN_KEY_CHECKS=0");
        $db->getConnection()->statement("TRUNCATE `employees`");
        $db->getConnection()->statement("TRUNCATE `offices`");
        $db->getConnection()->statement("TRUNCATE `companies`");
        $db->getConnection()->statement("SET FOREIGN_KEY_CHECKS=1");

        for ($i = 1; $i <= 2; $i++) {
            $company = Company::create([
                'name' => $this->faker->company,
                'phone' => $this->faker->phoneNumber,
                'email' => $this->faker->companyEmail,
                'website' => $this->faker->url,
                'image' => $this->faker->imageUrl(),
                'created_at' => $this->faker->dateTimeThisYear,
                'updated_at' => $this->faker->dateTimeThisYear,
            ]);

            for ($j = 1; $j <= 2; $j++) {
                $office = Office::create([
                    'name' => $this->faker->companySuffix,
                    'address' => $this->faker->streetAddress,
                    'city' => $this->faker->city,
                    'zip_code' => $this->faker->postcode,
                    'country' => $this->faker->country,
                    'email' => $this->faker->companyEmail,
                    'phone' => $this->faker->phoneNumber,
                    'company_id' => $company->id,
                    'created_at' => $this->faker->dateTimeThisYear,
                    'updated_at' => $this->faker->dateTimeThisYear,
                ]);
$output->writeln($office->phone);
                $company->offices()->save($office);
            }

            $company->update(['head_office_id' => $company->offices->random()->id]);
        }

        for ($i = 1; $i <= 8; $i++) {
            $employee = Employee::create([
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'office_id' => Office::inRandomOrder()->first()->id,
                'email' => $this->faker->email,
                'phone' => $this->faker->phoneNumber,
                'job_title' => $this->faker->jobTitle,
                'created_at' => $this->faker->dateTimeThisYear,
                'updated_at' => $this->faker->dateTimeThisYear,
            ]);
            $employee->office()->associate(Office::inRandomOrder()->first())->save();
        }

        $output->writeln('Database created successfully!');
        return 0;
    }
}
