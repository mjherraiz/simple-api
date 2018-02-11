<?php
namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName('product ' . $i);
            $manager->persist($product);
        }
        $user = new User();
        $user->setUsername('api');
        $user->setEmail('test@me.com');
        $password = $this->encoder->encodePassword($user, 'api');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();

    }
}