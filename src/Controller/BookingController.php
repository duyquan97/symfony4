<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Rooms;
use App\Repository\OrderRepository;
use App\Repository\RoomsRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function GuzzleHttp\Psr7\str;

class BookingController extends AbstractController
{
    /**
     * @Route("/search", name="search_room")
     */
    public function search(Request $request, RoomsRepository $roomsRepository,PaginatorInterface $paginator)
    {
        $keyWord  = $request->query->get('key_word');
        $fromDate = $request->query->get('from_date');
        $toDate   = $request->query->get('to_date');
        $type     = $request->query->get('type');

        $rooms = $paginator->paginate($roomsRepository->search($keyWord,$fromDate,$toDate,$type), $request->query->getInt('page', 1), 6);
        return $this->render('booking/index.html.twig', [
            'rooms' => $rooms,
            'keyWord' => $keyWord,
            'type' => $type,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    /**
     * @Route("/room/{id}/{slug}", name="room_detail")
     *
     */
    public function detail(int $id, RoomsRepository $roomsRepository,PaginatorInterface $paginator)
    {
        $room = $roomsRepository->find($id);
        return $this->render('booking/room_detail.html.twig', [
            'room' => $room,

        ]);
    }

    /**
     * @Route("/booking/{id}}", name="booking",methods={"POST"})
     * @IsGranted("BOOKING")
     */
    public function booking(int $id, RoomsRepository $roomsRepository, Request $request , UserRepository $userRepository, OrderRepository $orderRepository)
    {

        $user = $this->getUser();
        $holidayList = ['01-01', '02-14', '04-30', '05-01', '09-02', '12-24'];

        $room = $roomsRepository->find($id);
        $data = $request->request->all();
        $fromDate = strtotime($data['from_date']);
        $toDate = strtotime($data['to_date']);
        $datediff = abs($toDate - $fromDate);
        $days = floor($datediff / (60 * 60 * 24));
        $weekendCount = 0;
        $holidayCount = 0;
        $listDay = $orderRepository->listDay(date_create($data['from_date']), date_create($data['to_date']));
        if (empty($user)) {
            $this->addFlash('success', 'You need to log in to booking!');
        } elseif (!empty($listDay)) {
            $this->addFlash('success', 'Room was booked on this day, please book another day!');

        } elseif ($user && $listDay == []) {
            for ($i = 0; $i <= $days - 1; $i++) {
                $next_date = date("Y-m-d", mktime(0, 0, 0, date("n", $fromDate), date("j", $fromDate) + $i, date("Y", $fromDate)));
                if (in_array(date('m-d', strtotime($next_date)), $holidayList)) {
                    $holidayCount++;
                }
                $dateWeekend = date('w', strtotime($next_date));
                if ($dateWeekend == 5 || $dateWeekend == 6) {
                    $weekendCount += 1;
                }
            }
            !empty($room->getDiscount()) ? $discount = $room->getDiscount() : $discount = 0;
            !empty($room->getWeekend()) ? $weekend = $room->getWeekend() : $weekend = 0;
            !empty($room->getHoliday()) ? $holiday = $room->getHoliday() : $holiday = 0;
            $priceWeekend = ($weekendCount * ($room->getPrice() + ($room->getPrice() * $weekend / 100)));
            $priceHoliday = ($holidayCount * ($room->getPrice() + ($room->getPrice() * $holiday / 100)));
            $price = ($days - $holidayCount - $weekendCount) * $room->getPrice();
            $total = $priceHoliday + $priceWeekend + $price - (($priceHoliday + $priceWeekend + $price) * $discount / 100);

            $order = new Order();
            $order->setCode(strtoupper(uniqid()));
            $order->setName($data['name']);
            $order->setEmail($data['email']);
            $order->setPhone($data['phone']);
            $order->setFromDate(date_create($data['from_date']));
            $order->setToDate(date_create($data['to_date']));
            $order->setPrice($total);
            $order->setCurrency('VND');
            $order->setDays($days);
            $order->setStatus('On');
            $order->setAccept('Off');
            $order->setRoom($room);
            $order->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();

            $this->addFlash('success', 'You have successfully booked a room.');

        }

        return $this->redirectToRoute('room_detail', [
            'slug' => $room->getSlug(),
            'id' => $id,

        ]);
    }

}
