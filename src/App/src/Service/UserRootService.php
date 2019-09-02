<?php


namespace App\Service;


use App\Dao\UserRootDao;

/**
 * Class UserRootService
 * @package App\Service
 */
class UserRootService
{
    /**
     * @var UserRootDao
     */
    private $userRootDao;

    public function __construct(UserRootDao $userRootDao)
    {
        $this->userRootDao = $userRootDao;
    }
}