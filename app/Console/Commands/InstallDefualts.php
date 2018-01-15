<?php

namespace App\Console\Commands;

use App\College;
use App\Department;
use App\Program;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InstallDefualts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'defaults:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Application Defaults';

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
        DB::transaction(function() {
            $this->createDefaultUser();
            $this->uploadColleges();
            $this->uploadDepartments();
            $this->uploadPrograms();
        });

        $this->info('Application Defaults installed successfully');

        return;
    }

    public function createDefaultUser()
    {
        $data = config('default.super_user');

        $data['password'] = bcrypt($data['password']);

        return User::create($data);
    }
    public function uploadColleges()
    {
        $data = config('default.colleges');

        $college = new College();

        return $college->createNew($data);
    }

    public function uploadDepartments()
    {
        $data = config('default.departments');

        $dept = new Department();

        return $dept->createNew($data);
    }

    public function uploadPrograms()
    {
        $data = config('default.programs');

        $program = new Program();

        return $program->createNew($data);
    }
}
