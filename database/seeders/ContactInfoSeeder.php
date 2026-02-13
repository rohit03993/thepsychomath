<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactInfo;

class ContactInfoSeeder extends Seeder
{
    public function run(): void
    {
        ContactInfo::updateOrCreate(
            ['id' => 1],
            [
                'location' => 'A, 25/39, Middle Circle, Near Me A, Behind Marina Hotel, Block G, Connaught Place, New Delhi, Delhi 110001',
                'office_address' => 'Raj Bharti House, Bhagwanpur, BHU, Varanasi -221005 U.P',
                'email' => 'info@thepsychomath.org',
                'phone' => '+91 6396292221',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.1234567890!2d77.2069!3d28.6280!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd5b347eb62d%3A0x52c2b7494e204dce!2sConnaught%20Place%2C%20New%20Delhi%2C%20Delhi%20110001!5e0!3m2!1sen!2sin!4v1234567890',
                'is_active' => true,
            ]
        );
    }
}