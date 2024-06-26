<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\User_informationRepository;
use App\Repository\UsersRepository;
use App\Traits\Membership;
use App\Traits\CheckDeletedEntry;
use stdClass;

final class User_informationService
{
    use Membership, CheckDeletedEntry;

    private User_informationRepository $user_informationRepository;
    private UsersRepository $user_repository;

    public function __construct(User_informationRepository $user_informationRepository, UsersRepository $usersRepository)
    {
        $this->user_informationRepository = $user_informationRepository;
        $this->user_repository = $usersRepository;
    }

    public function checkAndGet(int $user_informationId): object
    {
        return $this->user_informationRepository->checkAndGet($user_informationId);
    }

    public function getAll(): array
    {
        return $this->removeDeletedEntries($this->user_informationRepository->getAll());
    }

    public function getAllMember(): array {
        return $this->removeDeletedEntries($this->user_informationRepository->getAllMember());
    }

    public function getOne(int $user_informationId): object
    {
        return $this->checkAndGet($user_informationId);
    }

    public function create(array $input): object
    {
        $user_information = json_decode((string) json_encode($input), false);
        // before store in database add membership and created_at and updated_at
        $member_number = $this->generateMembershipNumber();
        $age = 0;
        if($user_information->dateofbirth):
            $age = $this->calculateAge((string)$user_information->dateofbirth);
        endif;
        while($this->user_informationRepository->existMembershipNumber($member_number)) {
            $member_number = $this->generateMembershipNumber();
        }
        $user_information->membership_number = $member_number;
        $user_information->age = $age;
        $user_information->created_at = date('Y-m-d h:i:s');
        $user_information->updated_at = date('Y-m-d h:i:s');
        return $this->user_informationRepository->create($user_information);
    }

    public function submitGuest(array $input): object {
        $guest_information = json_decode((string) json_encode($input), false);
        $guest_information->created_at = date('Y-m-d h:i:s');
        $guest_information->updated_at = date('Y-m-d h:i:s');
        return $this->user_informationRepository->addGuest($guest_information);
    }

    public function update(array $input, int $user_informationId): object
    {
        $user_information = $this->checkAndGet($user_informationId);
        $data = json_decode((string) json_encode($input), false);
        $age = 0;
        if($user_information->dateofbirth):
            $age = $this->calculateAge((string)$user_information->dateofbirth);
        endif;
        $data->updated_at = date('Y-m-d h:i:s');
        $data->age = $age;
        return $this->user_informationRepository->update($user_information, $data);
    }

    public function delete(int $user_informationId): void
    {
        $this->checkAndGet($user_informationId);
        $this->user_informationRepository->delete($user_informationId);
    }

    public function existMembershipNumber($membership_number) : bool {
        return $this->user_informationRepository->existMembershipNumber($membership_number);
    }

    public function getMemberByUserId(int $user_id) : object {
        if($this->user_repository->getUserByid($user_id)) :
            return $this->user_informationRepository->getMemberByUserId($user_id);
        endif;
        return (object)[];
    }

    public function checkMemberLogin(array $input) : bool|object {
        $user_information = json_decode((string) json_encode($input), false);
        if($this->user_repository->getUserByid((int)$user_information->user_id)) :
            return $this->user_informationRepository->getMemberByUserPassword($user_information);
        elseif($user_info = $this->user_informationRepository->getMemnerByPasswordMembership($user_information)):
            $data = new stdClass;
            $data->user_id = $user_information->user_id;
            $this->user_informationRepository->update($user_info, $data);
            $user_info->user_id = $user_information->user_id;
            return $user_info;
        endif;
        return (object)[];
    }

    public function searchMember(array $input) : bool|array {
        $search_data = json_decode((string) json_encode($input), false);
        if(!empty($search_data->search)) {
            return $this->removeDeletedEntries($this->user_informationRepository->searchMember($search_data));
        }
        return [];
    }

    public function searchMemberWithCriteria(array $input) : bool|array
    {
        $search_criteria = json_decode((string) json_encode($input), false);
        if(!empty($search_criteria)) {
            return $this->removeDeletedEntries($this->user_informationRepository->searchMemberWithCriteria($search_criteria));
        }  
        return [];
    }

    public function getSuburb() : array {
        return $this->user_informationRepository->getSuburb() ?? [];
    }

    private function calculateAge(string $dateofbirth): int {
        $result = 0;
        if($dateofbirth != '') {
            $result = (date('Y') - date('Y',strtotime($dateofbirth)));
        }
        return $result;
    }

}
