<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 07:45
 */

namespace Tests;

use App\AuthenticationService;
use App\ProfileInterface;
use App\TokenInterfance;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as m;

class AuthenticationServiceTest extends TestCase
{
    /** @test */
    private $stubProfile;

    private $stubToken;

    private $target;

    protected function setUp()
    {
        $this->stubProfile = m::mock(ProfileInterface::class);
        $this->stubToken = m::mock(TokenInterfance::class);


        $this->target = new AuthenticationService($this->stubProfile, $this->stubToken);

    }

    public function test_is_valid_test()
    {

        $this->givenProfile('joey', '91');

        $this->givenToken('000000');

        $actual = $this->target->isValid('joey', '91000000');
        //always failed
        $this->assertTrue($actual);
    }

    protected function givenProfile($account, $password): void
    {
        $this->stubProfile->shouldReceive('getPassword')
            ->with($account)
            ->andReturn($password);
    }

    protected function givenToken($random): void
    {
        $this->stubToken->shouldReceive('getRandom')
            ->andReturn($random);
    }
}

class StubProfile implements ProfileInterface
{

    public function getPassword($account)
    {
        if ($account == 'joey') {
            return '91';
        }
        return '';
    }
}

class StubToken implements TokenInterfance
{
    public function getRandom($account)
    {

        return '000000';
    }
}