<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a user based on it\'s e-mail address';

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
        $email = ($this->argument('email')) ? $this->argument('email') : $this->ask('Email of user');
        if(!User::where('email', $email)->delete()) {
            $this->error('No user with email ' . $email);
            return 1;
        }
        $this->info('User with email ' . $email . ' deleted');
        return 0;
    }
}
