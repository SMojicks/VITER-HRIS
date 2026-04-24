<?php

class Employees
{
    public $employee_aid;
    public $employee_is_active;
    public $employee_first_name;
    public $employee_middle_name;
    public $employee_last_name;
    public $employee_email;
    public $employee_created;
    public $employee_updated;
    public $employee_department_id;

    public $start;
    public $total;
    public $search;

    public $connection;
    public $lastInsertedId;

    public $tblEmployees;
    public $tblSettingsDepartment;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblEmployees = "employees";
        $this->tblSettingsDepartment = "settings_department";
    }

    public function create()
    {
        try {
            $sql = "insert into {$this->tblEmployees}";
            $sql .= " ( ";
            $sql .= " employee_is_active, ";
            $sql .= " employee_first_name, ";
            $sql .= " employee_middle_name, ";
            $sql .= " employee_last_name, ";
            $sql .= " employee_department_id, "; 
            $sql .= " employee_email, ";
            $sql .= " employee_created, ";
            $sql .= " employee_updated ";
            $sql .= ") values (";
            $sql .= " :employee_is_active, ";
            $sql .= " :employee_first_name, ";
            $sql .= " :employee_middle_name, ";
            $sql .= " :employee_last_name, ";
            $sql .= " :employee_department_id, "; 
            $sql .= " :employee_email, ";
            $sql .= " :employee_created, ";
            $sql .= " :employee_updated ";
            $sql .= " ) ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "employee_is_active" => $this->employee_is_active,
                "employee_first_name" => $this->employee_first_name,
                "employee_middle_name" => $this->employee_middle_name,
                "employee_last_name" => $this->employee_last_name,
                "employee_department_id" => $this->employee_department_id, 
                "employee_email" => $this->employee_email,
                "employee_created" => $this->employee_created,
                "employee_updated" => $this->employee_updated,
            ]);
            $this->lastInsertedId = $this->connection->lastInsertId();
        } catch (PDOException $e) {
            $query = false;
        }
        return $query;
    }
    public function readAll(){
        try{
            // JOINING TABLE
            $sql = "select ";
            $sql .= " * ";
            $sql .= " from {$this->tblEmployees} as employees, ";
            $sql .= " {$this->tblSettingsDepartment} as department ";
            $sql .= " where employees.employee_department_id = department.department_aid ";
            // FILTER
            $sql .= $this->employee_is_active != '' ? " and employees.employee_is_active = :employee_is_active " : " ";
            // SEARCH
            $sql .= $this->search != '' ? " and ( " : " ";
            $sql .= $this->search != '' ? " employees.employee_first_name like :employee_first_name  " : " ";
            $sql .= $this->search != '' ? " or employees.employee_last_name like :employee_last_name  " : " ";
            $sql .= $this->search != '' ? " or employees.employee_email like :employee_email  " : " ";
            $sql .= $this->search != '' ? " or CONCAT(employees.employee_last_name,' ',employees.employee_first_name) like :employee_last_fullname " : " ";
            $sql .= $this->search != '' ? " or CONCAT(employees.employee_first_name,' ',employees.employee_last_name) like :employee_first_fullname " : " ";
            $sql .= $this->search != '' ? " ) " : " ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                // FOR FILTER 
                ...$this->employee_is_active != '' ? ["employee_is_active" => $this->employee_is_active] : [],
                // FOR SEARCHING
                ...$this->search != '' ? [
                    "employee_first_name" => "%{$this->search}%",
                    "employee_last_name" => "%{$this->search}%",
                    "employee_email" => "%{$this->search}%",
                    "employee_last_fullname" => "%{$this->search}%",
                    "employee_first_fullname" => "%{$this->search}%",
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
            $sql .= " from {$this->tblEmployees} as employees, ";
            $sql .= " {$this->tblSettingsDepartment} as department ";
            $sql .= " where employees.employee_department_id = department.department_aid ";
            // FILTER
            $sql .= $this->employee_is_active != '' ? " and employees.employee_is_active = :employee_is_active " : " ";
            // SEARCH
            $sql .= $this->search != '' ? " and ( " : " ";
            $sql .= $this->search != '' ? " employees.employee_first_name like :employee_first_name  " : " ";
            $sql .= $this->search != '' ? " or employees.employee_last_name like :employee_last_name  " : " ";
            $sql .= $this->search != '' ? " or employees.employee_email like :employee_email  " : " ";
            $sql .= $this->search != '' ? " or CONCAT(employees.employee_last_name,' ',employees.employee_first_name) like :employee_last_fullname " : " ";
            $sql .= $this->search != '' ? " or CONCAT(employees.employee_first_name,' ',employees.employee_last_name) like :employee_first_fullname " : " ";
            $sql .= $this->search != '' ? " ) " : " ";
            // THIS IS FOR PAGINATION LIKE FACEBOOK SCROLLING
            $sql .= "limit :start, ";
            $sql .= " :total ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                // FOR FILTER 
                ...$this->employee_is_active != '' ? ["employee_is_active" => $this->employee_is_active] : [],
                // FOR SEARCHING
                ...$this->search != '' ? [
                    "employee_first_name" => "%{$this->search}%",
                    "employee_last_name" => "%{$this->search}%",
                    "employee_email" => "%{$this->search}%",
                    "employee_last_fullname" => "%{$this->search}%",
                    "employee_first_fullname" => "%{$this->search}%",
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
            $sql = " update {$this->tblEmployees} set ";
            $sql .= " employee_first_name = :employee_first_name, ";
            $sql .= " employee_middle_name = :employee_middle_name, ";
            $sql .= " employee_last_name = :employee_last_name, ";
            $sql .= " employee_department_id = :employee_department_id, ";
            $sql .= " employee_email = :employee_email, ";
            $sql .= " employee_updated = :employee_updated ";
            $sql .= " where employee_aid = :employee_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "employee_first_name" => $this->employee_first_name,
                "employee_middle_name" => $this->employee_middle_name,
                "employee_last_name" => $this->employee_last_name,
                "employee_department_id" => $this->employee_department_id,
                "employee_email" => $this->employee_email,
                "employee_updated" => $this->employee_updated,
                "employee_aid" => $this->employee_aid,
            ]);
        } catch (PDOException $e) {
            $query = false;
        }
        return $query;
    }
    public function active(){
        try{
            $sql =" update {$this->tblEmployees} set ";
            $sql .= " employee_is_active = :employee_is_active, "; 
            $sql .= " employee_updated = :employee_updated ";
            $sql .= " where employee_aid = :employee_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "employee_is_active" => $this->employee_is_active,
                "employee_updated" => $this->employee_updated,
                "employee_aid" => $this->employee_aid,
            ]);
        }catch(PDOException $e){
            // returnError($e); //turn on when debugging
            $query = false;
        } return $query;
    }
    public function delete(){
        try{
            $sql =" delete from {$this->tblEmployees} ";
            $sql .= " where employee_aid = :employee_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "employee_aid" => $this->employee_aid,
            ]);
        }catch(PDOException $e){
            // returnError($e); //turn on when debugging
            $query = false;
        } return $query;
    }
    public function checkName(){
        try{
            $sql = "select ";
            $sql .= " employee_first_name ";
            $sql .= " from {$this->tblEmployees} ";
            $sql .= " where employee_first_name = :employee_first_name ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "employee_first_name" => $this->employee_first_name,
            ]);
        }catch(PROException $e){
            $query = false;
        }
        return $query;
    }
}
