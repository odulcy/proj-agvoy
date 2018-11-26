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
                $programmationCircuit->setPrix(1500);
                $circuit->addProgrammationCircuit($programmationCircuit);
		$manager->persist($programmationCircuit);
		
		$this->addReference('andalousie-programmationCircuit', $programmationCircuit);
		
                $circuit = $this->getReference('idf-circuit');

                $programmationCircuit = new ProgrammationCircuit();
                $programmationCircuit->setDateDepart(new \DateTime('2018-12-01'));
		$programmationCircuit->setNombrePersonnes(4);
                $programmationCircuit->setPrix(2300);
                $circuit->addProgrammationCircuit($programmationCircuit);
		$manager->persist($programmationCircuit);
		
		$this->addReference('idf-programmationCircuit', $programmationCircuit);

                $circuit = $this->getReference('italie-circuit');

                $programmationCircuit = new ProgrammationCircuit();
                $programmationCircuit->setDateDepart(new \DateTime('2018-11-09'));
		$programmationCircuit->setNombrePersonnes(100);
                $programmationCircuit->setPrix(2500);

		$manager->persist($programmationCircuit);
		
		$this->addReference('italie-programmationCircuit', $programmationCircuit);

                $circuit = $this->getReference('vietnam-circuit');

                $programmationCircuit = new ProgrammationCircuit();
                $programmationCircuit->setDateDepart(new \DateTime('2019-01-06'));
		$programmationCircuit->setNombrePersonnes(100);
                $programmationCircuit->setPrix(2500);
                $circuit->addProgrammationCircuit($programmationCircuit);
		$manager->persist($programmationCircuit);

		$this->addReference('vietnam-programmationCircuit', $programmationCircuit);

                $circuit = $this->getReference('andalousie-circuit');

                $programmationCircuit = new ProgrammationCircuit();
                $programmationCircuit->setDateDepart(new \DateTime('2019-02-03'));
		$programmationCircuit->setNombrePersonnes(100);
                $programmationCircuit->setPrix(2500);
                $circuit->addProgrammationCircuit($programmationCircuit);
		$manager->persist($programmationCircuit);
		
		$this->addReference('andalousie-programmationCircuit2', $programmationCircuit);

                $circuit = $this->getReference('idf-circuit');

                $programmationCircuit = new ProgrammationCircuit();
                $programmationCircuit->setDateDepart(new \DateTime('2019-06-04'));
		$programmationCircuit->setNombrePersonnes(100);
                $programmationCircuit->setPrix(2500);
                $circuit->addProgrammationCircuit($programmationCircuit);
		$manager->persist($programmationCircuit);
		
		$this->addReference('idf-programmationCircuit2', $programmationCircuit);

		$manager->flush();
	}
	
}
// (1, 'Andalousie', 'Espagne', 'Grenade', 'Séville', 4),
// (2, 'VietNam', 'VietNam', 'Hanoi', 'Hô Chi Minh', 4),
// (3, 'Ile de France', 'France', 'Paris', 'Paris', 2),
// (4, 'Italie', 'Italie', 'Milan', 'Rome', 4);
