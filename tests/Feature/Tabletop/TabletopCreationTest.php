<?php

namespace Tests\Feature\Tabletop;

use App\Models\Tabletop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class TabletopCreationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_tabletop_create_form_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/mesas/criar');

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Tabletop/Create'));
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $response = $this->get('/mesas/criar');

        $response->assertRedirect('/login');
    }

    public function test_tabletops_can_be_created(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/mesas', [
            'name' => 'Primeira mesa',
            'genre' => 'Fantasia Medieval',
            'city' => 'Recife',
            'province' => 'Pernambuco',
            'level' => 'Iniciante',
            'description' => 'Lorem ipsum dolor sit amet',
            'presencial' => true,
            'frequency' => 'Mensal',
            'horary' => '14:00',
            'weekday' => 'Sábado',
        ]);

        $response->assertRedirect('/mesas/minhas-mesas');
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tabletops', [
            'name' => 'Primeira Mesa',
        ]);
    }

    public function test_guest_users_cannot_create_tabletops(): void
    {
        $response = $this->post('/mesas', [
            'name' => 'Primeira mesa',
            'genre' => 'Fantasia Medieval',
            'city' => 'Recife',
            'province' => 'Pernambuco',
            'level' => 'Iniciante',
            'description' => 'Lorem ipsum dolor sit amet',
            'presencial' => true,
            'frequency' => 'Mensal',
            'horary' => '14:00',
            'weekday' => 'Sábado',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('tabletops', [
            'name' => 'Primeira mesa',
        ]);
    }

    /**
     * @dataProvider invalidFormData
     */
    public function test_store_validation_rules_are_working($invalidData, $invalidFields): void
    {
        $user = User::factory()->create();
        $firstTabletop = Tabletop::factory()->for($user, 'owner_user')->create(['name' => 'First tabletop']);

        $response = $this->actingAs($user)->post('/mesas', $invalidData);

        $response->assertInvalid($invalidFields);
        $response->assertRedirect();
        $this->assertDatabaseCount('tabletops', 1);
    }

    public static function invalidFormData(): array
    {
        return [
            'required fields are empty' => [
                ['name' => null, 'genre' => null, 'city' => null, 'province' => null, 'level' => null, 'description' => null, 'presencial' => null, 'frequency' => null, 'horary' => null, 'weekday' => null],
                ['name', 'genre', 'level', 'description', 'presencial'],
            ],
            'invalid enum fields' => [
                ['name' => 'Primeira mesa', 'genre' => 'Carapicuíba', 'city' => 'Recife', 'province' => 'Gascunha', 'level' => '2', 'description' => 'Lorem ipsum dolor sit amet', 'presencial' => true, 'frequency' => 'A cada dia 30 de fevereiro', 'horary' => 'Meia noite te conto', 'weekday' => 'Dia de são nunca'],
                ['genre', 'province', 'level', 'frequency', 'horary', 'weekday'],
            ],
            'empty province and city when tabletop is presencial' => [
                ['name' => 'Primeira mesa',
                    'genre' => 'Fantasia Medieval',
                    'city' => null,
                    'province' => null,
                    'level' => 'Iniciante',
                    'description' => 'Lorem ipsum dolor sit amet',
                    'presencial' => true,
                    'frequency' => 'Mensal',
                    'horary' => '14:00',
                    'weekday' => 'Sábado',
                ], ['province', 'city'],
            ],
            'name is not unique' => [
                ['name' => 'First tabletop',
                    'genre' => 'Fantasia Medieval',
                    'city' => 'Recife',
                    'province' => 'Pernambuco',
                    'level' => 'Iniciante',
                    'description' => 'Lorem ipsum dolor sit amet',
                    'presencial' => true,
                    'frequency' => 'Mensal',
                    'horary' => '14:00',
                    'weekday' => 'Sábado', ],
                ['name'],
            ],
            'fields are longer than allowed' => [
                ['name' => 'enim tortor at auctor urna nunc id cursus metus aliquam eleifend mi in nulla posuere sollicitudin al....................',
                    'genre' => 'Fantasia Medieval',
                    'city' => 'enim tortor at auctor urna nunc id cursus metus aliquam eleifend mi in nulla posuere sollicitudin al ........',
                    'province' => 'Pernambuco',
                    'level' => 'Iniciante',
                    'description' => 'adipiscing commodo elit at imperdiet dui accumsan sit amet nulla facilisi morbi tempus iaculis urna id volutpat lacus laoreet non curabitur gravida arcu ac tortor dignissim convallis aenean et tortor at risus viverra adipiscing at in tellus integer feugiat scelerisque varius morbi enim nunc faucibus a pellentesque sit amet porttitor eget dolor morbi non arcu risus quis varius quam quisque id diam vel quam elementum pulvinar etiam non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor sit amet consectetur adipiscing elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi nullam vehicula ipsum a arcu cursus vitae congue mauris rhoncus aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas maecenas pharetra convallis posuere morbi leo urna molestie at elementum eu facilisis sed odio morbi quis commodo odio aenean sed adipiscing diam donec adipiscing tristique risus. . dsa',
                    'presencial' => true,
                    'frequency' => 'Mensal',
                    'horary' => '14:00',
                    'weekday' => 'Sábado', ], ['description', 'name', 'city'],
            ],
            'Horary in invalid format' => [
                ['name' => 'Primeira mesa',
                    'genre' => 'Fantasia Medieval',
                    'city' => 'Recife',
                    'province' => 'Pernambuco',
                    'level' => 'Iniciante',
                    'description' => 'Lorem ipsum dolor sit amet',
                    'presencial' => true,
                    'frequency' => 'Mensal',
                    'horary' => '11-02',
                    'weekday' => 'Sábado', ], ['horary'],
            ],
            'Presencial is not boolean' => [
                ['name' => 'Primeira mesa',
                    'genre' => 'Fantasia Medieval',
                    'city' => 'Recife',
                    'province' => 'Pernambuco',
                    'level' => 'Iniciante',
                    'description' => 'Lorem ipsum dolor sit amet',
                    'presencial' => 'not so true',
                    'frequency' => 'Mensal',
                    'horary' => '14:00',
                    'weekday' => 'Sábado', ], ['presencial'],
            ],
        ];
    }
}
