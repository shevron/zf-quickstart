<?php

namespace Mystuff\Application\Resource;

class View extends \Zend\Application\Resource\View
{
    /**
     * Retrieve view object
     *
     * @return \Zend\View\View
     */
    public function getView()
    {
	echo "I've been here"; exit;
	return parent::getView();
    }
}

