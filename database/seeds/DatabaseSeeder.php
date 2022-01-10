<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            UserSeed::class,
        ]);
        factory('App\Models\User',5)->create();

        \App\Models\Configration::create([
            "website_name"=> "invertic",
            "email"=>  "invertic@invertic.com",
            "address"=>  "assuit",
            "phone"=> "01010079798",
            "phone2"=>"01010562643",
            "facebook"=>"www.fb.com",
            "twitter"=> "https://twitter.com/",
            "instagram" => "https://www.instagram.com/",
            "whatsapp"=>"01010075781",
            "description"=>"من نحن - اهدافنا - رؤيتنا",
            "about"=> "معرض تكيفات invertic",
            "terms_conditions"=> "terms and conditions",
            "privacy_policy"=>  "privacy and policy",
            "video"=>"https://www.youtube.com",
            "video2"=>"https://www.youtube.com"
        ]);
        factory('App\Models\Product',50)->create();
        factory('App\Models\Inquiry',50)->create();
        factory('App\Models\Brand',10)->create();
        factory('App\Models\Module',50)->create();
        factory('App\Models\Article',50)->create();
        // factory('App\Models\Event',50)->create();
        }
}
