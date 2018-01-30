<?php

use Phinx\Seed\AbstractSeed;

class BillPaysSeeder extends AbstractSeed
{
    private $categories;

    public function run()
    {
        require __DIR__ . '/../bootstrap.php';

        $this->categories = \SONFin\Models\CategoryCost::all();
        $faker = \Faker\Factory::create('pr_BR');
        $faker->addProvider($this);
        $billPays = $this->table('bill_pays');
        $data = [];
        foreach (range(1,20) as $value) {
            $userId = rand(1,4);
            $data[] = [
                    'date_launch' => $faker->date(),
                    'name' => $faker->word,
                    'value' => $faker->randomFloat(2, 10, 1000),
                    'user_id' => $userId,
                    'category_cost_id' => $faker->categoryId($userId),
                    'created_at' => date('Y-m-d H;i;s'),
                    'updated_at' => date('Y-m-d H;i;s')
            ];
        }
        $billPays->insert($data)->save();
    }

    public function categoryId($userId) {
        $categories = $this->categories->where('user_id',$userId);
        $categories = $categories->pluck('id');
        return \Faker\Provider\Base::randomElement($categories->toArray());
    }

}
