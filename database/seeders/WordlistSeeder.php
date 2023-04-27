<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wordlist;

class WordlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = database_path('wordlist.txt');
        $fh = fopen($filename,"r");
        while($data = fgetcsv($fh)){
            $w = new Wordlist;
            $data[0] = iconv( "Windows-1252", "UTF-8", $data[0] );
            $w->word = $data[0];
            $w->definition = $data[1];
            $w->save();
        }
        fclose($fh);
    }
}
