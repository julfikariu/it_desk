<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['privacy policies', 'terms of use', 'delete_account', 'contact', 'Shared Secret', 'Shared Secret file', 'Shared Secret text', 'welcome'];

//        'name', 'title', 'page_content', 'slug', 'status', 'layout_id', 'key_words', 'delete_able'
        for ($p = 0; $p < count($pages); $p++){
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . 'DAC';

            $systemPage = new Page();
            $systemPage->name = strtolower(str_replace(' ', '_', $pages[$p]));
            $systemPage->title = strtoupper(str_replace('_', ' ', $pages[$p]));
            $systemPage->slug = strtolower(str_replace(' ', '_', $pages[$p])).'_'.time().$x;
            $systemPage->delete_able = false;
            if ($pages[$p] == 'contact'){
                $systemPage->status = true;
                $systemPage->on_page_menu = false;
            }elseif ($pages[$p] == 'Shared Secret'){
                $systemPage->status = true;
                $systemPage->on_page_menu = false;
            }elseif ($pages[$p] == 'Shared Secret file'){
                $systemPage->status = true;
                $systemPage->on_page_menu = false;
            }elseif ($pages[$p] == 'Shared Secret text'){
                $systemPage->status = true;
                $systemPage->on_page_menu = false;
            }elseif ($pages[$p] == 'welcome'){
                $systemPage->status = true;
                $systemPage->on_page_menu = false;
            }else{
                $systemPage->status = false;
                $systemPage->on_page_menu = true;
            }
            $systemPage->save();

            sleep(1);
        }
    }
}
