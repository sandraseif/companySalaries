<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\User;
use App\DepartmentsEmployees;
use Mail;
class MainController extends Controller
{
    public function index(){
        return view('api.index');
    }
    public function getSalariesMonths($month){
        $month                = $month;

        //checking the last day of the month by name
        $first_day_this_month = date('Y-'.$month.'-01');
        $firstDayThisMonth    = new \DateTime($first_day_this_month);
        $lastDayThisMonth     = new \DateTime($firstDayThisMonth->format('Y-m-t'));
        $lastDayThisMonth->setTime(23, 59, 59);
        $nameOfLastDay        = date('D', strtotime($lastDayThisMonth->format("Y-m-d")));
        $nameOfMonth          = date('M', strtotime($lastDayThisMonth->format("Y-m-d")));

        $salariesWithoutBonus = 0;
        $bonusAmounts         = 0;  

        //checking the bonus day of the month by name
        $bonusDay       = date('Y-'.$month.'-15');
        $dateOfBonusDay = new \DateTime($bonusDay);
        $nameOfbonusDay = date('D', strtotime($dateOfBonusDay->format("Y-m-d")));
        
    
        if($nameOfbonusDay == 'Fri'){
            //adding 6 days to reach the first thursday after current  week if it is friday
            $bonusDay      =   date('d', strtotime('+6 day', strtotime($dateOfBonusDay->format("Y-m-d"))));
        }else if($nameOfbonusDay == 'Sat') {
             //adding 5 days to reach the first thursday after current  week if it is saturday
            $bonusDay      = date('d', strtotime('+5 day', strtotime($dateOfBonusDay->format("Y-m-d"))));
        }else{
             //if it is weekday then it will stay as it is          
            $bonusDay      =  date('d', strtotime($dateOfBonusDay->format("Y-m-d")));
        }

        if($nameOfLastDay == 'Fri'){
            //minus 1 day to reach the last thursday in month if it is friday
            $salaryDay      =   date('d', strtotime('-1 day', strtotime($lastDayThisMonth->format("Y-m-d"))));
        }else if($nameOfLastDay == 'Sat') {
             //minus 2 days to reach the last thursday in month if it is saturday
            $salaryDay      = date('d', strtotime('-2 day', strtotime($lastDayThisMonth->format("Y-m-d"))));
        }else{
             //if it is weekday then it will stay as it is                      
            $salaryDay      = date('d', strtotime($lastDayThisMonth->format("Y-m-d")));
        }
        
        
        //Inner join with the three tables to get a whole new array with all the data we need
        $employees = Employee::select(  "employees.name AS employeename",
                                        "employees.ID AS employeeID",
                                        "employees.salary as employeebasesalary",
                                        "employees.bonuspercentage as employeebonus",
                                        "departments.name AS departmentname",
                                        "departments.ID AS departmentID",
                                        "departments.basesalary as departmentbasesalary",
                                        "departments.bonuspercentage as departmentbonus")  
                    ->join('departments_employees', 'employees.id', '=', 'departments_employees.employeeID')
                    ->join('departments', 'departments.id', '=', 'departments_employees.departmentID')
                    ->get();

        //summing up the base salaries  and summing up bonus amounts
        foreach($employees as $employee){
            if($employee->employeebonus == 0){
                $bonusPercentage    = $employee->departmentbonus; 
            }else{
                $bonusPercentage   = $employee->employeebonus;   
            }

            $bonusPerEmployee     =  $employee->employeebasesalary*($bonusPercentage/100);
            $bonusAmounts         += $bonusPerEmployee; 
            $salariesWithoutBonus = $salariesWithoutBonus+$employee->employeebasesalary;
        }
        //total the company will pay 
        $totalPayments = $bonusAmounts+$salariesWithoutBonus;

        //response array 
        $salaries = ['Month'=>$nameOfMonth,
                    'Salaries_payment_day'=> $salaryDay,
                    'Bonus_payment_day'=> $bonusDay ,
                    'Salaries_total'=> '$'.$salariesWithoutBonus,
                    'Bonus_total'=> '$'.$bonusAmounts,
                    'Payments_total'=>'$'.$totalPayments];
        return $salaries;
    }
  
     //getting the salaries
    public function salaries($month){
        $months = ["01","02","03","04","05","06","07","08","09","10","11","12"];
        $currentMonth = date('m');
        $indexMonth = array_search($currentMonth, $months); 
        $months     = array_slice($months, $indexMonth);
        $monthsSalaries = [];

        if($month == "0"){     
            //passing zero to the API to list all the months remaining    
            foreach($months as $monthNumber){
               //loop on array of months numbers 
               $monthsSalaries[]=  $this->getSalariesMonths($monthNumber);
            }
        }else{
              //passing number of month to the API and get the salaries inside this month  
              $monthsSalaries =  $this->getSalariesMonths($month);
        }
        return json_encode($monthsSalaries);
    }

    //getting the salaries and bonus only for email reminder
    public function getSalariesForEmail(){
        $month = date('m');
        $monthsSalaries =  $this->getSalariesMonths($month);
        return $monthsSalaries;
    }
    public function basic_email() {
      $admins           =  User::all(); 
      $salariesResponse = $this->getSalariesForEmail();
      $salariesTotal    = $salariesResponse['Salaries_total'];
      $bonusTotal       = $salariesResponse['Bonus_total'];    

      //looping on all admins to send the email reminder
        foreach($admins as $admin){
            $adminemail = $admin->email;
            $adminname  = $admin->name;  
            $data = array('name'=>$adminname,"salariesTotal"=>$salariesTotal,"bonusTotal"=>$bonusTotal,"email"=>$adminemail);
            Mail::send('mail', $data, function($message) use ($adminemail,$adminname) {
            $message->to($adminemail, $adminname)->subject
                ('Salaries Reminder');
            $message->from('sandra.estafanous@gmail.com','Sandra Seif');
        });
        echo "Basic Email Sent. Check your inbox.";
        } 
   }

}
