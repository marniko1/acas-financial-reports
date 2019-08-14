<?php

namespace AcasReports\Http\Controllers;

use Illuminate\Http\Request;
use AcasReports\Person;
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

		/*----------  Checks if request is AJAX  ----------*/
		
		if (request()->ajax()) {

	        return DataTables::of(Person::getAllDonatorsForDT())->make(true);
	    }


	    return view('donators');
	}
    
    /*=====  End of Method Show Donators View And Returns Data On DataTables Ajax  ======*/
    
}
