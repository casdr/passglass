<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all users in system';

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
        $headers = ['Name', 'E-mail address', 'Key'];
        $result = [];
        $users = User::all();
        foreach($users as $user) {
            $result[] = [
                $user->name,
                $user->email,
                $user->key->description . ' (' . $user->key->yubikey . ')'
            ];
        }
        $this->table($headers, $result);
    }
}
