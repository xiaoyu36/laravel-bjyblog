<?php

declare(strict_types=1);

namespace App\Console\Commands\Upgrade;

use DB;
use Illuminate\Console\Command;

class V6_0_0 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upgrade:v6.0.0';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'upgrade to v6.0.0';

    public function handle(): int
    {
        DB::table('migrations')->insert([
            'migration' => '2019_08_19_000000_create_failed_jobs_table',
            'batch'     => 1,
        ]);

        $envContent = file_get_contents(base_path('.env'));
        $env        = str_replace('SCOUT_DRIVER=tntsearch', 'SCOUT_DRIVER=null', $envContent);
        file_put_contents(base_path('.env'), $env);

        return 0;
    }
}
