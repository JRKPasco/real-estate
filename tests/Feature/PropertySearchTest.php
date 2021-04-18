<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Property;
use App\Http\Livewire\PropertySearch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertySearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_search_page_can_be_viewed()
    {
        $this->withoutExceptionHandling();

        $this->get('/search')
             ->assertStatus(200)
             ->assertSeeLivewire('property-search');
    }
    
    /** @test */
    public function new_properties_are_listed_first()
    {
        $oldProperty = Property::factory()->state([
            'created_at' => now()->subDay()
        ])->create()->fresh();

        $newProperty = Property::factory()->state([
            'created_at' => now()
        ])->create()->fresh();

        $properties = new Collection([
            $newProperty,
            $oldProperty,
        ]);

        Livewire::test(PropertySearch::class)
            ->assertViewHas('properties', $properties);
    }
}
