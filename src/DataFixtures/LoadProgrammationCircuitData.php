<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ProgrammationCircuit;

class LoadProgrammationCircuitData extends Fixture
{
	public function load(ObjectManager $manager)
        {       

                $circuit = $this->getReference('andalousie-circuit');

                $programmationCircuit = new ProgrammationCircuit();
                $programmationCircuit->setDateDepart(new \DateTime('2018-08-01'));
		$programmationCircuit->setNombrePersonnes(100);
                $programmationCircuit->setPrix(2500);
                $circuit->addProgrammationCircuit($programmationCircuit);
		$manager->persist($programmationCircuit);
		
		$this->addReference('andalousie-programmationCircuit', $programmationCircuit);
		
		$manager->flush();
	}
	
}
// (1, 'Andalousie', 'Espagne', 'Grenade', 'Séville', 4),
// (2, 'VietNam', 'VietNam', 'Hanoi', 'Hô Chi Minh', 4),
// (3, 'Ile de France', 'France', 'Paris', 'Paris', 2),
// (4, 'Italie', 'Italie', 'Milan', 'Rome', 4);
