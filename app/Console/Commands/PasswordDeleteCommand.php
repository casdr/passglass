<?php

namespace App\Console\Commands;

use App\Models\Password;
use Illuminate\Console\Command;

class PasswordDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password:delete {id?} {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a password';

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
        $id = ($this->argument('id')) ? $this->argument('id') : $this->ask('ID of the password');
        $name = ($this->argument('name')) ? $this->argument('name') : $this->ask('Name of the password to confirm');

        $password = Password::find($id);
        if ($password->name != $name) {
            $this->error("Confirmed name is incorrect");
            exit();
        }
        $password->logEntries()->delete();
        $password->delete();
        $this->info('Password ' . $id . ' (' . $name . ') deleted.');
    }
}
