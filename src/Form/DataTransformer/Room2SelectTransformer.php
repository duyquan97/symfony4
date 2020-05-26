<?php
namespace App\Form\DataTransformer;
use App\Entity\User;
use App\Repository\RoomsRepository;
use App\Repository\TagRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\TransactionRequiredException;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\HttpFoundation\Session\Session;

class RoomSelectTransformer implements DataTransformerInterface
{
    private $roomsRepository;
    public function __construct(RoomsRepository $roomsRepository)
    {
        $this->roomsRepository = $roomsRepository;
    }
    public function transform($room)
    {
        $session = new Session();
        if (null != $session->get('order')){
            $id = $session->get('order')['room'];
                if (!empty($id)) {
                    return $id;
                }
        }
        if (null === $room) {
            return '';
        }
        return $room->getId();
    }
    public function reverseTransform($roomId)
    {
        if (!$roomId) {
            return;
        }
        $user = $this->roomsRepository->find($roomId);
        if (null === $user) {
            $privateErrorMessage = sprintf('An room with number "%s" does not exist!', $roomId);
            $publicErrorMessage = 'The given "{{ value }}" value is not a valid room number.';

            $failure = new TransformationFailedException($privateErrorMessage);
            $failure->setInvalidMessage($publicErrorMessage, [
                '{{ value }}' => $roomId,
            ]);

            throw $failure;
        }
        return $user;

    }
}