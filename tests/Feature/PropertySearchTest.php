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
    public function test_newest_properties_are_listed_first()
    {
        $properties = new Collection([
            Property::factory()->state(['created_at' => now()])->create()->fresh(),
            Property::factory()->state(['created_at' => now()->subDay()])->create()->fresh(),
        ]);

        Livewire::test(PropertySearch::class)
            ->assertViewHas('properties', $properties);
    }
}
