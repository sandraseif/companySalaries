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
        $first_day_this_month = date('Y-'.$month.'-01');
        $firstDayThisMonth    = new \DateTime($first_day_this_month);
        $lastDayThisMonth     = new \DateTime($firstDayThisMonth->format('Y-m-t'));
        $lastDayThisMonth->setTime(23, 59, 59);
        $nameOfLastDay = date('D', strtotime($lastDayThisMonth->format("Y-m-d")));
        $nameOfMonth = date('M', strtotime($lastDayThisMonth->format("Y-m-d")));
        $salariesWithoutBonus = 0;
        $bonusAmounts         = 0;  

        $bonusDay       =   date('Y-'.$month.'-15');
        $dateOfBonusDay = new \DateTime($bonusDay);
        $nameOfbonusDay = date('D', strtotime($dateOfBonusDay->format("Y-m-d")));
 
        if($nameOfbonusDay == 'Fri'){
            $bonusDay      =   date('d', strtotime('+6 day', strtotime($dateOfBonusDay->format("Y-m-d"))));
        }else if($nameOfbonusDay == 'Sat') {
            $bonusDay      = date('d', strtotime('+5 day', strtotime($dateOfBonusDay->format("Y-m-d"))));
        }else{
            $bonusDay      =  date('d', strtotime($dateOfBonusDay->format("Y-m-d")));
        }

        if($nameOfLastDay == 'Fri'){
            $salaryDay      =   date('d', strtotime('-1 day', strtotime($lastDayThisMonth->format("Y-m-d"))));
        }else if($nameOfLastDay == 'Sat') {
            $salaryDay      = date('d', strtotime('-2 day', strtotime($lastDayThisMonth->format("Y-m-d"))));
        }else{
            $salaryDay      =   date('d', strtotime($lastDayThisMonth->format("Y-m-d")));
        }
            
        $employees = Employee::all();
        foreach($employees as $employee){
            if($employee->bonuspercentage == 0){
                $depemployee     = DepartmentsEmployees::where('employeeID', $employee->id)->first(); 
                $departmentID    = $depemployee->departmentID;
                $bonusPercentage = Department::find($departmentID)->bonuspercentage;  
            }else{
                $bonusPercentage   = $employee->bonuspercentage;   
            }

            $bonusPerEmployee     =  $employee->salary*($bonusPercentage/100);
            $bonusAmounts         += $bonusPerEmployee; 
            $salariesWithoutBonus = $salariesWithoutBonus+$employee->salary;
        }
        $totalPayments = $bonusAmounts+$salariesWithoutBonus;
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
            foreach($months as $monthNumber){
               $monthsSalaries[]=  $this->getSalariesMonths($monthNumber);
            }
        }else{
              $monthsSalaries =  $this->getSalariesMonths($month);
        }
        return json_encode($monthsSalaries);
    }
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
