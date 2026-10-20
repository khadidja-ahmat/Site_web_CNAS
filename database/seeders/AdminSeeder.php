<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Crée (ou met à jour) le compte administrateur du back-office.
     *
     * L'e-mail et le mot de passe sont lus dans le fichier .env
     * (ADMIN_EMAIL, ADMIN_PASSWORD) : aucun identifiant n'est écrit dans le code.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (empty($email) || empty($password)) {
            $this->command->error(
                'ADMIN_EMAIL et ADMIN_PASSWORD doivent être définis dans le fichier .env avant de lancer le seeder.'
            );

            return;
        }

        // Le modèle Admin hache le mot de passe (cast "hashed").
        Admin::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'Administrateur'),
                'password' => $password,
            ]
        );

        $this->command->info("Compte administrateur prêt : {$email}");
    }
}
