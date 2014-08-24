<?php namespace Cribbb\Infrastructure\Services;

use Illuminate\Hashing\BcryptHasher;
use Cribbb\Domain\Model\Users\Password;

class PasswordHashingServiceTest extends \PHPUnit_Framework_TestCase {

  /** @var PasswordHashingService */
  private $service;

  /** @var Password */
  private $password;

  public function setUp()
  {
    $this->service = new PasswordHashingService(new BcryptHasher);
    $this->password = new Password('my_super_secret_password');
  }

  /** @test */
  public function should_make_new_hashed_password_instance()
  {
    $hashed = $this->service->make($this->password);

    $this->assertInstanceof('Cribbb\Domain\Model\Users\HashedPassword', $hashed);
  }

  /** @test */
  public function should_check_password_is_correct()
  {
    $hashed = $this->service->make($this->password);

    $this->assertTrue($this->service->check($this->password, $hashed));
  }

}






