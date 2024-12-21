<?php

namespace App\Controller\Platform\Backend;

use App\Controller\Platform\PlatformController;
use App\Entity\Platform\Cart;
use App\Entity\Platform\Service;
use App\Entity\Platform\User;
use App\Repository\Platform\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends PlatformController
{
    #[Route('/{_locale}/admin/v1/cart', name: 'admin_v1_cart')]
    public function index(Request $request): Response
    {
        $cart = $this->doctrine->getRepository(Cart::class)->findOneBy(['user' => $this->getUser()]);

        if (!$cart) {
            $cart = (new Cart())->setUser($this->getUser());
        }

        $items = $cart->getItems();

        $services = [];

        if (!is_null($items)) {
            foreach ($items as $item) {
                $services[] = $this->doctrine->getRepository(Service::class)->find($item);
            }
        }

        return $this->render('platform/backend/v1/list.html.twig', [
            'sidebarMenu' => (new SidebarController($this->requestStack, $this->doctrine, $this->translator))->getSidebarMenu(),
            'title' => 'Kosár',
            'cart' => $cart,

            'tableHead' => [
                'name' => 'Megnevezés',
                'type' => 'Típus',
                'fee' => 'Díj',
            ],
            'tableBody' => $services


        ]);
    }

    #[Route('/{_locale}/admin/v1/cart/add/{id}', name: 'admin_v1_cart_add')]
    public function add(Request $request, int $id): Response
    {
        $cart = $this->doctrine->getRepository(Cart::class)->findOneBy(['user' => $this->getUser()]);

        if (!$cart) {
            $cart = (new Cart())->setUser($this->getUser());
        }

        $items = $cart->getItems();
        $items[] = $id;
        $cart->setItems($items);
        $this->doctrine->getManager()->persist($cart);
        $this->doctrine->getManager()->flush();

        return $this->redirectToRoute('admin_v1_checkout');
    }

    #[Route('/{_locale}/admin/v1/cart/remove/{id}', name: 'admin_v1_cart_remove')]
    public function remove(Request $request, int $id): Response
    {
        $cart = $this->doctrine->getRepository(Cart::class)->findOneBy(['user' => $this->getUser()]);
        $items = $cart->getItems();
        $items = array_diff($items, [$id]);
        $cart->setItems($items);
        $this->doctrine->getManager()->persist($cart);
        $this->doctrine->getManager()->flush();

        return $this->redirectToRoute('admin_v1_checkout');
    }
}
