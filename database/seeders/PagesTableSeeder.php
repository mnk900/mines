<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\User;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=User::find(1);
        Page::truncate();
        $about=new Page([
            'title'=>'About',
            'url'=>'/about',
            'content'=>'This is about us page'
        ]);
        $contact=new Page([
            'title'=>'Contact Us',
            'url'=>'/contact',
            'content'=>'This is contact us page'
        ]);
        $faq=new Page([
            'title'=>'Projects',
            'url'=>'/projects',
            'content'=>'This is projects pages'
        ]);
        $admin->pages()->saveMany([
            $about,$contact,$faq,
    ]);

    $about->appendNode($faq);
        //
    }
}
