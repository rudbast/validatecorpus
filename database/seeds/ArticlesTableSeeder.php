<?php

use Illuminate\Database\Seeder;

use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Articles' file list
     *
     * @var array
     */
    protected $articlesFile = [
        'database/data/articles/data.json',
        'database/data/articles/data2.json',
        'database/data/articles/data3.json',
        'database/data/articles/data4.json',
        'database/data/articles/data5.json'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->delete();
        foreach ($this->$articlesFile as $articleFile) {
            $data = json_decode(File::get($articleFile));

            foreach ($data as $article) {
                $article->date = Carbon::createFromFormat('Y-m-dTH:i:s.uZ', $article->date);
                Article::create($article);
            }
        }
    }
}
