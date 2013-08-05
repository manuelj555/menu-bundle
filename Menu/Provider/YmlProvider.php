<?php

namespace KuManuel\Bundle\MenuBundle\Menu\Provider;

use Knp\Menu\ItemInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\Provider\MenuProviderInterface;

class YmlProvider implements MenuProviderInterface
{

    /**
     *
     * @var FactoryInterface
     */
    protected $factory;

    /**
     *
     * @var array
     */
    protected $menus;

    function __construct(FactoryInterface $factory, $menus)
    {
        $this->factory = $factory;
        $this->menus = $menus;
    }

    public function get($name, array $options = array())
    {
        $menu = $this->factory->createItem($name);
        
        $menu->setChildrenAttribute('class', 'nav');

        $this->createItems($menu, $this->menus[$name]);

        return $menu;
    }

    protected function createItems(ItemInterface $menu, array $items)
    {
        foreach ($items as $route => $config) {
            $menu->addChild($config['label'], array('route' => $route));
            if (isset($config['items'])) {
                $item = $menu->getChild($config['label']);
                $item->setAttribute('dropdown', true);
                $this->createItems($item, $config['items']);
            }
        }
    }

    public function has($name, array $options = array())
    {
        return isset($this->menus[$name]);
    }

}