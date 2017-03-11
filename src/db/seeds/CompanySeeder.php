<?php

use Phinx\Seed\AbstractSeed;

class CompanySeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
               'name' => $faker->company,
               'taxId'   => $faker->randomElement($array = array ('J','G'))
                              . $faker->numberBetween(310037221, 100000000),
               'email'       => $faker->email,
               'address'   => $faker->address,
               'phoneNumber'   => $faker->phoneNumber,
            ];
        }
        $this->insert('company', $data);
    }
}
