<?php

use Illuminate\Database\Seeder;

class OperationSupportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('OperationSupports')->delete();
      DB::table('OperationSupports')->insert([
          [
              'OperationSupport' => 'OS',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'OperationSupport' => 'OS3',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'OperationSupport' => 'OS5',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'OperationSupport' => 'EOS',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'OperationSupport' => 'EOS3',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'OperationSupport' => 'EOS5',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ]
      ]);
    }
}
