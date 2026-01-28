<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TesterController;
use App\Models\User;

class TesterControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    public function testIndexReturnsCorrectView()
    {
        // Arrange - Mock de ingelogde gebruiker
        $loggedInUserId = 1;
        Auth::shouldReceive('id')->andReturn($loggedInUserId);

        // Arrange - Maak fake data aan die uit database zou komen
        $fakeData = [
            (object)['id' => 1, 'name' => 'Test User', 'email' => 'test@example.com'],
        ];

        // Arrange - Maak een mock instantie van de User model
        $userModelMock = Mockery::mock(User::class);

        // Arrange - Definieer wat de mock moet doen
        $userModelMock->shouldReceive('sp_GetAllUsers')
            ->once()
            ->with($loggedInUserId)
            ->andReturn($fakeData);

        // Act - Maak een instantie van de controller met de gemockte dependency
        $controller = new TesterController($userModelMock);
        $response = $controller->index();

        // Assert - Test of de juiste view wordt geretourneerd
        $this->assertEquals('Tester.index', $response->getName());

        // Assert - Test of de juiste data aan de view wordt doorgegeven
        $data = $response->getData();
        $this->assertEquals('Tester Home', $data['title']);
    }

    public function testShowReturnsCorrectViewWithUserData()
    {
        // Arrange - Maak fake user data aan die uit database zou komen
        $userId = 2;
        $fakeUserData = [
            (object)['id' => $userId, 'name' => 'Jane Doe', 'email' => 'jane@example.com'],
        ];

        // Arrange - Maak een mock instantie van de User model
        $userModelMock = Mockery::mock(User::class);

        // Arrange - Definieer wat de mock moet doen
        $userModelMock->shouldReceive('sp_GetUserById')
            ->once()
            ->with($userId)
            ->andReturn($fakeUserData);

        // Act - Maak een instantie van de controller met de gemockte dependency
        $controller = new TesterController($userModelMock);
        $response = $controller->show($userId);

        // Assert - Test of de juiste view wordt geretourneerd
        $this->assertEquals('Tester.show', $response->getName());

        // Assert - Test of de juiste data aan de view wordt doorgegeven
        $data = $response->getData();
        $this->assertEquals('User Details', $data['title']);
        $this->assertIsObject($data['user']);
        $this->assertEquals($userId, $data['user']->id);
        $this->assertEquals('Jane Doe', $data['user']->name);
        $this->assertEquals('jane@example.com', $data['user']->email);
    }
}