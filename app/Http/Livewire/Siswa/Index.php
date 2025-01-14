<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Spp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $spp = Spp::leftJoin('months','months.kode','spps.kode')->where('id_user', Auth::user()->id)->first();
        $user = DB::table('users')
        ->leftJoin('data_siswas','data_siswas.id_user','users.id')
        ->leftJoin('poin_sikaps','poin_sikaps.id_user','users.id')
        ->leftJoin('saldos','saldos.id_user','users.id')
        ->leftJoin('hitung_absens','hitung_absens.id_user','users.id')
        ->leftJoin('groups','groups.id_grup','users.id_grup')
        ->where('users.id', Auth::user()->id)
        ->first();
        return view('livewire.siswa.index', compact('user','spp'))
        ->extends('layouts.app')
        ->section('content');
    }
}
