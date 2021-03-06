<?php

namespace SveWap\A21glossary\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;

class GlossaryController extends ActionController
{
    /**
     * @var \SveWap\A21glossary\Domain\Repository\GlossaryRepository
     * @inject
     */
    protected $glossaryRepository;

    /**
     * @param string $char
     *
     * @throws InvalidQueryException
     */
    public function indexAction($char = null)
    {
        $this->view->assign('index', $this->glossaryRepository->findAllForIndex());
        if (!empty($char)) {
            $this->view->assign('currentChar', $char);
            $this->view->assign('glossaryItems', $this->glossaryRepository->findAllWithChar($char));
        } else {
            $this->view->assign('glossaryItems', $this->glossaryRepository->findAll());
        }
    }

    /**
     * @param string $q
     *
     * @throws InvalidQueryException
     */
    public function searchAction($q)
    {
        $this->view->assign('q', $q);
        $this->view->assign('glossaryItems', $this->glossaryRepository->findAllWithQuery($q));
    }
}
