<?php

namespace App\Http\Livewire;

use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;

class Table extends Component
{
    public $counterLogs;

    protected $listeners = ['countUpdated' => 'storeLogs'];

    public function mount()
    {
        $this->counterLogs = [];
    }

    public function storeLogs($data)
    {
        array_push($this->counterLogs, $data);

        $this->emit('logStored');
    }

    public function render()
    {
        return view('pages.counter.components.table')
            ->extends('layouts.app');
    }
}
