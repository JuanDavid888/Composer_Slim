<?php

namespace App\Controllers;

use App\Domain\Repositories\UserRepositoryInterface;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\DTOs\UserDTO;

class UserController {
    public function __construct(private UserRepositoryInterface $repo) {}

    public function createUser(Request $request, Response $response): Response {

        $data = $request->getParsedBody();

        // TODO: Se debe implementar con caso de USOOOOO!
        $dto = new UserDTO(
            nombre: $data['nombre'] ?? '',
            email: $data['correo'] ?? '',
            password: $data['contrasena'] ?? '',
            rol: 'user'
        );

        $user = $this->repo->create($dto);

        $response->getBody()->write(json_encode($user));
        return $response->withStatus(201);
    }

    public function createAdmin(Request $request, Response $response): Response {

        // TODO: Se debe implementar con caso de USOOOOO!
        $data = $request->getParsedBody();
        $data['rol'] = 'admin';

        // DTO
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); // Algoritmo que hace el hash

        $user = $this->repo->create($data);

        $response->getBody()->write(json_encode($user));
        return $response->withStatus(201);
    }
}