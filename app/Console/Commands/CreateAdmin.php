<?php

namespace App\Console\Commands;

use App\Role;
use App\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an admin to view the admin dashboard';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('What is your name?');
        $email = $this->ask('Enter your email');
        $pass = $this->secret('Enter your password');

        $admin = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($pass),
            'user_image' => '',
        ]);

        $admin->roles()->attach(Role::ADMIN_ROLE);
    }
}
