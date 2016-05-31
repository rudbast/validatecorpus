<?php

use Illuminate\Database\Seeder;

use App\Trigram;

class TrigramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trigrams')->delete();
        $data = json_decode(File::get('database/data/trigrams.json'));

        $dataCount  = 0;
        $mappedData = [];

        foreach ($data as $word => $frequency) {
            array_push($mappedData, [
                'word'      => $word,
                'frequency' => $frequency
            ]);

            if ($dataCount++ > 10000) {
                $this->fillTable($mappedData);

                $dataCount  = 0;
                $mappedData = [];
            }
        }

        if (count($mappedData) > 0) {
            $this->fillTable($mappedData);
        }
    }

    protected function fillTable($data)
    {
        DB::disableQueryLog();
        DB::table('trigrams')->insert($data);
    }
}
