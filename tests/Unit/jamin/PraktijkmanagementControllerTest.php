<?php

namespace Tests\Unit\jamin;

use Tests\TestCase;
use Mockery;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PraktijkmanagementController;
use App\Models\User;

class PraktijkmanagementControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    public function testManageUserrolesReturnsCorrectView()
    {
        // Arrange - Mock de ingelogde gebruiker (Auth::id() = 4)
        $loggedInUserId = 4;
        Auth::shouldReceive('id')->andReturn($loggedInUserId);

        // Arrange - Maak fake data aan die uit database zou komen
        $fakeUsers = [
            (object)['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'rolename' => 'admin'],
            (object)['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'rolename' => 'user'],
        ];

        // Arrange - Maak een mock instantie van de User model
        $userModelMock = Mockery::mock(User::class);

        // Arrange - Definieer wat de mock moet doen
        $userModelMock->shouldReceive('sp_GetAllUsers')
            ->once()
            ->with($loggedInUserId)
            ->andReturn($fakeUsers);

        // Act - Maak een instantie van de controller met de gemockte dependency
        $controller = new PraktijkmanagementController($userModelMock);
        $response = $controller->manageUserroles();

        // Assert - Test of de juiste view wordt geretourneerd
        $this->assertEquals('praktijkmanagement.userroles', $response->getName());

        // Assert - Test of de juiste data aan de view wordt doorgegeven
        $data = $response->getData();
        $this->assertEquals('Gebruikersrollen', $data['title']);
        $this->assertIsArray($data['users']);
        $this->assertCount(2, $data['users']);
    }

    public function testShowReturnsCorrectViewWithUserData()
    {
        // Arrange - Maak fake user data aan die uit database zou komen
        $userId = 5;
        $fakeUserData = [
            (object)['id' => $userId, 'name' => 'Henk Jansen', 'email' => 'henk@example.com', 'rolename' => 'tandarts'],
        ];

        // Arrange - Maak een mock instantie van de User model
        $userModelMock = Mockery::mock(User::class);

        // Arrange - Definieer wat de mock moet doen
        $userModelMock->shouldReceive('sp_GetUserById')
            ->once()
            ->with($userId)
            ->andReturn($fakeUserData);

        // Act - Maak een instantie van de controller met de gemockte dependency
        $controller = new PraktijkmanagementController($userModelMock);
        $response = $controller->show($userId);

        // Assert - Test of de juiste view wordt geretourneerd
        $this->assertEquals('praktijkmanagement.show', $response->getName());

        // Assert - Test of de juiste data aan de view wordt doorgegeven
        $data = $response->getData();
        $this->assertEquals('User Details', $data['title']);
        $this->assertIsObject($data['user']);
        $this->assertEquals($userId, $data['user']->id);
        $this->assertEquals('Henk Jansen', $data['user']->name);
        $this->assertEquals('henk@example.com', $data['user']->email);
        $this->assertEquals('tandarts', $data['user']->rolename);
    }
}

