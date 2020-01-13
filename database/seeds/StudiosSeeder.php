<?php

use Illuminate\Database\Seeder;
use App\Models\Studio;

class StudiosSeeder extends Seeder
{
    public function run()
    {
        $studios = [];
        $studio = [];
        $name = ["Rock Music Studio", "Jazz Music Studio", "Classical Music Studio", "Bollywood Music Studio"];
        $locations = ["New Delhi", "Navi Mumbai", "Banglore", "Pune"];
        $prices = [10000, 15000, 12000, 11000];
        $descriptions = [
            "Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            "It has survived not only five centuries, but also the leap into electronic typesetting, 
            remaining essentially unchanged. It was popularised in the 1960s with the release of 
            Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing 
            software like Aldus PageMaker including versions of Lorem Ipsum.",
            "Contrary to popular belief, Lorem Ipsum is not simply random text. 
            It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. 
            Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, 
            consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, 
            discovered the undoubtable source.",
            "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, 
            by injected humour, or randomised words which don't look even slightly believable. 
            If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't 
            anything embarrassing hidden in the middle of text."
        ];
        for ($i=0; $i < 4; $i++) { 
            $studio['name']         = $name[$i];
            $studio['description']  = $descriptions[$i];
            $studio['location']     = $locations[$i];
            $studio['price']        = $prices[$i];
            $studio['opens_at']     = 10;
            $studio['closes_at']    = 19;
            $studios[$i] = $studio;
        }
        Studio::insert($studios);

    }
}
