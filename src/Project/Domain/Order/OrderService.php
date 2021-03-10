<?php

namespace App\Project\Domain\Order;

use App\Project\App\Support\FractalService;
use App\Project\Domain\Order\Entity\Order;
use App\Project\Domain\User\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use League\Fractal\Pagination\PagerfantaPaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

class OrderService
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var OrderTransformer
     */
    private $orderTransformer;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var FractalService
     */
    private $fractalService;

    public function __construct(
        EntityManagerInterface $entityManager,
        OrderTransformer $orderTransformer,
        FractalService $fractalService
    )
    {

        $this->entityManager = $entityManager;
        $this->orderTransformer = $orderTransformer;
        $this->fractalService = $fractalService;
    }

    /**
     * @param Request $request
     * @param RouterInterface $router
     * @return Collection|Item
     */
    public function getOrders(Request $request, RouterInterface $router)
    {
        $page = NULL !== $request->get('page') ? (int) $request->get('page') : 1;
        $perPage = NULL !== $request->get('per_page') ? (int) $request->get('per_page') : 10;

        $orders = $this->entityManager->getRepository(Order::class);

        $doctrineAdapter = new DoctrineORMAdapter($orders->getOrders());
        $paginator = new Pagerfanta($doctrineAdapter);
        $paginator->setCurrentPage($page);
        $paginator->setMaxPerPage($perPage);

        $filteredResults = $paginator->getCurrentPageResults();

        $paginatorAdapter = new PagerfantaPaginatorAdapter($paginator, function(int $page) use ($request, $router) {
            $route = $request->attributes->get('_route');
            $inputParams = $request->attributes->get('_route_params');
            $newParams = array_merge($inputParams, $request->query->all());
            $newParams['page'] = $page;
            return $router->generate($route, $newParams, 0);
        });

        $resource = new Collection($filteredResults, $this->orderTransformer, 'Order');
        $resource->setPaginator($paginatorAdapter);
        return $resource;
    }

    /**
     * @param $id
     * @return Item
     * @throws EntityNotFoundException
     */
    public function getOrderById($id)
    {
        $order = $this->entityManager->getRepository(Order::class)->find($id);

        if ($order) {
            return new Item($order, $this->orderTransformer, 'Order');
        }

        throw new EntityNotFoundException("Order not found");
    }

    /**
     * @param Request $request
     */
    public function addOrder(Request $request)
    {
        $order = new Order();

        $this->entityManager->getRepository(Order::class)->save($order);
    }

    /**
     * Update Order function
     *
     * @param int $id 
     * 
     * @return void
     */
    public function updateOrderById($id, Request $request) {
        $order = $this->entityManager->getRepository(Order::class)->find($id);

        if ($order) {
            $order->setStatus($request->get('status'));
            $this->entityManager->getRepository(Order::class)->save($order);
            return new Item($order, $this->orderTransformer, 'Order');
        }

        throw new EntityNotFoundException("Order not found");
    }
}