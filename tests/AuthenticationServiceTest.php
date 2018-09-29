<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 07:45
 */

namespace Tests;

use App\AuthenticationService;
use App\Logger;
use App\LoggerInterface;
use App\ProfileInterface;
use App\TokenInterfance;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as m;

class AuthenticationServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private $stubProfile;

    private $stubToken;

    private $target;

    private $mockLogger;

    protected function setUp()
    {
        $this->stubProfile = m::mock(ProfileInterface::class);
        $this->stubToken = m::mock(TokenInterfance::class);
        $this->mockLogger = m::spy(LoggerInterface::class);


        $this->target = new AuthenticationService(
            $this->stubProfile,
            $this->stubToken,
            $this->mockLogger);

    }

    /**
     * @test
     */
    public function is_valid_test()
    {

        $this->givenProfile('joey', '91');

        $this->givenToken('000000');

        $this->shouldBeValid('joey', '91000000');
    }

    public function test_log_then_account_is_invalid()
    {
        $this->givenProfile('joey', '91');

        $this->givenToken('000000');




        $this->target->isValid('joey', 'wrong password');

        $this->ShouldLog('user');
    }

    protected function givenProfile($account, $password): void
    {
        $this->stubProfile
            ->shouldReceive('getPassword')
            ->with($account)
            ->andReturn($password);
    }

    protected function givenToken($random): void
    {
        $this->stubToken
            ->shouldReceive('getRandom')
            ->andReturn($random);
    }

    protected function shouldBeValid($account, $password): void
    {
        $actual = $this->target->isValid($account, $password);
        //always failed
        $this->assertTrue($actual);
    }

    protected function ShouldLog($check = ''): void
    {
        $this->mockLogger->shouldHaveReceived('save')
            ->withArgs(function ($string,$data) use($check) {
                return strpos($string, $check) !== false;
            })
            ->once();
    }
}

