<?php

namespace App\Http\Controllers;

use App\Models\CommandModel;
use App\Models\PPKSModel;
use App\Models\FlowguideModel;
use App\Models\RPTHarianModel;
use App\Models\RPTPNBPHarianModel;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $command = array();
        return view('admin.tabelAdmin', [
            "title" => "Chatbot Command",
            "command" => CommandModel::all()->sortByDesc("created_at"),
        ]);
    }

    public function deleteCommand($id)
    {
        CommandModel::where('id', $id)->delete();
        return redirect('/admin/command');
    }

    public function deleteAll()
    {
        CommandModel::truncate();
        return redirect('/admin/command');
    }
}