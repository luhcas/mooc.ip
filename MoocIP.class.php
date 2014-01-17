<?php
require 'bootstrap.php';

/**
 * MoocIP.class.php
 *
 * ...
 *
 * @author  virtuos
 * @version 0.1a
 */

class MoocIP extends StudIPPlugin implements SystemPlugin
{

    public function __construct() {
        parent::__construct();

        $navigation = new AutoNavigation(_('Mooc.IP'));
        $navigation->setURL(PluginEngine::GetURL($this, array(), 'show'));
        $navigation->setImage(Assets::image_path('blank.gif'));
        Navigation::addItem('/moocip', $navigation);
    }

    public function initialize ()
    {
        PageLayout::addStylesheet($this->getPluginURL().'/assets/style.css');
        PageLayout::addScript($this->getPluginURL().'/assets/application.js');
    }

    public function perform($unconsumed_path)
    {
        $this->setupAutoload();
        $dispatcher = new Trails_Dispatcher(
            $this->getPluginPath(),
            rtrim(PluginEngine::getLink($this, array(), null), '/'),
            'courseware/index'
        );
        $dispatcher->plugin = $this;
        $dispatcher->dispatch($unconsumed_path);
    }

    private function setupAutoload()
    {
        if (class_exists("StudipAutoloader")) {
            StudipAutoloader::addAutoloadPath(__DIR__ . '/models');
        } else {
            spl_autoload_register(function ($class) {
                include_once __DIR__ . $class . '.php';
            });
        }
    }
}