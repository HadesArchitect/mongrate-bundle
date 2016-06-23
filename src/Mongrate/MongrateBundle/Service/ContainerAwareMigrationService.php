<?php

namespace Mongrate\MongrateBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Mongrate\Service\MigrationService;

class ContainerAwareMigrationService extends MigrationService implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface $container
     */
    private $container;
 
    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * @inheritdoc
     */
    public function createMigrationInstance(Name $name, OutputInterface $output)
    {
        $migration = parent::createMigrationInstance(Name $name, OutputInterface $output);
        
        if ($migration instanceof ContainerAwareInterface) {
            $migration->setContainer($this->container);
        }
        
        return $migration;
    }
}
