<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Products')->insert(array(
            //Fruits
            array('product_name' => 'Abricot', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Amande', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Ananas', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Avocat', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Banane', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Cassis', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Cerise', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Citron', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Clémentine', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Coing', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Datte', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Figue', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Fraise', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Fraise des bois', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Framboise', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Fruit de la passion', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Grenade', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Groseille', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Kaki', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Kiwi', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Litchi', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Mandarine', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Mangue', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Marron', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Melon', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Mirabelle', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Mûre', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Myrtille', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Nectarine', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Noisette', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Papaye', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Pamplemousse', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Orange', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Pastèque', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Pêche', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Poire', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Pomme', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Prune', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Raisin', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Tomate', 'product_categories_idproduct_category' => 1, 'Types_measure_idTypes_measure' => 2),
            // Légumes
            array('product_name' => 'Ail', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Artichaut', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Asperge', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Aubergine', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Bette', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Bambou', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Bénincasa', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Blette', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Brocoli', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Céleri', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Champignon', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Choux', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Citrouille', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Concombre', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Cornichon', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Courge', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Courgette', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Cresson', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Dachine', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Daikon', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Échalote', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Épinard', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Fenouil', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Fève', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Frisée', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Flageolet', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Gingembre', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Haricot', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Jujube', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Laitue', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Lentille', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Mâche', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Maïs', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Manioc', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Navet', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Oignon', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Olive', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Oseille', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Panais', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Patate', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Petit pois', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Poireau', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Pomme de terre', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Potimarron', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Potiron', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Radis', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Rhubarbe', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Rutabaga', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Roquette', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Salsifi', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Soja', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Topinambour', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Wakame', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Wasabi', 'product_categories_idproduct_category' => 2, 'Types_measure_idTypes_measure' => 2),
            //Céréales
            array('product_name' => 'Riz', 'product_categories_idproduct_category' => 3, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Maïs', 'product_categories_idproduct_category' => 3, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Blé', 'product_categories_idproduct_category' => 3, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Avoine', 'product_categories_idproduct_category' => 3, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Orge', 'product_categories_idproduct_category' => 3, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Farine de Blé', 'product_categories_idproduct_category' => 3, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Farine de Maïs', 'product_categories_idproduct_category' => 3, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => "Farine d'avoine", 'product_categories_idproduct_category' => 3, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => "Farine d'orge", 'product_categories_idproduct_category' => 3, 'Types_measure_idTypes_measure' => 2),
            //Boissons
            array('product_name' => 'Citronnade', 'product_categories_idproduct_category' => 4, 'Types_measure_idTypes_measure' => 3),
            array('product_name' => 'Lait de vache', 'product_categories_idproduct_category' => 4, 'Types_measure_idTypes_measure' => 3),
            array('product_name' => 'Lait de brebis', 'product_categories_idproduct_category' => 4, 'Types_measure_idTypes_measure' => 3),
            array('product_name' => 'Lait de chamelle', 'product_categories_idproduct_category' => 4, 'Types_measure_idTypes_measure' => 3),
            array('product_name' => "Lait d'amande", 'product_categories_idproduct_category' => 4, 'Types_measure_idTypes_measure' => 3),
            array('product_name' => 'Lait de soja', 'product_categories_idproduct_category' => 4, 'Types_measure_idTypes_measure' => 3),
            array('product_name' => 'Lait de coco', 'product_categories_idproduct_category' => 4, 'Types_measure_idTypes_measure' => 3),
            //Epices
            array('product_name' => 'Ail sec', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Amchoor', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Anardana', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Anis', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Basilic', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Cannelle', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Cardamome', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Casse', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Coriandre', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Cumin', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Curcuma', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Fenouil', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Gingembre', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Laurier', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Lavande', 'producGiroflet_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Menthe', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Noix de muscade', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Origan', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Romarin', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Safran', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Sauge', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Thym', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),
            array('product_name' => 'Vanille', 'product_categories_idproduct_category' => 6, 'Types_measure_idTypes_measure' => 2),

        ));

    }
}
















