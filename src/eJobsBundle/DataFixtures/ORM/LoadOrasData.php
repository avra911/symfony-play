<?php

namespace eJobsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use eJobsBundle\Entity\Oras;

class LoadOrasData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	$orase = [
    		'Bucharest',
			'Cluj-Napoca',
			'Timișoara',
			'Iași',
    	];

    	foreach($orase as $name) {
    		$city = new Oras();
	        $city->setCityName($name);
	        $manager->persist($city);
    	}
        
        $manager->flush();
    }
}