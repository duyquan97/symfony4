<?php
namespace App\Service;
use App\Controller\BaseController;
use App\Repository\OrderRepository;
use App\Repository\RoomsRepository;
use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingHelper extends BaseController
{
    private $room;
    private $order;

    public function __construct(RoomsRepository $roomsRepository, OrderRepository $orderRepository)
    {
        $this->room = $roomsRepository;
        $this->order = $orderRepository;
    }

    public function checkOut(int $id, $from_date,  $to_date)
    {

        $holidayList = ['01-01', '02-14', '04-30', '05-01', '09-02', '12-24'];
        $room = $this->room->find($id);
        $fromDate = strtotime($from_date);
        $toDate   = strtotime($to_date);
        $datediff = abs($toDate - $fromDate);
        $days     = floor($datediff / (60 * 60 * 24));
        $weekendCount = 0;
        $holidayCount = 0;
        $listDay = $this->order->checkBooking(date_create($from_date), date_create($to_date),$room);

        if ($days < 1) {
            $message = 'You must book at least 1 night!';
            return $message;
        }
        if ($fromDate > $toDate){
            $message = 'Date is invalid, please select a date again!';
            return $message;
        }
        elseif (!empty($listDay)) {
            $message = "Room was booked on this day, please book another day!";
            return $message;

        } elseif ( $listDay == []) {
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

            $result = [
                'sumPrice' => $total,
                'days'     => $days
            ];
            return $result;
        }
    }
    public function checkUser(){

        return $this->getUser();
    }
}
