<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ProgrammationCircuit;
use App\Entity\Circuit;
class LoadProgrammationCircuitData extends Fixture
{
	public function load(ObjectManager $manager)
	{
    $circuit=$this->getReference('andalousie-circuit');
		$programmation_circuit = new ProgrammationCircuit();
		$programmation_circuit->setDateDepart(new \DateTime('2001-01-01'));
		$programmation_circuit->setNombrePersonnes(15);
		$programmation_circuit->setPrix(400);
    $circuit->addProgrammationCircuit($programmation_circuit);
		$manager->persist($programmation_circuit);

		$this->addReference('andalousie-circuit-programme', $programmation_circuit);

		$manager->persist($circuit);

		$manager->flush();
	}

}
// (1, 'Andalousie', 'Espagne', 'Grenade', 'Séville', 4),
// (2, 'VietNam', 'VietNam', 'Hanoi', 'Hô Chi Minh', 4),
// (3, 'Ile de France', 'France', 'Paris', 'Paris', 2),
// (4, 'Italie', 'Italie', 'Milan', 'Rome', 4);
