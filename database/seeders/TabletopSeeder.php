<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TabletopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'system_id' => 5,
                'scenario_id' => 10,
                'owner_user_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'quod',
                'description' => 'Aut dolor rerum iure cumque autem. Porro enim aut mollitia dolor porro cupiditate dolor. Tempora cumque in et pariatur non. Consequatur voluptate eos eligendi qui voluptatibus ab eius. Quisquam modi enim qui ad exercitationem minima. Vel aspernatur laborum consequatur iure et. Accusantium ut autem quia ea dicta eum doloribus molestias. Eos consequatur eum quia repellendus occaecati. Id eligendi molestiae et est rerum magnam voluptatibus. Et natus eius veritatis voluptas. Consequatur reprehenderit dolor sequi doloremque. Voluptatem id perferendis magni eligendi impedit ullam. Sequi consequatur est illo ut. Eaque laboriosam qui dolorum facilis. Ipsa dignissimos enim accusamus consequatur ut. Sunt labore illum nihil earum atque nam. Non veniam est adipisci soluta. Dolorem animi nihil beatae labore. Corporis voluptatem enim omnis placeat ut velit ad.',
                'level' => 'Iniciante',
                'genre' => 'Sci-fi',
                'city' => 'Lake Coty',
                'province' => 'Alagoas',
                'presencial' => 1,
                'next_session' => fake()->dateTimeBetween('+0 days', '+1 years'),
                'frequency' => 'Anual',
                'horary' => '17:41:35',
                'weekday' => 'Sexta-feira',
            ],
            [
                'id' => 2,
                'system_id' => 8,
                'scenario_id' => 13,
                'owner_user_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'in',
                'description' => 'Ut aperiam enim consequatur veniam exercitationem. Facere voluptas omnis blanditiis aliquam. Omnis inventore distinctio dolor cum deserunt. Itaque temporibus possimus quae ex soluta error distinctio. Nam eum molestiae autem sed in ut. Soluta cupiditate sit autem nam. Harum ut molestiae voluptatem molestias ut. Provident id optio dolores fugiat in. Omnis voluptas veritatis corrupti explicabo modi. Esse voluptatum qui blanditiis. Doloribus quaerat quae tenetur voluptate. Rerum voluptates iste ipsam rerum. Voluptas id modi omnis quis minima ad perferendis omnis. Et officiis debitis ipsum ipsum. Doloribus eligendi cum tempore esse omnis nesciunt. Illum ut blanditiis earum commodi voluptas veritatis. Deserunt voluptates nemo laboriosam nemo. Praesentium in ipsa fuga maiores. Et fuga animi voluptatem sapiente veritatis iusto ratione.',
                'level' => 'Iniciante',
                'genre' => 'Dark Fantasy',
                'city' => 'North Briana',
                'province' => 'Maranhão',
                'presencial' => 1,
                'next_session' => fake()->dateTimeBetween('+0 days', '+1 years'),
                'frequency' => 'Semanal',
                'horary' => '08:42:57',
                'weekday' => 'Terça-feira',
            ],
            [
                'id' => 3,
                'system_id' => 6,
                'scenario_id' => 11,
                'owner_user_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'voluptatum',
                'description' => 'Et unde voluptates distinctio illo consequuntur alias doloremque. Molestias ratione rem ex aperiam omnis. Non quis alias iure modi. Cumque recusandae illum sint et. Ea nostrum quibusdam beatae hic aut autem dolor quia. Omnis quia quidem amet. Reprehenderit tempore dolores qui veniam. Quaerat assumenda id enim tenetur voluptatibus culpa et. Deserunt molestiae commodi commodi est occaecati. Est repellendus laboriosam esse maiores nemo velit. Occaecati cum maxime necessitatibus perspiciatis. Quis amet labore adipisci dignissimos. Et recusandae culpa voluptas et rerum repudiandae dolorem. Eos veritatis magnam adipisci illo voluptatum. Nemo voluptas nisi unde possimus omnis non sapiente. Pariatur cumque quisquam iure exercitationem sequi iure voluptatem. Nisi suscipit sed soluta quas dolores non odio. Autem enim non est minima. Quod atque consectetur ut quis. Unde nisi ipsum eaque esse et. Neque qui ut aperiam molestiae qui.',
                'level' => 'Intermediário',
                'genre' => 'Sci-fi',
                'city' => 'East Maya',
                'province' => 'Goiás',
                'presencial' => 0,
                'next_session' => fake()->dateTimeBetween('+0 days', '+1 years'),
                'frequency' => 'Mensal',
                'horary' => '13:10:32',
                'weekday' => 'Quinta-feira',
            ],
            [
                'id' => 4,
                'system_id' => 1,
                'scenario_id' => 6,
                'owner_user_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'consequatur',
                'description' => 'Iste eaque omnis molestiae veniam nam et doloremque. Molestiae eos asperiores perspiciatis repellat molestiae. Officiis impedit est suscipit ipsam. Eum sit velit sint dolores. Aliquam debitis aspernatur numquam. Hic beatae et rerum sit cupiditate quibusdam. Et ut nobis aut quasi iusto minus. Voluptatem sunt reprehenderit ullam quo. Iusto quo et non non ut. Libero fuga voluptatem ratione est repellat commodi. Ut placeat provident provident blanditiis voluptatem id rerum. Neque ea aut eveniet voluptatem. Facere nisi quia quo maiores laudantium et rerum. Ad velit omnis quaerat dolorem natus. A enim dignissimos quo aut quis. Rerum quam omnis hic. Non praesentium in non deleniti placeat similique et. Saepe cumque neque libero aut sint ut.',
                'level' => 'Iniciante',
                'genre' => 'Medieval Fantasy',
                'city' => 'East Tyreekshire',
                'province' => 'Acre',
                'presencial' => 0,
                'next_session' => fake()->dateTimeBetween('+0 days', '+1 years'),
                'frequency' => 'Bimestral',
                'horary' => '10:25:42',
                'weekday' => 'Sábado',
            ],
            [
                'id' => 5,
                'system_id' => 1,
                'scenario_id' => 6,
                'owner_user_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'voluptas',
                'description' => 'Vel dolore voluptas reiciendis inventore et atque ab rerum. Perspiciatis eos neque et voluptatibus dignissimos veritatis. Aut voluptates dignissimos natus ullam a enim nisi. Enim voluptatibus est adipisci commodi aut fugiat. Repudiandae praesentium asperiores vel harum molestiae quod. Sint dicta sed sed ipsum quia praesentium aliquid voluptatum. Enim doloremque qui cum vel facere et non. Sed et autem ducimus impedit neque voluptas et. In non illo error aperiam harum delectus. Quidem architecto autem et culpa id qui. Suscipit delectus cum omnis quis et. Consequatur nihil et repellendus voluptatem deserunt mollitia. Blanditiis aut ratione porro dolorem et. Deserunt sit qui aut. Vel reiciendis ut voluptas ipsam quia dolores et. Excepturi rerum occaecati quia voluptas quia. Minima id quidem sit ad excepturi rem omnis. Ea dolores sit ut voluptate omnis. Tempora qui qui temporibus debitis. Esse voluptates aut deserunt. Numquam qui qui beatae aut quasi nostrum.',
                'level' => 'Veterano',
                'genre' => 'Steampunk',
                'city' => 'North Laurashire',
                'province' => 'Amazonas',
                'presencial' => 1,
                'next_session' => fake()->dateTimeBetween('+0 days', '+1 years'),
                'frequency' => 'Diário',
                'horary' => '18:01:35',
                'weekday' => 'Segunda-feira',
            ],
            [
                'id' => 6,
                'system_id' => 8,
                'scenario_id' => 13,
                'owner_user_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'autem',
                'description' => 'Quo et magnam minus accusamus fuga porro. Suscipit eos reprehenderit qui et neque in. Atque dolores nesciunt fugit quas nisi sapiente expedita provident. Et nihil voluptas temporibus deleniti. Corporis in numquam sint aut aut nostrum voluptatem laboriosam. Voluptatibus dignissimos qui qui mollitia aut. Est fugit dolorem non esse fuga. Quasi ut dolore consequatur dolores animi deserunt. Tempora amet sunt aut suscipit voluptas sunt et. Deleniti voluptates veritatis iste voluptatem odit qui. Non reprehenderit sunt et eaque ipsum. Sunt quae qui repellat ab eius sint magnam. Est possimus eos in ea iure sit. Consequatur aut inventore perspiciatis ut modi quidem quia. Ut cum natus qui et odit. Consequuntur et ab ullam nobis eligendi necessitatibus quisquam. Sint nobis sequi repellat quia aut autem optio. Dicta atque quia ex ea voluptatibus nihil doloribus qui. Est id recusandae excepturi commodi ut.',
                'level' => 'Iniciante',
                'genre' => 'Sci-fi',
                'city' => 'Cummerataport',
                'province' => 'Roraima',
                'presencial' => 1,
                'next_session' => fake()->dateTimeBetween('+0 days', '+1 years'),
                'frequency' => 'Anual',
                'horary' => '01:51:53',
                'weekday' => 'Sábado',
            ],
            [
                'id' => 7,
                'system_id' => 1,
                'scenario_id' => 3,
                'owner_user_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'fugiat',
                'description' => 'Ipsa voluptatem delectus rem molestiae. Et et libero quis labore laborum. Similique ut repellat suscipit autem deleniti optio. Eveniet ipsam est facere eum eum. Quia nesciunt dolores tenetur distinctio voluptas aut unde. Est ex quia perspiciatis asperiores. Possimus architecto ipsam ut odio molestiae reiciendis. Eius esse rem id cumque et. Saepe rem sunt ex natus. Unde libero exercitationem veritatis aliquam consequatur laboriosam qui consequuntur. Cupiditate voluptas nobis recusandae. Nobis qui omnis odit voluptatem voluptates ducimus eligendi autem. Omnis in molestiae ratione. Et ea delectus officiis voluptatibus. Qui necessitatibus hic dignissimos consequatur dolorem voluptatem. Dolorem magnam exercitationem est accusantium quia nam nostrum. Quaerat voluptates odit voluptas et molestiae.',
                'level' => 'Iniciante',
                'genre' => 'Medieval Fantasy',
                'city' => 'West Dameon',
                'province' => 'Roraima',
                'presencial' => 0,
                'next_session' => fake()->dateTimeBetween('+0 days', '+1 years'),
                'frequency' => 'Anual',
                'horary' => '16:57:56',
                'weekday' => 'Sexta-feira',
            ],
            [
                'id' => 8,
                'system_id' => 2,
                'scenario_id' => 2,
                'owner_user_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'nobis',
                'description' => 'Exercitationem alias ut numquam sequi aperiam. Consequatur nihil quasi et ut et rerum. Voluptatem impedit saepe voluptatem et ipsa. Aut dolores est libero odio cumque hic vero totam. Officia mollitia quam enim accusantium culpa iste. Architecto ea ut quisquam id voluptatem. Vel corrupti debitis voluptatem sed ipsum. Dolorum molestiae minima voluptatem minima ex cumque. Veniam deserunt itaque aliquid molestiae est ut. Quos dolorum consequatur minima minus itaque. Atque est excepturi ullam qui dolorem voluptatem dolore. Autem et magnam magni beatae. Id aut beatae sunt. Nostrum dolorem hic blanditiis maiores maxime eos. Perferendis corrupti doloremque recusandae voluptas aut ut adipisci. Quibusdam magni deleniti odio aliquid. Dicta reiciendis dolorum nesciunt optio corporis. Illo quasi iste aliquam fuga est iusto illum. Veniam excepturi aut quia inventore nihil quis. Quis sed qui ipsum nam adipisci et vero.',
                'level' => 'Veterano',
                'genre' => 'Dark Fantasy',
                'city' => 'Brennaburgh',
                'province' => 'Tocantins',
                'presencial' => 0,
                'next_session' => fake()->dateTimeBetween('+0 days', '+1 years'),
                'frequency' => 'Anual',
                'horary' => '04:50:33',
                'weekday' => 'Quinta-feira',
            ],
            [
                'id' => 9,
                'system_id' => 8,
                'scenario_id' => 13,
                'owner_user_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'sapiente',
                'description' => 'Eum cum veritatis rem velit. Ipsum non id quia. Cumque ut omnis soluta eos architecto. Libero nisi voluptatem quod vero. Nemo tempora numquam impedit neque ipsam enim culpa. Et ut mollitia veniam. Ullam ad magni incidunt eos. Maiores doloribus dolor consectetur eaque. Praesentium nihil ab vitae sed cum. Quam et voluptatem accusantium quaerat. Consequatur impedit et suscipit excepturi. Officia vitae veritatis consequatur quis. Fuga sed sunt est officia deserunt ducimus sed. Commodi perspiciatis quae quis eius praesentium magnam. Sed placeat itaque aperiam ut nesciunt. Aut molestias vitae quia exercitationem autem et. Quisquam ullam delectus vel rerum. Recusandae aspernatur in porro. Doloremque quo sed doloremque molestiae sit placeat consequatur. Aliquam voluptatem mollitia quod quia commodi. Illo est laborum labore.',
                'level' => 'Veterano',
                'genre' => 'Dark Fantasy',
                'city' => 'Port Rosetta',
                'province' => 'Mato grosso do sul',
                'presencial' => 1,
                'next_session' => fake()->dateTimeBetween('+0 days', '+1 years'),
                'frequency' => 'Semestral',
                'horary' => '14:53:19',
                'weekday' => 'Quinta-feira',
            ],
            [
                'id' => 10,
                'system_id' => 7,
                'scenario_id' => 12,
                'owner_user_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'quia',
                'description' => 'Quidem est exercitationem ad ipsa sed repellat. Ut vel autem corrupti ullam esse dolores. Aliquid excepturi ut voluptas. Provident aperiam molestiae dignissimos distinctio ut. Nobis voluptatem deleniti aut enim. Maiores ad sit ipsa quis perspiciatis. Sed quo laborum maiores quasi harum quidem animi veritatis. Totam nisi ut eum a aliquam. Doloremque accusantium dolores numquam consequatur. Nemo culpa velit facere consequatur quod quae dolorem. Iste voluptatem facere eum molestias tenetur ut sed quaerat. Voluptatum qui repellendus ea quas unde perferendis sed. Optio quia animi assumenda nam facere nemo. Porro qui quia veniam quia. Ipsa vitae reiciendis et quia assumenda est voluptatum. Natus omnis optio natus sed rerum tempore laborum. Accusamus tenetur eveniet ut animi. Quis sed nostrum consequatur aperiam quos eius incidunt.',
                'level' => 'Veterano',
                'genre' => 'Steampunk',
                'city' => 'New Dessie',
                'province' => 'Tocantins',
                'presencial' => 0,
                'next_session' => fake()->dateTimeBetween('+0 days', '+1 years'),
                'frequency' => 'Bimestral',
                'horary' => '22:32:27',
                'weekday' => 'Sábado',
            ],
        ];

        DB::table('tabletops')->insert($data);
    }
}
