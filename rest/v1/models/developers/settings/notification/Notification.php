<?php
class Notification
{
    public $notification_aid;
    public $notification_is_active;
    public $notification_first_name;
    public $notification_last_name;
    public $notification_email;
    public $notification_purpose;
    public $notification_created;
    public $notification_updated;

    public $connection;
    public $lastInsertedId;
    public $tblSettingsNotification;

    public $start;
    public $total;
    public $search;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblSettingsNotification = "settings_notification";
    }

    public function create()
    {
        try {
            $sql = "insert into {$this->tblSettingsNotification}";
            $sql .= " ( ";
            $sql .= " notification_is_active, ";
            $sql .= " notification_first_name, ";
            $sql .= " notification_last_name, ";
            $sql .= " notification_purpose, ";
            $sql .= " notification_email, ";
            $sql .= " notification_created, ";
            $sql .= " notification_updated ";
            $sql .= ") values (";
            $sql .= " :notification_is_active, ";
            $sql .= " :notification_first_name, ";
            $sql .= " :notification_last_name, ";
            $sql .= " :notification_purpose, ";
            $sql .= " :notification_email, ";
            $sql .= " :notification_created, ";
            $sql .= " :notification_updated ";
            $sql .= " ) ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "notification_is_active" => $this->notification_is_active,
                "notification_first_name" => $this->notification_first_name,
                "notification_last_name" => $this->notification_last_name,
                "notification_purpose" => $this->notification_purpose,
                "notification_email" => $this->notification_email,
                "notification_created" => $this->notification_created,
                "notification_updated" => $this->notification_updated,
            ]);
            $this->lastInsertedId = $this->connection->lastInsertId();
        } catch (PDOException $e) {
            $query = false;
        }
        return $query;
    }

        public function readAll(){
        try{
            $sql = "select ";
            $sql .= " * ";
            $sql .= " from {$this->tblSettingsNotification} ";
            $sql .= " where true ";
            // FILTER
            $sql .= $this->notification_is_active != '' ? " and notification_is_active = :notification_is_active " : " ";
            // SEARCH
            $sql .= $this->search != '' ? " and ( " : " ";
            $sql .= $this->search != '' ? " notification_first_name like :notification_first_name  " : " ";
            $sql .= $this->search != '' ? " or notification_last_name like :notification_last_name  " : " ";
            $sql .= $this->search != '' ? " or notification_purpose like :notification_purpose  " : " ";
            $sql .= $this->search != '' ? " or notification_email like :notification_email  " : " ";
            $sql .= $this->search != '' ? " or CONCAT(notification_last_name,' ',notification_first_name) like :notification_last_fullname " : " ";
            $sql .= $this->search != '' ? " or CONCAT(notification_first_name,' ',notification_last_name) like :notification_first_fullname " : " ";
            $sql .= $this->search != '' ? " ) " : " ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                // FOR FILTER 
                ...$this->notification_is_active != '' ? ["notification_is_active" => $this->notification_is_active] : [],
                // FOR SEARCHING
                ...$this->search != '' ? [
                    "notification_first_name" => "%{$this->search}%",
                    "notification_last_name" => "%{$this->search}%",
                    "notification_purpose" => "%{$this->search}%",
                    "notification_email" => "%{$this->search}%",
                    "notification_last_fullname" => "%{$this->search}%",
                    "notification_first_fullname" => "%{$this->search}%",
                ] : [],
            ]);

        }catch(PDOException $e){
            $query = false;
        }
        return $query;
    }

    public function readLimit(){
        try{
            // JOINING TABLE
            $sql = "select ";
            $sql .= " * ";
            $sql .= " from {$this->tblSettingsNotification} ";
            $sql .= " where true ";
            // FILTER
            $sql .= $this->notification_is_active != '' ? " and notification_is_active = :notification_is_active " : " ";
            // SEARCH
            $sql .= $this->search != '' ? " and ( " : " ";
            $sql .= $this->search != '' ? " notification_first_name like :notification_first_name  " : " ";
            $sql .= $this->search != '' ? " or notification_last_name like :notification_last_name  " : " ";
            $sql .= $this->search != '' ? " or notification_purpose like :notification_purpose  " : " ";
            $sql .= $this->search != '' ? " or notification_email like :notification_email  " : " ";
            $sql .= $this->search != '' ? " or CONCAT(notification_last_name,' ',notification_first_name) like :notification_last_fullname " : " ";
            $sql .= $this->search != '' ? " or CONCAT(notification_first_name,' ',notification_last_name) like :notification_first_fullname " : " ";
            $sql .= $this->search != '' ? " ) " : " ";
            // THIS IS FOR PAGINATION LIKE FACEBOOK SCROLLING
            $sql .= "limit :start, ";
            $sql .= " :total ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                // FOR FILTER 
                ...$this->notification_is_active != '' ? ["notification_is_active" => $this->notification_is_active] : [],
                // FOR SEARCHING
                ...$this->search != '' ? [
                    "notification_first_name" => "%{$this->search}%",
                    "notification_last_name" => "%{$this->search}%",
                    "notification_purpose" => "%{$this->search}%",
                    "notification_email" => "%{$this->search}%",
                    "notification_last_fullname" => "%{$this->search}%",
                    "notification_first_fullname" => "%{$this->search}%",
                ] : [],
                "start" => $this->start - 1,
                "total" => $this->total,
            ]);

        }catch(PDOException $e){
            $query = false;
        }
        return $query;
    }
    public function update(){
        try {
            $sql = " update {$this->tblSettingsNotification} set ";
            $sql .= " notification_first_name = :notification_first_name, ";
            $sql .= " notification_last_name = :notification_last_name, ";
            $sql .= " notification_purpose = :notification_purpose, ";
            $sql .= " notification_email = :notification_email, ";
            $sql .= " notification_updated = :notification_updated ";
            $sql .= " where notification_aid = :notification_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "notification_first_name" => $this->notification_first_name,
                "notification_last_name" => $this->notification_last_name,
                "notification_purpose" => $this->notification_purpose,
                "notification_email" => $this->notification_email,
                "notification_updated" => $this->notification_updated,
                "notification_aid" => $this->notification_aid,
            ]);
        } catch (PDOException $e) {
            $query = false;
        }
        return $query;
    }
    public function active(){
        try{
            $sql =" update {$this->tblSettingsNotification} set ";
            $sql .= " notification_is_active = :notification_is_active, "; 
            $sql .= " notification_updated = :notification_updated ";
            $sql .= " where notification_aid = :notification_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "notification_is_active" => $this->notification_is_active,
                "notification_updated" => $this->notification_updated,
                "notification_aid" => $this->notification_aid,
            ]);
        }catch(PDOException $e){
            // returnError($e); //turn on when debugging
            $query = false;
        } return $query;
    }
    public function delete(){
        try{
            $sql =" delete from {$this->tblSettingsNotification} ";
            $sql .= " where notification_aid = :notification_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "notification_aid" => $this->notification_aid,
            ]);
        }catch(PDOException $e){
            // returnError($e); //turn on when debugging
            $query = false;
        } return $query;
    }
    public function checkName(){
        try{
            $sql = "select ";
            $sql .= " notification_first_name ";
            $sql .= " from {$this->tblSettingsNotification} ";
            $sql .= " where notification_first_name = :notification_first_name ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "notification_first_name" => $this->notification_first_name,
            ]);
        }catch(PROException $e){
            $query = false;
        }
        return $query;
    }
}