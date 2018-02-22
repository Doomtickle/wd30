<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the user database seed.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('secret');

        User::create([
            'name'          => 'Karen Branham',
            'email'         => 'karenbranham@beachybeach.com',
            'password'      => $password,
            'cell_phone'    => '(850) 832-8626',
            'office_phone'  => '(850) 588-7978',
            'primary_phone' => '(850) 832-8626',
            'company'       => 'Beachy Beach Real Estate',
            'address'       => '5912 Thomas Drive'. PHP_EOL . 'Panama City Beach, FL 32408',
            'mls_id'        => 'B0851|BR.B0851', //separate mls numbers by strongbar "|"
            'is_realtor'    => 1
        ]);
    }
}
