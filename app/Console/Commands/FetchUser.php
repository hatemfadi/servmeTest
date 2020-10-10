<?php


namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class FetchUser extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'servme:fetch-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Fetch a user to authenticate";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find(1);
        $client = DB::select(DB::raw("SELECT id, secret FROM app_db.oauth_clients where personal_access_client = 0 AND password_client = 1;"));
        echo "******** Please use the below CREDENTIALS to authenticate *********\n";
        echo "Username: " . $user->email . "\n";
        echo "Password: secret\n";
        echo "CLient ID: " . $client[0]->id . "\n";
        echo "CLient Secret: " . $client[0]->secret . "\n";
        echo "*******************************************************************\n";
        return null;
    }

}
