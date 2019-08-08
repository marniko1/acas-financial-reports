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
	public function index()
	{

		if (request()->ajax()) {

	        return DataTables::of(
	        					Person::leftJoin('cities', 'cities.id', '=', 'persons.residence_city_id')
	        					->leftJoin('personal_donations as mon', function ($join) {
	        						$join->on('persons.id', '=', 'mon.person_id')
	        							 ->where('mon.donation_type_id', '=', 1);
	        					})
	        					->leftJoin('personal_donations as nonmon', function ($join) {
	        						$join->on('persons.id', '=', 'nonmon.person_id')
	        							 ->where('nonmon.donation_type_id', '=', 2);
	        					})
	        					->leftJoin('reports', function ($join) {
	        						$join->on('mon.report_id', '=', 'reports.id');
	        					})
	        					->leftJoin('political_subjects', 'political_subjects.id', '=', 'reports.political_subject_id')
	        					->leftJoin('reports_elections', 'reports.id', '=', 'reports_elections.report_id')
	        					->leftJoin('elections', 'elections.id', '=', 'reports_elections.election_id')
	        					->leftJoin('elections_levels', 'elections_levels.id', '=', 'elections.election_level_id')
	        					->leftJoin('elections_types', 'elections_types.id', '=', 'elections.election_type_id')
	        					->select('persons.first_name', 'persons.last_name', 'cities.name as city', 'mon.amount as monetary', 'nonmon.amount as nonmonetary', 'political_subjects.name as political_subject', 'elections.title as election', 'elections_levels.level as election_level', 'elections_types.type as election_type')



	    			)->make(true);
	    }


	    return view('donators');
	}
}
