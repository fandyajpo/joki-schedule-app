<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\JadwalModel;

class JadwalController extends Controller
{
    public function Create()
    {
        DB::table("jadwal")->insert([
            'title' => request("title"),
            'description' => request("description"),
            'location' => request("location"),
            'startDate' => request("startDate"),
            'endDate' => request("endDate"),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back();
    }
    public function Update()
    {
        $u = JadwalModel::find(request("id"));
        $u->title = request("title");
        $u->description = request("description");
        $u->location = request("location");
        $u->startDate = request("startDate");
        $u->endDate = request("endDate");
        $u->updated_at = Carbon::now();
        $u->save();
        return redirect()->back();
    }
    public function Delete()
    {
        JadwalModel::find(request("id"))->delete();
    }
}
