<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      
        for ($i = 0; $i < 100; $i++) {

            $property = new Property();
            $property
                ->setTitle('produits'.$i)
                ->setDescription(('lorem ipsum'))
                ->setRooms(mt_rand(2, 15))
                ->setSurface(mt_rand(20, 350))
                ->setBedrooms(mt_rand(1, 9))
                ->setFloor(mt_rand(0, 15))
                ->setPrince(mt_rand(10000, 300000))
                ->setHeat(mt_rand(0, count(Property::HEAT) - 1))
                ->setCity('city'.$i)
                ->setAdress('address'.$i)
                ->setPostalCode('postcode'.$i)
                ->setSold(false);

            $manager->persist($property);
        }

        $manager->flush();
    }
}
// $product = new Product();
        // $manager->persist($product);
