<?php


namespace App\Project\Http\Controller;

use App\Project\App\Support\FractalService;
use App\Project\Domain\Order\OrderService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Swagger\Annotations as SWG;

class OrderController
{
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * @var FractalService
     */
    private $fractalService;
    /**
     * @var RouterInterface
     */
    private $router;

    /** 
     * @var Request
     */
    private $request;

    public function __construct(
        OrderService $orderService,
        FractalService $fractalService,
        RouterInterface $router
    )
    {
        $this->orderService = $orderService;
        $this->fractalService = $fractalService;
        $this->router = $router;
    }


    /**
     * Get Orders
     * 
     * @param Request $request 
     * 
     * @return JsonResponse
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns the Order collection"
     * )
     * @SWG\Parameter(
     *     name="page",
     *     in="query",
     *     type="integer",
     *     description="current page",
     *     default="1"
     * )
     * @SWG\Parameter(
     *     name="per_page",
     *     in="query",
     *     type="integer",
     *     description="limit per page",
     *     default="10"
     * )
     * @SWG\Tag(name="Orders")
     */
    public function index(Request $request)
    {
        $orders = $this->orderService->getOrders($request, $this->router);

        return new JsonResponse($this->fractalService->transform($orders));
    }

    /**
     * Get Order
     * 
     * @param int $id 
     * 
     * @return JsonResponse
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns single Order Item"
     * )
     * @SWG\Response(
     *     response=500,
     *     description="Returns error"
     * )
     * @SWG\Tag(name="Orders")
     */
    public function get($id)
    {
        try {
            $order = $this->orderService->getOrderById($id);
            return new JsonResponse($this->fractalService->transform($order));
        }catch (\Exception $e) {
            return new JsonResponse($this->fractalService->transform($e->getMessage(), false), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create Order
     * 
     * @param Request $request 
     * 
     * @return JsonResponse
     * 
     * @SWG\Response(
     *     response=200,
     *     description="returns success message"
     * )
     * @SWG\Response(
     *     response=500,
     *     description="Returns error"
     * )
     *
     * @SWG\Tag(name="Orders")
     */
    public function create(Request $request)
    {
        try {
            $this->orderService->addOrder($request);
            return new JsonResponse($this->fractalService->transform('Order has been added'), Response::HTTP_OK);
        }catch (\Exception $exception) {
            return new JsonResponse($this->fractalService->transform($exception->getMessage(), false), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Updates Order
     * 
     * @param Request $request 
     * @param int $id 
     * 
     * @return JsonResponse
     * 
     * @SWG\Response(
     *     response=200,
     *     description="returns success message"
     * )
     * @SWG\Response(
     *     response=500,
     *     description="Returns error"
     * )
     *
     * @SWG\Parameter(
     *     name="status",
     *     type="string",
     *     in="formData",
     *     required=false,
     *     description="Order Status"
     * )
     * @SWG\Tag(name="Orders")
     */
    public function update(Request $request, $id) 
    {
        try {
            $this->orderService->updateOrderById($id, $request);
            return new JsonResponse($this->fractalService->transform('Order has been updated'), Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse($this->fractalService->transform($exception->getMessage(), false), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}