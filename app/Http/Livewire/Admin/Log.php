<?php

namespace App\Http\Livewire\Admin;
use App\Models\Log as LogS;

use DB;
use Livewire\Component;
use Livewire\WithPagination;

class Log extends Component
{
    use WithPagination;
    public $ids, $keterangan;
    public $cari = '';
    public $result = 10;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = DB::table('logs')->leftJoin('users','users.id','logs.id_user')->where('name', 'like','%'.$this->cari.'%')
        ->orderBy('id_log', 'desc')
        ->select('logs.created_at','users.name','logs.status','logs.total','logs.no_ref','logs.id_log','logs.keterangan')
        ->paginate($this->result);
        return view('livewire.admin.log', compact('data'))
        ->extends('layouts.app')
        ->section('content');
    }
    public function edit($id){
        $data = LogS::where('id_log', $id)->first();
        $this->ids = $data->id_log;
        $this->keterangan = $data->keterangan;
    }
    public function update(){
        LogS::where('id_log', $this->ids)->update([
            'keterangan' => $this->keterangan
        ]);
        session()->flash('sukses', 'Data berhasil diedit!');
        $this->dispatchBrowserEvent('closeModal');
    }
    public function k_hapus($id){
        $data = LogS::where('id_log',$id)->first();
        $this->ids = $data->id_log;
    }
    public function delete(){
        LogS::where('id_log', $this->ids)->delete();
        session()->flash('sukses', 'Data berhasil dihapus!');
        $this->dispatchBrowserEvent('closeModal');
    }
}
