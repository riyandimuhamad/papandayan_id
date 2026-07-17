<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CloneDbCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clone {from=mysql} {to=sqlite}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clone data from one database connection to another (e.g. MySQL to SQLite)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $from = $this->argument('from');
        $to = $this->argument('to');

        $this->info("Cloning database from [$from] to [$to]...");

        // Disable foreign key checks on target to avoid constraint issues during insert
        if ($to === 'sqlite') {
            DB::connection($to)->statement('PRAGMA foreign_keys = OFF;');
        }

        $tables = DB::connection($from)->select('SHOW TABLES');
        $dbName = 'Tables_in_' . env('DB_DATABASE');

        foreach ($tables as $table) {
            $tableName = $table->{$dbName} ?? ((array)$table)[array_keys((array)$table)[0]];
            
            // Skip migrations table because we will run migrate on the target DB first
            if ($tableName == 'migrations') {
                continue;
            }

            $this->info("Cloning table: $tableName");

            // Empty the target table first
            DB::connection($to)->table($tableName)->truncate();

            // Fetch data
            $data = DB::connection($from)->table($tableName)->get()->map(function ($item) {
                return (array) $item;
            })->toArray();

            if (count($data) > 0) {
                // Chunk insert
                foreach (array_chunk($data, 100) as $chunk) {
                    DB::connection($to)->table($tableName)->insert($chunk);
                }
                $this->info(" - Copied " . count($data) . " rows.");
            } else {
                $this->info(" - Table is empty.");
            }
        }

        if ($to === 'sqlite') {
            DB::connection($to)->statement('PRAGMA foreign_keys = ON;');
        }

        $this->info('Database cloned successfully!');
    }
}
