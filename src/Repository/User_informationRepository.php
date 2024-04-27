<?php

declare(strict_types=1);

namespace App\Repository;

use Exception;

final class User_informationRepository
{
    private \PDO $database;

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function getDb(): \PDO
    {
        return $this->database;
    }

    public function checkAndGet(int $user_informationId): object
    {
        $query = 'SELECT * FROM `user_information` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user_informationId);
        $statement->execute();
        $user_information = $statement->fetchObject();
        if (!$user_information) {
            throw new \Exception('Users not found.', 404);
        }

        return $user_information;
    }

    public function existMembershipNumber(string $member_number) : bool {
        $query = 'SELECT id FROM `user_information` WHERE `membership_number` = :member_number';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('member_number', $member_number);
        $statement->execute();
        $member_id = $statement->fetchObject();
        if (!$member_id) {
            return false;
        }
        return true;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `user_information` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function getAllMember(): array
    {
        $query = 'SELECT * FROM `user_information` WHERE `user_type` = "member" ORDER BY `first_name`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $user_information): object
    {
        $query = 'INSERT INTO `user_information` (`id`, `user_id`, `church_id`, `user_type`, `first_name`, `last_name`, `passport`, `telephone`, `street`, `apartment`, `suburb`, `city`, `province`, `area_code`, `race`, `marital_status`, `vital_status`, `membership_number`, `password`, `dateofbirth`, `created_at`, `updated_at`, `deleted_at`) VALUES (:id, :user_id, :church_id, :user_type, :first_name, :last_name, :passport, :telephone, :street, :apartment, :suburb, :city, :province, :area_code, :race, :marital_status, :vital_status, :membership_number, :password, :dateofbirth, :created_at, :updated_at, :deleted_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user_information->id);
        $statement->bindParam('user_id', $user_information->user_id);
        $statement->bindParam('church_id', $user_information->church_id);
        $statement->bindParam('user_type', $user_information->user_type);
        $statement->bindParam('first_name', $user_information->first_name);
        $statement->bindParam('last_name', $user_information->last_name);
        $statement->bindParam('passport', $user_information->passport);
        $statement->bindParam('telephone', $user_information->telephone);
        $statement->bindParam('street', $user_information->street);
        $statement->bindParam('apartment', $user_information->apartment);
        $statement->bindParam('suburb', $user_information->suburb);
        $statement->bindParam('city', $user_information->city);
        $statement->bindParam('province', $user_information->province);
        $statement->bindParam('area_code', $user_information->area_code);
        $statement->bindParam('race', $user_information->race);
        $statement->bindParam('marital_status', $user_information->marital_status);
        $statement->bindParam('vital_status', $user_information->vital_status);
        $statement->bindParam('membership_number', $user_information->membership_number);
        $statement->bindParam('password', $user_information->password);
        $statement->bindParam('dateofbirth', $user_information->dateofbirth);
        $statement->bindParam('created_at', $user_information->created_at);
        $statement->bindParam('updated_at', $user_information->updated_at);
        $statement->bindParam('deleted_at', $user_information->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function addGuest(object $user_information): object
    {
        $query = 'INSERT INTO `user_information` (`id`, `user_id`, `church_id`, `user_type`, `first_name`, `last_name`, `passport`, `telephone`, `street`, `apartment`, `suburb`, `city`, `province`, `area_code`, `race`, `marital_status`, `vital_status`, `membership_number`, `password`, `dateofbirth`, `created_at`, `updated_at`, `deleted_at`) VALUES (:id, :user_id, :church_id, :user_type, :first_name, :last_name, :passport, :telephone, :street, :apartment, :suburb, :city, :province, :area_code, :race, :marital_status, :vital_status, :membership_number, :password, :dateofbirth, :age, :email, :phone,  :created_at, :updated_at, :deleted_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user_information->id);
        $statement->bindParam('user_id', $user_information->user_id);
        $statement->bindParam('church_id', $user_information->church_id);
        $statement->bindParam('user_type', $user_information->user_type);
        $statement->bindParam('first_name', $user_information->first_name);
        $statement->bindParam('last_name', $user_information->last_name);
        $statement->bindParam('passport', $user_information->passport);
        $statement->bindParam('telephone', $user_information->telephone);
        $statement->bindParam('street', $user_information->street);
        $statement->bindParam('apartment', $user_information->apartment);
        $statement->bindParam('suburb', $user_information->suburb);
        $statement->bindParam('city', $user_information->city);
        $statement->bindParam('province', $user_information->province);
        $statement->bindParam('area_code', $user_information->area_code);
        $statement->bindParam('race', $user_information->race);
        $statement->bindParam('marital_status', $user_information->marital_status);
        $statement->bindParam('vital_status', $user_information->vital_status);
        $statement->bindParam('membership_number', $user_information->membership_number);
        $statement->bindParam('password', $user_information->password);
        $statement->bindParam('dateofbirth', $user_information->dateofbirth);
        $statement->bindParam('age', $user_information->age);
        $statement->bindParam('phone', $user_information->phone);
        $statement->bindParam('email', $user_information->email);
        $statement->bindParam('created_at', $user_information->created_at);
        $statement->bindParam('updated_at', $user_information->updated_at);
        $statement->bindParam('deleted_at', $user_information->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $user_information, object $data): object
    {
        if (isset($data->user_id)) {
            $user_information->user_id = $data->user_id;
        }
        if (isset($data->church_id)) {
            $user_information->church_id = $data->church_id;
        }
        if (isset($data->user_type)) {
            $user_information->user_type = $data->user_type;
        }
        if (isset($data->first_name)) {
            $user_information->first_name = $data->first_name;
        }
        if (isset($data->last_name)) {
            $user_information->last_name = $data->last_name;
        }
        if (isset($data->passport)) {
            $user_information->passport = $data->passport;
        }
        if (isset($data->telephone)) {
            $user_information->telephone = $data->telephone;
        }
        if (isset($data->street)) {
            $user_information->street = $data->street;
        }
        if (isset($data->apartment)) {
            $user_information->apartment = $data->apartment;
        }
        if (isset($data->suburb)) {
            $user_information->suburb = $data->suburb;
        }
        if (isset($data->city)) {
            $user_information->city = $data->city;
        }
        if (isset($data->province)) {
            $user_information->province = $data->province;
        }
        if (isset($data->area_code)) {
            $user_information->area_code = $data->area_code;
        }
        if (isset($data->race)) {
            $user_information->race = $data->race;
        }
        if (isset($data->marital_status)) {
            $user_information->marital_status = $data->marital_status;
        }
        if (isset($data->vital_status)) {
            $user_information->vital_status = $data->vital_status;
        }
        if (isset($data->membership_number)) {
            $user_information->membership_number = $data->membership_number;
        }
        if (isset($data->password)) {
            $user_information->password = $data->password;
        }
        if (isset($data->dateofbirth)) {
            $user_information->dateofbirth = $data->dateofbirth;
        }
        if (isset($data->age)) {
            $user_information->age = $data->age;
        }
        if (isset($data->created_at)) {
            $user_information->created_at = $data->created_at;
        }
        if (isset($data->updated_at)) {
            $user_information->updated_at = $data->updated_at;
        }
        if (isset($data->deleted_at)) {
            $user_information->deleted_at = $data->deleted_at;
        }

        $query = 'UPDATE `user_information` SET `user_id` = :user_id, `church_id` = :church_id, `user_type` = :user_type, `first_name` = :first_name, `last_name` = :last_name, `passport` = :passport, `telephone` = :telephone, `street` = :street, `apartment` = :apartment, `suburb` = :suburb, `city` = :city, `province` = :province, `area_code` = :area_code, `race` = :race, `marital_status` = :marital_status, `vital_status` = :vital_status, `membership_number` = :membership_number, `password` = :password, `dateofbirth` = :dateofbirth, `age` = :age, `created_at` = :created_at, `updated_at` = :updated_at, `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user_information->id);
        $statement->bindParam('user_id', $user_information->user_id);
        $statement->bindParam('church_id', $user_information->church_id);
        $statement->bindParam('user_type', $user_information->user_type);
        $statement->bindParam('first_name', $user_information->first_name);
        $statement->bindParam('last_name', $user_information->last_name);
        $statement->bindParam('passport', $user_information->passport);
        $statement->bindParam('telephone', $user_information->telephone);
        $statement->bindParam('street', $user_information->street);
        $statement->bindParam('apartment', $user_information->apartment);
        $statement->bindParam('suburb', $user_information->suburb);
        $statement->bindParam('city', $user_information->city);
        $statement->bindParam('province', $user_information->province);
        $statement->bindParam('area_code', $user_information->area_code);
        $statement->bindParam('race', $user_information->race);
        $statement->bindParam('marital_status', $user_information->marital_status);
        $statement->bindParam('vital_status', $user_information->vital_status);
        $statement->bindParam('membership_number', $user_information->membership_number);
        $statement->bindParam('password', $user_information->password);
        $statement->bindParam('dateofbirth', $user_information->dateofbirth);
        $statement->bindParam('age', $user_information->age);
        $statement->bindParam('created_at', $user_information->created_at);
        $statement->bindParam('updated_at', $user_information->updated_at);
        $statement->bindParam('deleted_at', $user_information->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $user_information->id);
    }

    public function delete(int $user_informationId): void
    {
        $deleted_at = date('Y-m-d h:i:s');
        $query = 'UPDATE `user_information` SET `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('deleted_at', $deleted_at);
        $statement->bindParam('id', $user_informationId);
        $statement->execute();
    }

    public function getMemberByUserId(int $user_id) : object {
        $query = 'SELECT * FROM `user_information` WHERE `user_id` = :user_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('user_id', $user_id);
        $statement->execute();
        $user_information = $statement->fetchObject();
        if (!$user_information) {
            throw new \Exception('Member information not found.', 404);
        }

        return $user_information;
    }

    public function getMemberByUserPassword(object $user_info): bool|object {
        $query = 'SELECT * FROM `user_information` WHERE `user_id` = :user_id AND `password` = :password AND `user_type` = "member"' ;
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('user_id', $user_info->user_id);
        $statement->bindParam('password', $user_info->password);
        $statement->execute();
        $user_information = $statement->fetchObject();

        return $user_information;
    }

    public function getMemnerByPasswordMembership(object $user_info) : bool|object {
        $query = 'SELECT * FROM `user_information` WHERE `password` = :password AND `membership_number`:membership_number';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('password', $user_info->password);
        $statement->bindParam('password', $user_info->membership_number);
        $statement->execute();
        $user_information = $statement->fetchObject();
        return $user_information;
    }

    public function getSuburb(): array {
        $query = 'SELECT distinct(suburb) as name FROM `user_information`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();
        $user_information = $statement->fetchAll(\PDO::FETCH_COLUMN, 0);
        return $user_information;
    }

    public function searchMember(object $search_input) : bool|array {
        $query = 'SELECT * FROM `user_information` WHERE `user_type` = "member" AND ( `first_name` LIKE :first_name OR `last_name` LIKE :last_name OR `passport` LIKE :passport OR `telephone` LIKE :telephone OR `membership_number` LIKE :membership_number OR `dateofbirth` LIKE :dateofbirth)';
        //print_r($search_input);die();
        //"AND ( `first_name` LIKE :frist_name OR `last_name` LIKE :last_name OR `passport` LIKE :passport OR `telephone` LIKE :telephone OR `membership_number` LIKE :membership OR `dateofbirth` LIKE :dateofbirth)"
        $data = "%" . $search_input->search . "%";
        //echo $data; die();
        try {
            $statement = $this->getDb()->prepare($query);     
            $statement->bindParam('first_name', $data);
            $statement->bindParam('last_name', $data);
            $statement->bindParam('passport', $data);
            $statement->bindParam('telephone', $data);
            $statement->bindParam('membership_number', $data);
            $statement->bindParam('dateofbirth', $data);
            //echo $statement->queryString;die();
            $statement->execute();

            return (array) $statement->fetchAll();
        }
        catch(Exception $e) {
            print_r($e);
        }
        
    }

    public function searchMemberWithCriteria(object $search_criteria) : bool|array
    {
        $query = 'SELECT * FROM `user_information` WHERE `user_type` = "member"';
        //print_r($search_input);die();
        //"AND ( `first_name` LIKE :frist_name OR `last_name` LIKE :last_name OR `passport` LIKE :passport OR `telephone` LIKE :telephone OR `membership_number` LIKE :membership OR `dateofbirth` LIKE :dateofbirth)"
        $flag_first = 0;
        if($search_criteria->province) {
            if($flag_first == 0) {
                $query .= ' AND( `province` LIKE :province';
                $flag_first = 1;
            }
            else {
                $query .= ' OR `province` LIKE :province';
            }
            $province = "%" . $search_criteria->province . "%";
        }
        if($search_criteria->city) {
            if($flag_first == 0) {
                $query .= ' AND( `city` LIKE :city';
                $flag_first = 1;
            }
            else {
                $query .= ' OR `city` LIKE :city';
            }
            $city = "%" . $search_criteria->city . "%";
        }
        if($search_criteria->suburb) {
            if($flag_first == 0) {
                $query .= ' AND( `suburb` LIKE :suburb';
                $flag_first = 1;
            }
            else {
                $query .= ' OR `suburb` LIKE :suburb';
            }
            $suburb = "%" . $search_criteria->suburb . "%";
        }
        if($search_criteria->merital_status) {
            if($flag_first == 0) {
                $query .= ' AND( `merital_status` LIKE :merital_status';
                $flag_first = 1;
            }
            else {
                $query .= ' OR `merital_status` LIKE :merital_status';
            }
            $merital_status = "%" . $search_criteria->merital_status . "%";
        }
        if($search_criteria->vital_status) {
            if($flag_first == 0) {
                $query .= ' AND( `vital_status` LIKE :vital_status';
                $flag_first = 1;
            }
            else {
                $query .= ' OR `vital_status` LIKE :vital_status';
            }
            $vital_status = "%" . $search_criteria->vital_status . "%";
        }
        if($search_criteria->age_range) {
            $range = explode('-', $search_criteria->age_range);
            if($flag_first == 0) {
                $query .= ' AND( ( `age` > :range1 AND `age` < :range2)';
                $flag_first = 1;
            }
            else {
                $query .= ' OR ( `age` > :range1 AND `age` < :range2)';
            }
            $range1 = $range[0];
            $range2 = $range[1];
        }
        if($flag_first == 1) {
            $query .= ' )';
        }
        //echo $data; die();
        try {
            $statement = $this->getDb()->prepare($query); 
            if($search_criteria->province) :
                $statement->bindParam('province', $province);
            endif;  
            if($search_criteria->city) :
                $statement->bindParam('city', $city);
            endif;
            if($search_criteria->suburb) :
                $statement->bindParam('suburb', $suburb);
            endif;
            if($search_criteria->matiral_status) :
                $statement->bindParam('matiral_status', $matiral_status);
            endif;
            if($search_criteria->vital_status) :
                $statement->bindParam('vital_status', $vital_status);
            endif;
            if($search_criteria->age_range) :
                $statement->bindParam('range1', $range1);
                $statement->bindParam('range2', $range2);
            endif;  
            //echo $statement->queryString;die();
            $statement->execute();

            return (array) $statement->fetchAll();
        }
        catch(Exception $e) {
            print_r($e);
        }
    }
}
