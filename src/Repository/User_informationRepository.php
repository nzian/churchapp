<?php

declare(strict_types=1);

namespace App\Repository;

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
        if (isset($data->created_at)) {
            $user_information->created_at = $data->created_at;
        }
        if (isset($data->updated_at)) {
            $user_information->updated_at = $data->updated_at;
        }
        if (isset($data->deleted_at)) {
            $user_information->deleted_at = $data->deleted_at;
        }

        $query = 'UPDATE `user_information` SET `user_id` = :user_id, `church_id` = :church_id, `user_type` = :user_type, `first_name` = :first_name, `last_name` = :last_name, `passport` = :passport, `telephone` = :telephone, `street` = :street, `apartment` = :apartment, `suburb` = :suburb, `city` = :city, `province` = :province, `area_code` = :area_code, `race` = :race, `marital_status` = :marital_status, `vital_status` = :vital_status, `membership_number` = :membership_number, `password` = :password, `dateofbirth` = :dateofbirth, `created_at` = :created_at, `updated_at` = :updated_at, `deleted_at` = :deleted_at WHERE `id` = :id';
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
        $query = 'SELECT * FROM `user_information` WHERE `user_id` = :user_id AND `password` = :password AND `user_type` = :user_type' ;
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('user_id', $user_info->user_id);
        $statement->bindParam('password', $user_info->password);
        $statement->bindParam('user_type', 'member');
        $statement->execute();
        $user_information = $statement->fetchObject();

        return $user_information;
    }

    public function getMemnerByOnlyPassword(object $user_info) : bool|object {
        $query = 'SELECT * FROM `user_information` WHERE `password` = :password';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('password', $user_info->password);
        $statement->execute();
        $user_information = $statement->fetchObject();
        return $user_information;
    }

    public function searchMember(object $search_input) : bool|array {
        $query = 'SELECT * FROM `user_information` WHERE `user_type` = :user_type' ;
        if($search_input->first_name) :
            $query .= ' OR WHERE `first_name` like "% :first_name %"';
        endif;
        if($search_input->last_name) :
                $query .= ' OR WHERE `last_name` like "% :last_name %"';
        endif;
        if($search_input->passport) :
            $query .= ' OR WHERE `passport` like "% :passport %"';
        endif;
        if($search_input->telephone) :
           
            $query .= ' OR WHERE `telephone` like "% :telephone %"';
        endif;

        if($search_input->city) :
           
             $query .= ' OR WHERE `city` like "% :city %"';
        
        endif;

        if($search_input->province) :
            
            $query .= ' OR WHERE `province` like "% :province %"';
          
        endif;

        if($search_input->suburb) :
           
            $query .= ' OR WHERE `suburb` like "% :suburb %"';

        endif;
        if($search_input->area_code) :
           
            $query .= ' OR WHERE `area_code` like "% :area_code %"';

        endif;

        if($search_input->race) :
            
            $query .= ' OR WHERE `race` like "% :race %"';

        endif;
        if($search_input->merital_status) :
           
            $query .= ' OR WHERE `merital_status` like "% :merital_status %"';
            
        endif;
        if($search_input->vital_status) :
           
            $query .= ' OR WHERE `vital_status` like "% :vital_status %"';
         
        endif;
        if($search_input->membership_number) :
           
            $query .= ' OR WHERE `membership_number` like "% :membership_number %"';
        
        endif;
        if($search_input->dateofbirth) :
            
            $query .= ' OR WHERE `dateofbirth` like "% :dateofbirth %"';
          
        endif;

        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('user_type', 'member');
        if($search_input->first_name):
            $statement->bindParam('first_name', $search_input->first_name);
        endif;
        if($search_input->last_name):
            $statement->bindParam('last_name', $search_input->last_name);
        endif;
        if($search_input->passport):
            $statement->bindParam('passport', $search_input->passport);
        endif;
        if($search_input->telephone):
            $statement->bindParam('telephone', $search_input->telephone);
        endif;
        if($search_input->street):
            $statement->bindParam('street', $search_input->street);
        endif;
        if($search_input->suburb):
            $statement->bindParam('suburb', $search_input->suburb);
        endif;
        if($search_input->city):
            $statement->bindParam('city', $search_input->city);
        endif;
        if($search_input->province):
            $statement->bindParam('province', $search_input->province);
        endif;
        if($search_input->area_code):
            $statement->bindParam('area_code', $search_input->area_code);
        endif;
        if($search_input->race):
            $statement->bindParam('race', $search_input->race);
        endif;
        if($search_input->marital_status):
            $statement->bindParam('marital_status', $search_input->marital_status);
        endif;
        if($search_input->vital_status):
            $statement->bindParam('vital_status', $search_input->vital_status);
        endif;
        if($search_input->membership_number):
            $statement->bindParam('membership_number', $search_input->membership_number);
        endif;
        if($search_input->dateofbirth):
            $statement->bindParam('dateofbirth', $search_input->dateofbirth);
        endif;
        $statement->execute();

        return (array) $statement->fetchAll();
    }
}
