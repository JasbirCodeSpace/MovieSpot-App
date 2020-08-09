<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';
    public $searchType = '';
    public function mount($page){
        $this->searchType = explode('/', $page)[0];
    }
    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) >= 2) {
                $searchResults = Http::withToken(config('services.tmdb.token'))
                    ->get(config('services.tmdb.base_url') . '/search/multi/?query=' . $this->search)
                    ->json()['results'];
            
        }

        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(7),
        ]);
    }
}
