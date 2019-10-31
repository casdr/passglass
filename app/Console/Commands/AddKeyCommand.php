<?php

namespace App\Console\Commands;

use App\Models\Key;
use Illuminate\Console\Command;

class AddKeyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'key:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a key';

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
        $key_lines = "";
        do {
            $key = $this->ask('Enter PGP public key');
            $key_lines = $key_lines . $key . "\n";
        } while (trim($key) != "-----END PGP PUBLIC KEY BLOCK-----");

        do {
            $description = $this->ask('Description for key');
        } while (empty(trim($description)));

        $yubikey = substr($this->ask('Yubikey ID for key'), 0, 12);

        $key = Key::create([
            'description' => $description,
            'gpg_public' => $key_lines,
            'yubikey' => $yubikey,
        ]);

        $this->info('Key ' . $key->id . ' (' . $key->description . ') created');
    }
}
