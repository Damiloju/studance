<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;
use Mockery\Exception;

class ProgramController extends Controller
{
    public function getPrograms()
    {
        try{
            $program = new Program;
            $program = $program->all();

            return apiSuccess('Programs gotten succesfully',$program,[]);
        } catch (Exception $e) {
            return apiFailure('Could not get Programs',[],1);
        }

    }
}
