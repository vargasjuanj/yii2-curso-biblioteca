<?php

use yii\db\Migration;

/**
 * Class m210828_225818_seed_socio_table
 */
class m210828_225818_seed_socio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {

        $this->insertFakeSocios();
    
    }
    
    private function insertFakeSocios() {
    
            $faker = \Faker\Factory::create();
    
    
            for ($i = 0; $i < 10; $i++) {
    
                $this->insert(
    
                    'socio',
    
                    [
    
                        'nombre' => $faker->name
    
                    ]
    
                );
    
            }
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210828_225818_seed_socio_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210828_225818_seed_socio_table cannot be reverted.\n";

        return false;
    }
    */
}
