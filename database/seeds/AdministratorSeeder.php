<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $administrator = new \App\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "admin@email.com";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("123456");
        $administrator->phone = "123456789012";
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address ="Jl. Candi 6 B, Sukun, Malang" ;

        $administrator->save();

        $this->command->info("User Admin berhasil dditambahkan");
    }
}
