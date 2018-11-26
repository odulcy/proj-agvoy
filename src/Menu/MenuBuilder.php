<?php

// src/AppBundle/Menu/Builder.php
namespace App\Menu;

use Knp\Menu\FactoryInterface;
// use Symfony\Component\DependencyInjection\ContainerAwareInterface;
// use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

/**
 * MenuBuilder en tant que service (cf. http://symfony.com/doc/master/bundles/KnpMenuBundle/menu_builder_service.html)
 *
 */
class MenuBuilder
{
    private $factory;
    private $container;
    
    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, Container $container)
    {
        $this->factory = $factory;
        $this->container = $container;
    }
    
    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        
        $menu->addChild('Accueil', array('route' => 'home'))
            ->setAttributes(array(
                'class' => 'nav-item',
                'icon' => 'fa fa-list'
              ));
        $menu['Accueil']->setLinkAttribute('class', 'nav-link');

        $menu->addChild('Liste des circuits', array('route' => 'frontoffice_home'))
            ->setAttributes(array(
                'class' => 'nav-item',
                'icon' => 'fa fa-list'
            ));
        $menu['Liste des circuits']->setLinkAttribute('class', 'nav-link');
        return $menu;
    }
    
    public function createUserMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navbar-collapse collapse nav navbar-nav  ml-auto');
        $menu->setChildrenAttribute('id', 'collapsibleNavbar');
        
        //if($this->container->get('security.context')->isGranted(array('ROLE_ADMIN', 'ROLE_USER'))) {} // Check if the visitor has any authenticated roles
        if($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            // Get username of the current logged in user
            $username = $this->container->get('security.token_storage')->getToken()->getUser()->getUsername();
            $label = 'Bonjour '. $username;
            $menu->addChild('Déconnexion', array('route' => 'fos_user_security_logout'))
                ->setAttributes(array(
                    'class' => 'nav-item'
                ));
            $menu['Déconnexion']->setLinkAttribute('class', 'nav-link');
        }
        else 
       {
            $label = 'Bonjour, visiteur'; 
            $menu->addChild('Connexion', array('route' => 'fos_user_security_login'))
                ->setAttributes(array(
                    'class' => 'nav-item'
                ));
            $menu['Connexion']->setLinkAttribute('class', 'nav-link');
        }
        $menu->addChild('User', array('label' => $label))
          ->setAttributes(array(
                'dropdown' => true,
                'class' => 'nav-item'
              ));

        
        return $menu;
    }
    
}
