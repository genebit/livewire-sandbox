<?php

namespace App\Http\Livewire;

use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;

class Form extends Component
{
    public $count, $country;
    public $counterLogs;
    public $countries;

    public function mount()
    {
        $this->count = 0;
        $this->country = null;
        $this->counterLogs = [];

        // set the countries
        $this->countries = [
            (object)['name' => 'India', 'code' => 'IN'],
            (object)['name' => 'United Kingdom', 'code' => 'UK'],
            (object)['name' => 'United States', 'code' => 'US'],
        ];
    }

    public function increment()
    {
        $this->count++;

        $data = [
            'count' => $this->count,
            'country'=> $this->country,
            'created_at' => now()->toIso8601String()
        ];

        // log the count with count and timestamp
        array_push($this->counterLogs, $data);

        $this->emit('countUpdated', $data);
    }

    public function decrement()
    {
        $this->count--;

        $data = [
            'count' => $this->count,
            'country'=> $this->country,
            'created_at' => now()->toIso8601String()
        ];

        // log the count with count and timestamp
        array_push($this->counterLogs, $data);

        $this->emit('countUpdated', $data);
    }

    public function render()
    {
        return view('pages.counter.components.form')
            ->extends('layouts.app');
    }
}
