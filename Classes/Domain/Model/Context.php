<?php
namespace ThomasWoehlke\Gtd\Domain\Model;

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

/**
 * Context
 */
class Context extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * nameDe
     *
     * @var string
     */
    protected $nameDe = '';

    /**
     * nameEn
     *
     * @var string
     */
    protected $nameEn = '';

    /**
     * userAccount
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected $userAccount = null;

    /**
     * Returns the nameDe
     *
     * @return string $nameDe
     */
    public function getNameDe()
    {
        return $this->nameDe;
    }

    /**
     * Sets the nameDe
     *
     * @param string $nameDe
     * @return void
     */
    public function setNameDe($nameDe)
    {
        $this->nameDe = $nameDe;
    }

    /**
     * Returns the nameEn
     *
     * @return string $nameEn
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * Sets the nameEn
     *
     * @param string $nameEn
     * @return void
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;
    }

    /**
     * Returns the userAccount
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $userAccount
     */
    public function getUserAccount()
    {
        return $this->userAccount;
    }

    /**
     * Sets the userAccount
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $userAccount
     * @return void
     */
    public function setUserAccount(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $userAccount)
    {
        $this->userAccount = $userAccount;
    }
}
