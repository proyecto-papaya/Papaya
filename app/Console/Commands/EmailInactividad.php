<?php

namespace App\Console\Commands;

use App\Mail\Email;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use function Sodium\add;
use Carbon\Carbon;

class EmailInactividad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactividad';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía un corrreo a los usuarios cuando lleven dos meses inactivos en la página';

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
        $users = DB::table('users')
            ->get();

        foreach ($users as $user){
            if ($user->last_login != null){
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $user->last_login);
                $daysToAdd = 60;
                $date = $date->addDays($daysToAdd);

                if($date <  Carbon::now()->toDateString()){
                    //Enviar correo
                    // a $user->email
                    Mail::to($user->email)->send(new Email($date));
                }
            } else{
                continue;
            }
        }


    }
}
