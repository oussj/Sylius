<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use PSS\SymfonyMockerContainer\DependencyInjection\MockerContainer;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    public function registerBundles(): array
    {
        return [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new winzou\Bundle\StateMachineBundle\winzouStateMachineBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new BabDev\PagerfantaBundle\BabDevPagerfantaBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sylius\Bundle\UserBundle\SyliusUserBundle(),
            new Sylius\Bundle\MailerBundle\SyliusMailerBundle(),
            new Sylius\Bundle\ReviewBundle\SyliusReviewBundle(),
            new Sylius\Bundle\ResourceBundle\SyliusResourceBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__ . '/config/config.yml');
    }

    protected function getContainerBaseClass(): string
    {
        if (str_starts_with($this->environment, 'test')) {
            return MockerContainer::class;
        }

        return parent::getContainerBaseClass();
    }
}
