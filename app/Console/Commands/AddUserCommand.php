<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AddUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:add {email?} {name?} {hash?} {key?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a user';

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
        $email = ($this->argument('email')) ? $this->argument('email') : $this->ask('Email for user');
        $name = ($this->argument('name')) ? $this->argument('name') : $this->ask('Name for user');
        $password = ($this->argument('hash')) ? $this->argument('hash') : bcrypt($this->secret('Password for user'));
        $key_id = ($this->argument('key')) ? $this->argument('key') : $this->ask('Key ID for user');
        $user = User::create([
            'name'             => $name,
            'email'            => $email,
            'password'         => $password,
            'key_id'           => $key_id,
        ]);
        $this->info('User '.$user->email.' created');

        return 0;
    }
}
