<?php

use App\Category;
use App\Genre;
use App\Metascore;
use App\Product;
use App\ProductGenre;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
           'name' => 'PC',
        ]);

        Category::create([
            'name' => 'PS5',
        ]);

        Category::create([
            'name' => 'XBOX',
        ]);

        Category::create([
            'name' => 'Nintendo Switch',
        ]);

        $adventure = Genre::create([
            'name' => 'Приключения'
        ]);

        $action = Genre::create([
            'name' => 'Экшн'
        ]);

        $rpg = Genre::create([
            'name' => 'RPG'
        ]);

        $soulslike = Genre::create([
            'name' => 'Soulslike'
        ]);

        $roguelike = Genre::create([
            'name' => 'Roguelike'
        ]);

        $porno = Genre::create([
            'name' => 'Порно, хентай'
        ]);

        $shootemup = Genre::create([
            'name' => "Shoot 'em up"
        ]);

        $fighting = Genre::create([
            'name' => 'Файтинг'
        ]);

        $shooter1 = Genre::create([
            'name' => 'Шутер от первого лица'
        ]);

        $shooter3 = Genre::create([
            'name' => 'Шутер от третьего лица'
        ]);

        $horror = Genre::create([
            'name' => 'Хоррор'
        ]);

        $openWorld = Genre::create([
            'name' => 'Открытый мир'
        ]);

        $platfromer = Genre::create([
            'name' => 'Платформер'
        ]);

        $subverse = Product::create([
            'name' => 'Subverse',
            'date' => '2021-03-26',
            'price' => '3199.00',
            'quantity' => '1',
            'description' => "Subverse — это научно-фантастическая стратегия с элементами RPG и shoot 'em up, разработанная студией FOW Interactive. Игра сочетает в себе пошаговую тактическую боевую систему и космические сражения в стиле shoot 'em up. Сюжет вращается вокруг капитана космического корабля и его команды, которые борются за выживание в опасной галактике, полной врагов и загадок.
Особенностью игры является её взрослый контент, включая откровенные сцены и юмор, что делает её уникальной в жанре. Subverse также предлагает проработанный мир, множество персонажей и возможность улучшать корабль и команду. Игра привлекла внимание благодаря успешной кампании на Kickstarter и сочетанию разных игровых механик.",
            'image' => 'img/pc/Subverse.jpeg',
            'category_id' => '1',
        ]);

        $eldenRing = Product::create([
            'name' => 'Elden Ring',
            'date' => '2022-02-25',
            'price' => '3799.00',
            'quantity' => '1',
            'description' => "Elden Ring — это action/RPG с открытым миром, разработанная студией FromSoftware и изданная Bandai Namco Entertainment. Игра создана в collaboration с писателем Джорджем Р. Р. Мартином, который помог в разработке lore и мира.

Действие происходит в фэнтезийном мире под названием Lands Between, где игрок берет на себя роль Tarnished — изгнанника, который стремится восстановить Elden Ring и стать Elden Lord. Мир игры огромен и наполнен разнообразными локациями, подземельями, боссами и тайнами.

Особенности игры:
- Сложные и насыщенные бои, характерные для игр FromSoftware (серия Dark Souls, Bloodborne, Sekiro).
- Открытый мир с полной свободой исследования.
- Система прокачки персонажа, включающая выбор класса, оружия, заклинаний и навыков.
- Множество уникальных боссов и врагов.
- Глубокий lore, который раскрывается через предметы, диалоги и окружение.

Elden Ring получила огромное признание критиков и игроков за свою масштабность, сложность и атмосферу, став одной из самых популярных игр 2022 года.",
            'image' => 'img/ps5/Elden Ring.png',
            'category_id' => '2',
        ]);

        $tekken8 = Product::create([
            'name' => 'TEKKEN 8',
            'date' => '2024-01-26',
            'price' => '3999.00',
            'quantity' => '1',
            'description' => "Tekken 8 — это очередная часть культовой серии файтингов от Bandai Namco. Игра продолжает традиции серии, предлагая динамичные бои в 3D-аренах с глубокой системой комбо и уникальными персонажами.

Основные особенности:
- Улучшенная графика и анимация благодаря новому движку.
- Расширенный roster персонажей, включая как классических бойцов, так и новых.
- Обновленная боевая система с акцентом на агрессивный стиль игры.
- Новые режимы, включая сюжетный, онлайн-сражения и тренировки.

Сюжет продолжает историю клана Мисима, focusing на противостоянии Кадзуи Мисимы и Дзина Кадзамы. Игра вышла в 2024 году и получила положительные отзывы за улучшения геймплея и визуальную составляющую.",
            'image' => 'img/ps5/TEKKEN 8.png',
            'category_id' => '2',
        ]);

        $doomEternal = Product::create([
            'name' => 'DOOM ETERNAL',
            'date' => '2020-03-20',
            'price' => '2499.00',
            'quantity' => '1',
            'description' => "Doom Eternal — это шутер от первого лица, разработанный id Software и изданный Bethesda. Это прямое продолжение Doom (2016), где игрок снова берет на себя роль Doom Slayer, сражаясь с полчищами демонов из ада.

Основные особенности:
- Интенсивные и быстрые бои с акцентом на стратегическое использование оружия и ресурсов.
- Большой арсенал оружия и улучшений.
- Новые движения, такие как dash и climb, для большего контроля в бою.
- Разнообразие демонов и боссов, каждый с уникальными слабостями.
- Расширенный lore и сюжет, раскрывающий историю Doom Slayer и вселенной.

Игра получила высокие оценки за геймплей, графику и саундтрек, став одной из лучших в жанре. Вышла в 2020 году.",
            'image' => 'img/ps5/DOOM ETERNAL.png',
            'category_id' => '2',
        ]);

        $deadSpace = Product::create([
            'name' => 'DEAD SPACE',
            'date' => '2023-01-27',
            'price' => '3499.00',
            'quantity' => '1',
            'description' => "Dead Space Remake — это переосмысление классического хоррор-шутера от третьего лица 2008 года, разработанное студией Motive Studio и изданное EA. Игра сохраняет основную сюжетную линию оригинала, но с современной графикой, улучшенным геймплеем и расширенным lore.

Основные особенности:
- Полностью переработанная графика и звук, создающие атмосферу ужаса.
- Улучшенная система боя и управления.
- Новые элементы сюжета и дополнительные диалоги, углубляющие историю.
- Сохранение ключевых механик, таких как стратегическое отсечение конечностей у врагов (Necromorphs).
- Открытый исследовательский подход к уровню дизайна на космическом корабле USG Ishimura.

Игра вышла в 2023 году и получила высокие оценки за верность оригиналу и современные улучшения.",
            'image' => 'img/ps5/DEAD SPACE.jpg',
            'category_id' => '2',
        ]);

        $hades = Product::create([
            'name' => 'Hades',
            'date' => '2018-12-06',
            'price' => '1999.00',
            'quantity' => '1',
            'description' => "Hades — это roguelike action-RPG, разработанная студией Supergiant Games. Игра сочетает в себе динамичные бои, procedurally generated уровни и глубокий сюжет, вдохновленный греческой мифологией.

Основные особенности:
- Игрок управляет Загреем, сыном Аида, который пытается сбежать из подземного мира.
- Каждый забег уникален благодаря случайно генерируемым уровням, врагам и наградам.
- Большой выбор оружия и способностей, которые можно улучшать.
- Взаимодействие с богами Олимпа, которые дают свои благословения для усиления.
- Глубокий сюжет и персонажи, раскрывающиеся через диалоги и события.

Игра получила огромное признание за геймплей, визуальный стиль и саундтрек, выиграв множество наград. Вышла в 2020 году.",
            'image' => 'img/ps5/Hades.jpg',
            'category_id' => '2',
        ]);

        $spiderMan2 = Product::create([
            'name' => 'Marvel’s Spider-Man 2',
            'date' => '2023-10-20',
            'price' => '4499.00',
            'quantity' => '1',
            'description' => "Marvel’s Spider-Man 2 — это action-adventure игра, разработанная Insomniac Games и изданная Sony Interactive Entertainment. Это продолжение Marvel’s Spider-Man (2018) и Spider-Man: Miles Morales (2020). Игра позволяет игрокам управлять как Питером Паркером, так и Майлзом Моралесом, каждый из которых имеет уникальные способности и сюжетные линии.

Основные особенности:
- Двойной протагонист: переключение между Питером и Майлзом в зависимости от миссий.
- Новые костюмы и улучшения для обоих пауков.
- Появление новых злодеев, включая Венома и Крэйвена-Охотника.
- Расширенный открытый мир Нью-Йорка с новыми районами и активностями.
- Улучшенная боевая система и механика паутины.

Сюжет игры углубляется в личные истории Питера и Майлза, их борьбу с новыми угрозами и внутренние конфликты. Игра вышла в 2023 году и получила высокие оценки за графику, геймплей и сюжет.",
            'image' => 'img/ps5/Marvel’s Spider-Man 2.jpg',
            'category_id' => '2',
        ]);

        $witcher3 = Product::create([
            'name' => 'The Witcher 3: Wild Hunt – Complete Edition',
            'date' => '2015-05-18',
            'price' => '2499.00',
            'quantity' => '1',
            'description' => "The Witcher 3: Wild Hunt – Complete Edition — это расширенная версия культовой RPG от студии CD Projekt Red. Включает основную игру и все дополнения: Hearts of Stone и Blood and Wine.

Основные особенности:
- Игрок управляет Геральтом из Ривии, ведьмаком, который ищет свою приемную дочь Цири, преследуемую таинственной дикой охотой.
- Огромный открытый мир с разнообразными локациями, квестами и персонажами.
- Глубокий сюжет с множеством выборов, влияющих на концовку.
- Улучшенная графика и производительность в Complete Edition.
- Дополнения добавляют новые регионы, сюжетные линии и механики.

Игра получила множество наград и признание за сюжет, мир и геймплей. Complete Edition вышла в 2016 году.",
            'image' => 'img/ps5/The Witcher 3 Wild Hunt – Complete Edition.jpg',
            'category_id' => '2',
        ]);

        ProductGenre::create([
            'product_id' => $subverse->id,
            'genre_id' => $porno->id
        ]);

        ProductGenre::create([
            'product_id' => $subverse->id,
            'genre_id' => $shootemup->id
        ]);

        ProductGenre::create([
            'product_id' => $subverse->id,
            'genre_id' => $adventure->id
        ]);

        ProductGenre::create([
            'product_id' => $eldenRing->id,
            'genre_id' => $soulslike->id
        ]);

        ProductGenre::create([
            'product_id' => $eldenRing->id,
            'genre_id' => $action->id
        ]);

        ProductGenre::create([
            'product_id' => $eldenRing->id,
            'genre_id' => $adventure->id
        ]);

        ProductGenre::create([
            'product_id' => $eldenRing->id,
            'genre_id' => $openWorld->id
        ]);

        ProductGenre::create([
            'product_id' => $eldenRing->id,
            'genre_id' => $rpg->id
        ]);

        ProductGenre::create([
            'product_id' => $deadSpace->id,
            'genre_id' => $horror->id
        ]);

        ProductGenre::create([
            'product_id' => $deadSpace->id,
            'genre_id' => $action->id
        ]);

        ProductGenre::create([
            'product_id' => $deadSpace->id,
            'genre_id' => $shooter3->id
        ]);

        ProductGenre::create([
            'product_id' => $doomEternal->id,
            'genre_id' => $shooter1->id
        ]);

        ProductGenre::create([
            'product_id' => $doomEternal->id,
            'genre_id' => $action->id
        ]);

        ProductGenre::create([
            'product_id' => $doomEternal->id,
            'genre_id' => $adventure->id
        ]);

        ProductGenre::create([
            'product_id' => $doomEternal->id,
            'genre_id' => $platfromer->id
        ]);

        ProductGenre::create([
            'product_id' => $hades->id,
            'genre_id' => $roguelike->id
        ]);

        ProductGenre::create([
            'product_id' => $hades->id,
            'genre_id' => $action->id
        ]);

        ProductGenre::create([
            'product_id' => $hades->id,
            'genre_id' => $rpg->id
        ]);

        ProductGenre::create([
            'product_id' => $hades->id,
            'genre_id' => $fighting->id
        ]);

        ProductGenre::create([
            'product_id' => $spiderMan2->id,
            'genre_id' => $openWorld->id
        ]);

        ProductGenre::create([
            'product_id' => $spiderMan2->id,
            'genre_id' => $action->id
        ]);

        ProductGenre::create([
            'product_id' => $spiderMan2->id,
            'genre_id' => $adventure->id
        ]);

        ProductGenre::create([
            'product_id' => $spiderMan2->id,
            'genre_id' => $fighting->id
        ]);

        ProductGenre::create([
            'product_id' => $tekken8->id,
            'genre_id' => $fighting->id
        ]);

        ProductGenre::create([
            'product_id' => $tekken8->id,
            'genre_id' => $action->id
        ]);

        ProductGenre::create([
            'product_id' => $tekken8->id,
            'genre_id' => $adventure->id
        ]);

        ProductGenre::create([
            'product_id' => $witcher3->id,
            'genre_id' => $openWorld->id
        ]);

        ProductGenre::create([
            'product_id' => $witcher3->id,
            'genre_id' => $action->id
        ]);

        ProductGenre::create([
            'product_id' => $witcher3->id,
            'genre_id' => $adventure->id
        ]);

        ProductGenre::create([
            'product_id' => $witcher3->id,
            'genre_id' => $rpg->id
        ]);

        Metascore::create([
            'product_id' => $subverse->id,
            'meta_score' => '84',
            'user_score' => '84',
        ]);

        Metascore::create([
            'product_id' => $deadSpace->id,
            'meta_score' => '89',
            'user_score' => '84',
        ]);

        Metascore::create([
            'product_id' => $doomEternal->id,
            'meta_score' => '88',
            'user_score' => '86',
        ]);

        Metascore::create([
            'product_id' => $eldenRing->id,
            'meta_score' => '96',
            'user_score' => '82',
        ]);

        Metascore::create([
            'product_id' => $hades->id,
            'meta_score' => '93',
            'user_score' => '86',
        ]);

        Metascore::create([
            'product_id' => $spiderMan2->id,
            'meta_score' => '90',
            'user_score' => '87',
        ]);

        Metascore::create([
            'product_id' => $tekken8->id,
            'meta_score' => '90',
            'user_score' => '76',
        ]);

        Metascore::create([
            'product_id' => $witcher3->id,
            'meta_score' => '92',
            'user_score' => '91',
        ]);

    }
}
