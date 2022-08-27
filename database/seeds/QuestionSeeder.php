<?php

use App\Quiz;
use Illuminate\Database\Seeder;
class QuestionSeeder extends Seeder{

	public function run(){
		$questions = [
			[
				'id' => 1,
				'name' => 'Un mur en pisé est composé principalement de',
				'choice1' => 'paille',
				'choice2' => 'terre',
				'choice3' => 'mache-fer',
				'choice4' => 'chanvre',
				'answer' => 'terre',
				'quiz_number' => 1
			],
			[
				'id' => 2,
				'name' => 'Un logement avec des menuiseries simple vitrage a pu être construit avant',
				'choice1' => '1992',
				'choice2' => '1985',
				'choice3' => '1988',
				'choice4' => '1975',
				'answer' => '1975',
				'quiz_number' => 1
			],
			[
				'id' => 3,
				'name' => 'Un moellon est',
				'choice1' => 'un bloc de terre',
				'choice2' => 'un bloc ciment',
				'choice3' => 'un petit bloc de pierre',
				'choice4' => 'un bloc creux',
				'answer' => 'un petit bloc de pierre',
				'quiz_number' => 1
			],
			[
				'id' => 4,
				'name' => 'Un doublage mural composé d un vide d air a pu être mis en œuvre avant',
				'choice1' => '1990',
				'choice2' =>  '2000',
				'choice3' =>  '2007',
				'choice4' => '2005',
				'answer' => '1990',
				'quiz_number' => 1
			],
			[
				'id' => 5,
				'name' => 'Un IPN est',
				'choice1' => 'un profilé acier de section normalisée',
				'choice2' => 'un profilé bois de section normalisée',
				'choice3' => 'un indice de poussée normalisé',
				'choice4' => 'un indice de pression normalisé',
				'answer' => 'un profilé acier de section normalisée',
				'quiz_number' => 1
			],
			[
				'id' => 6,
				'name' => 'Un coffrage tunnel permet de couler en une fois',
				'choice1' => 'avec reprise les murs se tles planchers d un ensemble',
				'choice2' => 'sans reprise les murs et les planchers inférieurs d"un ensemble',
				'choice3' => 'zvec ou sans reprise les murs et les planchers inférieurs et supérieurs d"un ensemble',
				'choice4' => 'sans reprise les murs et les planchers supérieurs d"un ensemble',
				'answer' => 'avec reprise les murs se tles planchers d"un ensemble',
				'quiz_number' => 1
			],
			[
				'id' => 7,
				'name' => 'Par rapport à la vapeur d"eau un immeuble récent est plus',
				'choice1' => 'perméable',
				'choice2' => 'imperméable',
				'choice3' => 'poreux',
				'choice4' => 'transparent',
				'answer' => 'imperméable',
				'quiz_number' => 1
			],
			[
				'id' => 8,
				'name' => 'Un mur de type colombage des années 1900 avec remplissage de matériaux naturels',
				'choice1' => 'est une paroi hydrofuge',
				'choice2' => 'hydrophobe',
				'choice3' => 'hydrophile',
				'choice4' => 'hygrophile',
				'answer' => 'hydrophile',
				'quiz_number' => 1
			],
			[
				'id' => 9,
				'name' => 'Dans le cadre du DPE la surface prise en compte dans une maison est la surface',
				'choice1' => 'habitable + dépendances',
				'choice2' => 'somme du plancher et des combles ',
				'choice3' => 'SHON RT',
				'choice4' => 'habitable',
				'answer' => 'habitable',
				'quiz_number' => 1
			],
			[
				'id' => 10,
				'name' =>  'Un mur trombe est',
				'choice1' => 'un dispositif de chauffage solaire passif constitué d"un épais mur de béton peint en noir établi derrière une surface vitrée',
				'choice2' => 'un dispositif de chauffage solaire actif constitué d"un mur et de panneaux solaires',
				'choice3' => 'un dispositif de récupération des eaux de pluie en pied de mur',
				'choice4' => 'un dispositif d"eau chaude solaire constitué de canalisations insérées dans un mur exposé au sud',
				'answer' => 'un dispositif de chauffage solaire passif constitué d"un épais mur de béton peint en noir établi derrière une surface vitrée',
				'quiz_number' => 1
			],
			[
				'id' => 11,
				'name' =>'Les principales déperditions d"une maison des années 1940 non isolée sont',
				'choice1' => 'les ponts thermiques',
				'choice2' => 'la toiture et les murs',
				'choice3' => 'la ventilation et la toiture',
				'choice4' => 'les murs et la ventilation',
				'answer' => 'la toiture et les murs',
				'quiz_number' => 2
			],
			[
				'id' => 12,
				'name' => 'Un bardage double peau est',
				'choice1' => 'un bardage composé de deux plaques parallèles',
				'choice2' => 'un bardage composé d"un isolant et de deux plaques parallèles',
				'choice3' => 'un bardage composé d"un isolant collé à une plaque',
				'choice4' => 'un bardage composé d"un voile pare-vapeur',
				'answer' => 'un bardage composé d"un isolant et de deux plaques parallèles',
				'quiz_number' => 2
			],
			[
				'id' => 13,
				'name' => 'Les principales déperditions d"un appartement non isolé de 1950 situé en étage intermédiaire  sont',
				'choice1' => ' les ventilations',
				'choice2' => 'la plancher bas',
				'choice3' => 'le plancher haut',
				'choice4' => 'les murs et fenêtres',
				'answer' => 'les murs et fenêtres',
				'quiz_number' => 2
			],
			[
				'id' => 14,
				'name' => 'Un plancher collaborant est',
				'choice1' => 'en acier',
				'choice2' => 'en bois',
				'choice3' => 'en résine',
				'choice4' => 'en paille de végétaux',
				'answer' => 'en acier',
				'quiz_number' => 2
			],
			[
				'id' => 15,
				'name' =>  'Les ponts thermiques sont plus importants proportionnellement dans une maison construite avec les systèmes constructifs des années',
				'choice1' => '2001',
				'choice2' => '1900',
				'choice3' => '1950',
				'choice4' => '1970',
				'answer' => '2001',
				'quiz_number' => 2
			],
			[
				'id' => 16,
				'name' => 'Le torchis est un matériau',
				'choice1' => 'de doublage',
				'choice2' => 'de bardage',
				'choice3' => 'de finition',
				'choice4' => 'de remplissage',
				'answer' => 'de remplissage',
				'quiz_number' => 2
			],
			[
				'id' => 17,
				'name' =>  'Une longrine est',
				'choice1' => 'une poutre béton qui forme entretoise entre des pieux ou des puits de fondation',
				'choice2' => 'un IPN',
				'choice3' => 'un poteau béton vertical',
				'choice4' => 'une poutre béton reliant deux murs',
				'answer' => 'une poutre béton qui forme entretoise entre des pieux ou des puits de fondation',
				'quiz_number' => 2
			],
			[
				'id' => 18,
				'name' =>  'Un plancher corps creux est aussi appelé',
				'choice1' => 'hardis',
				'choice2' => 'hourdis',
				'choice3' => 'agglo',
				'choice4' => 'blocs béton',
				'answer' => 'hourdis',
				'quiz_number' => 2
			],
			[
				'id' => 19,
				'name' =>  'Une couverture en lauze est composée',
				'choice1' => 'de bardeaux bois',
				'choice2' => 'de dalles de pierre',
				'choice3' => 'de plaques bitumineuses',
				'choice4' => 'de plaqies de béton allégé',
				'answer' => 'de dalles de pierre',
				'quiz_number' => 2
			],
			[
				'id' => 20,
				'name' => 'Un mur de refend est',
				'choice1' => 'un mur gouttereau',
				'choice2' => 'un mur pignon',
				'choice3' => 'un mur qui reprend des charges',
				'choice4' => 'un mur qui découpe une maison rectangulaire',
				'answer' => 'un mur qui reprend des charges',
				'quiz_number' => 3
			],
			[
				'id' => 21,
				'name' =>  'Parmi ces isolants le plus perméable à la vapeur d"eau est',
				'choice1' => 'le polystyrène expansé',
				'choice2' => 'le polystyrène extrudé',
				'choice3' => 'le polyuréthane',
				'choice4' => 'la laine des bois',
				'answer' => 'la laine des bois',
				'quiz_number' => 3
			],
			[
				'id' => 22,
				'name' => 'Les toitures terrasses végétalisées sont',
				'choice1' => 'intensives',
				'choice2' => 'extensives',
				'choice3' => 'artificielles',
				'choice4' => 'urbano-sensibles',
				'answer' => 'artificielles',
				'quiz_number' => 3
			],
			[
				'id' => 23,
				'name' => 'Quel est le matériau du dormant et de l"ouvrant d"une fenêtre le plus performant en terme d"isolation thermique',
				'choice1' => 'le polychlorure de Vinyle',
				'choice2' => 'le bois',
				'choice3' => 'l"acier',
				'choice4' => 'l"aluminium',
				'answer' => 'le polychlorure de Vinyle',
				'quiz_number' => 3
			],
			[
				'id' => 24,
				'name' => 'Une toiture inversée',
				'choice1' => 'est une toiture terrasse avec isolation sur l"étanchéité',
				'choice2' => 'est une toiture terrasse avec isolation sous l"étanchéité',
				'choice3' => 'est un deux pans formant un angle rentrant',
				'choice4' => 'une toiture à couverture suspendue',
				'answer' => 'est une toiture terrasse avec isolation sur l"étanchéité',
				'quiz_number' => 3
			],
			[
				'id' => 25,
				'name' => 'Un mur en pierre calcaire',
				'choice1' => 'insensible à l"eau',
				'choice2' => 'étanche',
				'choice3' => 'poreux',
				'choice4' => 'non poreux',
				'answer' => 'poreux',
				'quiz_number' => 3
			],
			[
				'id' => 26,
				'name' => 'L"Adret est',
				'choice1' => 'la façade d"une montagne exposée au Sud',
				'choice2' => 'la façade d"une montagne exposée au Nord',
				'choice3' => 'la façade d"une montagne exposée à l"Est',
				'choice4' => 'la façade d"une montagne exposée à l"Ouest',
				'answer' => 'la façade d"une montagne exposée au Sud',
				'quiz_number' => 3
			],
			[
				'id' => 27,
				'name' => 'Une arase étanche est située au niveau',
				'choice1' => 'du faitage',
				'choice2' => 'de l"égout',
				'choice3' => 'du tableau',
				'choice4' => 'du pancher bas',
				'answer' => 'du pancher bas',
				'quiz_number' => 3
			],
			[
				'id' => 28,
				'name' => 'Une longère est',
				'choice1' => 'une maison rurale de grande hauteur',
				'choice2' => 'une maison rurale de plan rectiligne',
				'choice3' => 'un appartement de grande surface',
				'choice4' => 'un bâtiment à usage agricole',
				'answer' => 'une maison rurale de plan rectiligne',
				'quiz_number' => 3
			],
			[
				'id' => 29,
				'name' => 'Un Vélux® est',
				'choice1' => 'un lanterneau',
				'choice2' => 'le nom commercial d"une fenêtre de toit',
				'choice3' => 'une marquise',
				'choice4' => 'un skydome',
				'answer' => 'le nom commercial d"une fenêtre de toit',
				'quiz_number' => 3
			],
			[
				'id' => 30,
				'name' => 'Quel est le bâtiment le moins compact',
				'choice1' => 'une maison rectangulaire',
				'choice2' => 'une maison en L',
				'choice3' => 'une maison carrée',
				'choice4' => 'une maison en U',
				'answer' => 'une maison en U',
				'quiz_number' => 3
			]
		];
		\DB::table('questions')->insert($questions);
	}
}
