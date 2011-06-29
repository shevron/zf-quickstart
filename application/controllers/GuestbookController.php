<?php

use Application\Form\Guestbook as GuestbookForm,
    Application\Model\Guestbook,
    Application\Model\GuestbookMapper,
    Zf2\Mvc\ActionController,
    Zf2\Mvc\RouteStack;

class GuestbookController extends ActionController
{
    public function index()
    {
        return array('entries' => $this->mapper->fetchAll());
    }

    public function sign()
    {
        $request = $this->getRequest();
        $form    = new GuestbookForm();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->post()->toArray())) {
                $comment = new Guestbook($form->getValues());
                $this->mapper->save($comment);

                $redirect = $this->router->assemble(
                    array('controller' => 'guestbook', 'action' => 'index'), 
                    array('name' => 'default')
                );

                $this->response->getHeaders()
                               ->setStatusCode(302)
                               ->addHeader('Location', $redirect);
                return $this->response;
            }
        }

        return array('form' => $form);
    }

    public function setMapper(GuestbookMapper $mapper)
    {
        $this->mapper = $mapper;
        return $this;
    }

    public function setRouter(RouteStack $router)
    {
        $this->router = $router;
        return $this;
    }
}
