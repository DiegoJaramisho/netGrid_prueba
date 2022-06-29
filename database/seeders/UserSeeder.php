<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'user' => 'Wos',
                'name' => 'Valentin ',
                'lastname' => 'Olivera',
                'type_identifications' => 1,
                'identification' => 12345678,
                'day_of_birth' => '1998-02-09',
                'email' => 'wos@user.com',
                'password' => 12345,
            ],
            [
                'user' => 'Trueno',
                'name' => 'Mateo ',
                'lastname' => 'Palacios',
                'type_identifications' => 2,
                'identification' => 87654321,
                'day_of_birth' => '2000-02-09',
                'email' => 'trueno@user.com',
                'password' => 54321,
            ],
            [
                'user' => 'Bnet',
                'name' => 'Javier ',
                'lastname' => 'Ibarras',
                'type_identifications' => 1,
                'identification' => 986512,
                'day_of_birth' => '1997-02-09',
                'email' => 'bnet@user.com',
                'password' => 1997,
            ],
            [
                'user' => 'Mau',
                'name' => 'Mauricio ',
                'lastname' => 'Hernandez',
                'type_identifications' => 1,
                'identification' => 5432171,
                'day_of_birth' => '1996-02-09',
                'email' => 'aczino@user.com',
                'password' => 1996,
            ],
            [
                'user' => 'Valles-t',
                'name' => 'camilo',
                'lastname' => 'Vallesteros',
                'type_identifications' => 1,
                'identification' => 10987541,
                'day_of_birth' => '1997-02-09',
                'email' => 'vallest@user.com',
                'password' => "1997v",
            ],
        ];

        foreach($users as $value){
            User::create([
                'user' => $value['user'],
                'name' => $value['name'],
                'lastname' => $value['lastname'],
                'type_identifications_id' => $value['type_identifications'],
                'identification' => $value['identification'],
                'day_of_birth' => $value['day_of_birth'],
                'email' => $value['email'],
                'password' => Hash::make($value['password'])
            ]);
        }
    }
}
