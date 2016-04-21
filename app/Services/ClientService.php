<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 15/01/2016
 * Time: 23:55
 */

namespace JrMessias\Services;

use JrMessias\Repositories\ClientRepository;
use JrMessias\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService
{
    /**
     * @var ClientRepository
     */
    protected $repository;

    /**
     * @var ClientValidator
     */
    private $validator;

    public function __construct(ClientRepository $clientRepository, ClientValidator $clientValidator)
    {
        $this->repository = $clientRepository;
        $this->validator = $clientValidator;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

        return $this->repository->skipPresenter()->create($data);

    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

        return $this->repository->skipPresenter()->update($data, $id);
    }
}