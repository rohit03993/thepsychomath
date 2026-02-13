<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        // Remove old "Career Mapper" entry if it exists
        Client::where('name', 'Career Mapper')->orWhere('name', 'CM')->delete();
        
        // Remove any duplicate clients (keep only the first one of each name)
        $allClients = Client::all();
        $seenNames = [];
        foreach ($allClients as $client) {
            if (in_array($client->name, $seenNames)) {
                $client->delete(); // Delete duplicate
            } else {
                $seenNames[] = $client->name;
            }
        }
        
        $clients = [
            ['name' => 'The Psycho Math', 'initials' => 'TPM', 'order' => 1],
            ['name' => 'EduTech Solutions', 'initials' => 'EDU', 'order' => 2],
            ['name' => 'Guidance Connect', 'initials' => 'GC', 'order' => 3],
            ['name' => 'Career Success', 'initials' => 'CS', 'order' => 4],
            ['name' => 'Future Path', 'initials' => 'FP', 'order' => 5],
            ['name' => 'Student Care', 'initials' => 'SC', 'order' => 6],
        ];

        foreach ($clients as $client) {
            Client::updateOrCreate(
                ['name' => $client['name']],
                array_merge($client, ['is_active' => true])
            );
        }
    }
}