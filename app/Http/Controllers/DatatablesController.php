<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use DataTables;

class DatatablesController extends Controller
{
    /**
	 * Displays datatables front end view
	 *
	 * @return \Illuminate\View\View
	 */


    /*=====================================================================================
    =            Method Show Donators View And Returns Data On DataTables Ajax            =
    =====================================================================================*/
    
    
	public function index()
	{


// 		$hostname_mysqlcon = "localhost";
// $database_mysqlcon = "financial_reports";
// $username_mysqlcon = "root";
// $password_mysqlcon = "";
// $db = mysqli_connect($hostname_mysqlcon, $username_mysqlcon, $password_mysqlcon) or trigger_error(mysql_error(),E_USER_ERROR);
// //mysqli_query($db,'utf8');
// mysqli_set_charset($db, "utf8");
// mysqli_select_db($db, $database_mysqlcon );

// $sql = "select persons.first_name, persons.last_name, cities.name as city, mon.amount as monetary, YEAR(reports.date) as report_year from persons 
// left join cities 
// on cities.id = persons.residence_city_id 
// join personal_donations as mon 
// on persons.id = mon.person_id  
// left join reports 
// on mon.report_id = reports.id
// where and mon.donation_type_id = 1";

// $sql = "select persons.first_name, persons.last_name, cities.name as city, mon.amount as monetary, nonmon.amount as nonmonetary, YEAR(reports.date) as report_year 
// 		from personal_donations as pd 
// 		left join persons as p 
// 		on p.id = pd.person_id 
// 		left join cities as c 
// 		on c.id = p.residence_city_id 
	
// ";

// $res = $db->query($sql)->fetch_all(MYSQLI_ASSOC);
// dd($res);die;
		/*----------  Checks if request is AJAX  ----------*/
		
		if (request()->ajax()) {

	        return DataTables::of(Person::getAllDonatorsForDT())->make(true);
	    }


	    return view('donators');
	}
    
    /*=====  End of Method Show Donators View And Returns Data On DataTables Ajax  ======*/
    
}
