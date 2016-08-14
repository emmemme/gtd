<?php
namespace ThomasWoehlke\Gtd\Service;

/***
 *
 * This file is part of the "Getting Things Done" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2016 Thomas Woehlke <thomas@woehlke.org>, faktura gGmbH
 *
 ***/

use ThomasWoehlke\Gtd\Domain\Model\Context;
use ThomasWoehlke\Gtd\Domain\Model\UserConfig;

class ContextService implements \TYPO3\CMS\Core\SingletonInterface
{

    /**
     * contextRepository
     *
     * @var \ThomasWoehlke\Gtd\Domain\Repository\ContextRepository
     * @inject
     */
    protected $contextRepository = null;

    /**
     * userAccountRepository
     *
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
     * @inject
     */
    protected $userAccountRepository = null;

    /**
     * userConfigRepository
     *
     * @var \ThomasWoehlke\Gtd\Domain\Repository\UserConfigRepository
     * @inject
     */
    protected $userConfigRepository = null;

    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function getContextList(){
        /** @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $userObject */
        $userObject = $this->userAccountRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
        $contextList = $this->contextRepository->findAllByUserAccount($userObject);
        if($contextList->count() == 0){
            $this->createDefaultContexts($userObject);
            $contextList = $this->contextRepository->findAllByUserAccount($userObject);
        }
        return $contextList;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $userObject
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    private function createDefaultContexts(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $userObject)
    {
        $work = new Context();
        $private = new Context();
        $work->setNameDe("Arbeit");
        $work->setNameEn("Work");
        $work->setUserAccount($userObject);
        $private->setNameDe("Privat");
        $private->setNameEn("Private");
        $private->setUserAccount($userObject);
        $this->contextRepository->add($work);
        $this->contextRepository->add($private);
        /** @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager */
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        /** @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager */
        $persistenceManager = $objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
        $persistenceManager->persistAll();
    }

    /**
     * @return \ThomasWoehlke\Gtd\Domain\Model\Context
     */
    public function getCurrentContext()
    {
        $sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_gtd_fesessiondata');
        $contextUid = $sessionData['contextUid'];
        if($contextUid == null){
            $contextList = $this->getContextList();
            /** @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $userObject */
            $userObject = $this->userAccountRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
            $userConfig = $this->userConfigRepository->findByUserAccount($userObject);
            if($userConfig == null){
                $userConfig2 = new UserConfig();
                $userConfig2->setUserAccount($userObject);
                $ctx = $contextList->getFirst();
                $userConfig2->setDefaultContext($ctx);
                $this->userConfigRepository->add($userConfig2);
                /** @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager */
                $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
                $persistenceManager = $objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
                /** @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager */
                $persistenceManager->persistAll();
                $userConfig = $this->userConfigRepository->findByUserAccount($userObject);
            }
            $defaultContext = $userConfig->getDefaultContext();
            $sessionData['contextUid'] = $defaultContext->getUid();
            $GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_gtd_fesessiondata', $sessionData);
            $GLOBALS['TSFE']->fe_user->storeSessionData();
            return $defaultContext;
        } else {
            return $this->contextRepository->findByUid($contextUid);
        }
    }

    /**
     * @param \ThomasWoehlke\Gtd\Domain\Model\Context $context
     * @return void
     */
    public function setCurrentContext(\ThomasWoehlke\Gtd\Domain\Model\Context $context){
        $sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_gtd_fesessiondata');
        $sessionData['contextUid'] = $context->getUid();
        $GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_gtd_fesessiondata', $sessionData);
        $GLOBALS['TSFE']->fe_user->storeSessionData();
    }

}
