<?php

namespace App\DataFixtures;

use App\Entity\Livres;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LivresFixtures extends Fixture
{
    public function load(ObjectManager $em): void
    {   $faker=Factory::create('ar_SA');
        for ($i=1;$i<=100;$i++) {
        $livre = new Livres();
        $livre->setLibelle($faker->name())
            ->setPrix(random_int(10,300))
            ->setEditeur($faker->company())
            ->setDateEdition(new \DateTime('2022-01-01'))
            ->setResume($faker->text())
            ->setImage('https://picsum.photos/?random='.$i);
        $em->persist($livre);
    }
        $em->flush();
    }
}
