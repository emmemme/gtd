<?php
namespace ThomasWoehlke\TwSimpleworklist\Domain\Model;

/***
 *
 * This file is part of the "SimpleWorklist" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2016 
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
     * @var \ThomasWoehlke\TwSimpleworklist\Domain\Model\UserAccount
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
     * @return \ThomasWoehlke\TwSimpleworklist\Domain\Model\UserAccount $userAccount
     */
    public function getUserAccount()
    {
        return $this->userAccount;
    }
    
    /**
     * Sets the userAccount
     * 
     * @param \ThomasWoehlke\TwSimpleworklist\Domain\Model\UserAccount $userAccount
     * @return void
     */
    public function setUserAccount(\ThomasWoehlke\TwSimpleworklist\Domain\Model\UserAccount $userAccount)
    {
        $this->userAccount = $userAccount;
    }
}