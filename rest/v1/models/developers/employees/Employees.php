<?php

class Employees
{
    public $employee_aid;
    public $employee_is_active;
    public $employee_first_name;
    public $employee_middle_name;
    public $employee_last_name;
    public $employee_birthday;
    public $employee_start_work_date;
    public $employee_email;
    public $employee_created;
    public $employee_updated;
    public $employee_department_id;
    public $employee_supervisor_id;
    public $employee_supervisor_first_name;
    public $employee_supervisor_last_name;
    public $employee_supervisor_email;

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
            $sql .= " employee_start_work_date, ";
            $sql .= " employee_birthday, ";
            $sql .= " employee_department_id, "; 
            $sql .= " employee_email, ";
            $sql .= " employee_created, ";
            $sql .= " employee_updated ";
            $sql .= ") values (";
            $sql .= " :employee_is_active, ";
            $sql .= " :employee_first_name, ";
            $sql .= " :employee_middle_name, ";
            $sql .= " :employee_last_name, ";
            $sql .= " :employee_start_work_date, ";
            $sql .= " :employee_birthday, ";
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
                "employee_start_work_date" => $this->employee_start_work_date,
                "employee_birthday" => $this->employee_birthday,
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
            // Added department search here:
            $sql .= $this->search != '' ? " or department.department_name like :department_name  " : " ";
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
                    // Bind department search parameter:
                    "department_name" => "%{$this->search}%",
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
            // Added department search here:
            $sql .= $this->search != '' ? " or department.department_name like :department_name  " : " ";
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
                    // Bind department search parameter:
                    "department_name" => "%{$this->search}%",
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
            $sql .= " employee_start_work_date = :employee_start_work_date, ";
            $sql .= " employee_birthday = :employee_birthday, ";
            $sql .= " employee_department_id = :employee_department_id, ";
            $sql .= " employee_email = :employee_email, ";
            $sql .= " employee_updated = :employee_updated ";
            $sql .= " where employee_aid = :employee_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "employee_first_name" => $this->employee_first_name,
                "employee_middle_name" => $this->employee_middle_name,
                "employee_last_name" => $this->employee_last_name,
                "employee_start_work_date" => $this->employee_start_work_date,
                "employee_birthday" => $this->employee_birthday,
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
        }catch(PDOException $e){
            $query = false;
        }
        return $query;
    }

    // --- NEW METHODS FOR DIRECT REPORTS FEATURE ---

    // Check if the selected supervisor is actually a subordinate of the target employee
    public function checkCircularDependency($supervisor_id, $subordinate_id) {
        try {
            $sql = "SELECT employee_aid FROM {$this->tblEmployees} ";
            $sql .= "WHERE employee_aid = :supervisor_id AND employee_supervisor_id = :subordinate_id";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "supervisor_id" => $supervisor_id,
                "subordinate_id" => $subordinate_id
            ]);
            $rowCount = $query->rowCount();
            return $rowCount > 0;
        } catch(PDOException $e) {
            return false;
        }
    }

    // Fetch employee details to populate supervisor name/email automatically
public function getEmployeeDetails($id) {
        try {
            // Added 'employee_supervisor_id' to the SELECT query
            $sql = "SELECT employee_first_name, employee_last_name, employee_email, employee_supervisor_id ";
            $sql .= "FROM {$this->tblEmployees} WHERE employee_aid = :id LIMIT 1";
            $query = $this->connection->prepare($sql);
            $query->execute(["id" => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }

    // Update the direct report in the employee table
    public function updateDirectReport() {
        try {
            $sql = "UPDATE {$this->tblEmployees} SET ";
            $sql .= " employee_supervisor_id = :employee_supervisor_id, ";
            $sql .= " employee_supervisor_first_name = :employee_supervisor_first_name, ";
            $sql .= " employee_supervisor_last_name = :employee_supervisor_last_name, ";
            $sql .= " employee_supervisor_email = :employee_supervisor_email, ";
            $sql .= " employee_updated = :employee_updated ";
            $sql .= " WHERE employee_aid = :employee_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "employee_supervisor_id" => $this->employee_supervisor_id,
                "employee_supervisor_first_name" => $this->employee_supervisor_first_name,
                "employee_supervisor_last_name" => $this->employee_supervisor_last_name,
                "employee_supervisor_email" => $this->employee_supervisor_email,
                "employee_updated" => $this->employee_updated,
                "employee_aid" => $this->employee_aid,
            ]);
        } catch (PDOException $e) {
            $query = false;
        }
        return $query;
    }

    public function readAllDirectReports(){
        try{
            $sql = "select * from {$this->tblEmployees} as employees, {$this->tblSettingsDepartment} as department ";
            $sql .= " where employees.employee_department_id = department.department_aid ";
            // FILTER: Only show employees with an assigned supervisor
            $sql .= " and (employees.employee_supervisor_id IS NOT NULL AND employees.employee_supervisor_id != '') ";
            
            $sql .= $this->employee_is_active != '' ? " and employees.employee_is_active = :employee_is_active " : " ";
            $sql .= $this->search != '' ? " and ( " : " ";
            $sql .= $this->search != '' ? " employees.employee_first_name like :employee_first_name  " : " ";
            $sql .= $this->search != '' ? " or employees.employee_last_name like :employee_last_name  " : " ";
            $sql .= $this->search != '' ? " ) " : " ";
            
            $query = $this->connection->prepare($sql);
            $query->execute([
                ...$this->employee_is_active != '' ? ["employee_is_active" => $this->employee_is_active] : [],
                ...$this->search != '' ? [
                    "employee_first_name" => "%{$this->search}%",
                    "employee_last_name" => "%{$this->search}%",
                ] : [],
            ]);
        }catch(PDOException $e){
            $query = false;
        }
        return $query;
    }

    public function readLimitDirectReports(){
        try{
            $sql = "select * from {$this->tblEmployees} as employees, {$this->tblSettingsDepartment} as department ";
            $sql .= " where employees.employee_department_id = department.department_aid ";
            // FILTER: Only show employees with an assigned supervisor
            $sql .= " and (employees.employee_supervisor_id IS NOT NULL AND employees.employee_supervisor_id != '') ";
            
            $sql .= $this->employee_is_active != '' ? " and employees.employee_is_active = :employee_is_active " : " ";
            $sql .= $this->search != '' ? " and ( " : " ";
            $sql .= $this->search != '' ? " employees.employee_first_name like :employee_first_name  " : " ";
            $sql .= $this->search != '' ? " or employees.employee_last_name like :employee_last_name  " : " ";
            $sql .= $this->search != '' ? " ) " : " ";
            
            $sql .= "limit :start, :total ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                ...$this->employee_is_active != '' ? ["employee_is_active" => $this->employee_is_active] : [],
                ...$this->search != '' ? [
                    "employee_first_name" => "%{$this->search}%",
                    "employee_last_name" => "%{$this->search}%",
                ] : [],
                "start" => $this->start - 1,
                "total" => $this->total,
            ]);
        }catch(PDOException $e){
            $query = false;
        }
        return $query;
    }
}