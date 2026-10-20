<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Les pages du site visiteur s'affichent, même sur une base vide.
     *
     * @dataProvider publicPages
     */
    public function test_public_pages_are_reachable(string $url): void
    {
        $this->get($url)->assertOk();
    }

    public static function publicPages(): array
    {
        return [
            'accueil' => ['/'],
            'à propos' => ['/abouts'],
            'actualités' => ['/actualites'],
            'adresses' => ['/adresses'],
            'contacts' => ['/contacts'],
            'directions' => ['/directions'],
            'galeries' => ['/galeries'],
            'institutions' => ['/institutions'],
            'organigrammes' => ['/organigrammes'],
            'présentations' => ['/presentations'],
            'présidents' => ['/presidents'],
            'réalisations' => ['/realisations'],
        ];
    }

    public function test_contact_form_stores_a_message(): void
    {
        $this->post('/contacts', [
            'nom' => 'Visiteur',
            'email' => 'visiteur@example.com',
            'objet' => 'Question',
            'message' => 'Bonjour',
        ])->assertRedirect(route('contacts.index'));

        $this->assertDatabaseHas('contacts', ['email' => 'visiteur@example.com']);
    }

    public function test_contact_form_rejects_incomplete_data(): void
    {
        $this->post('/contacts', ['nom' => 'Visiteur'])
            ->assertRedirect(route('contacts.index'))
            ->assertSessionHasErrors(['email', 'objet', 'message']);

        $this->assertSame(0, Contact::count());
    }

    public function test_admin_urls_redirect_to_the_back_office(): void
    {
        foreach (['/login', '/admin', '/dashboard'] as $url) {
            $this->get($url)->assertRedirect('/gestion/login.php');
        }
    }
}
