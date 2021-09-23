<?php

use yii\db\Migration;

/**
 * Class m210828_225852_seed_libro_table
 */
class m210828_225852_seed_libro_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {

        $this->insertFakeLibros();
     
     }
     
     
     private function insertFakeLibros() {
     
             $faker = \Faker\Factory::create();
     
             for ($i = 0; $i < 50; $i++) {
     
                 $this->insert(
     
                     'libro',
     
                     [
     
                         'titulo'         => $faker->catchPhrase,
     
                         'autor'       => $faker->name,
     
                         'anio_publicacion' => (int)$faker->year,
     
                     ]
     
                 );
     
             }
     
         }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210828_225852_seed_libro_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210828_225852_seed_libro_table cannot be reverted.\n";

        return false;
    }
    */
}
