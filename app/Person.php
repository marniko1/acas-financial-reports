<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

	protected $table = 'persons';
    
	/*====================================================================
	=            Method Prepares Data For DataTables Donators            =
	====================================================================*/
	
	
    public static function getAllDonatorsForDT() {

    	$monetary = self::leftJoin('cities', 'cities.id', '=', 'persons.residence_city_id')
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
	        					->selectRaw('persons.first_name, persons.last_name, cities.name as city, mon.amount as monetary, nonmon.amount as nonmonetary, YEAR(reports.date) as report_year, political_subjects.name as political_subject, elections.title as election, YEAR(elections.date_of_calling) as election_year, elections_levels.level as election_level, elections_types.type as election_type')
	        					->whereNotNull('mon.report_id');


	    /*----------  Nonmonetary donators union with monetary ordered by name  ----------*/

	    /*----------  Using union is faster then using join in this case  ----------*/
	    
	    
	    return	self::leftJoin('cities', 'cities.id', '=', 'persons.residence_city_id')
	        					->leftJoin('personal_donations as mon', function ($join) {
	        						$join->on('persons.id', '=', 'mon.person_id')
	        							 ->where('mon.donation_type_id', '=', 1);
	        					})
	        					->leftJoin('personal_donations as nonmon', function ($join) {
	        						$join->on('persons.id', '=', 'nonmon.person_id')
	        							 ->where('nonmon.donation_type_id', '=', 2);
	        					})
	        					->leftJoin('reports', function ($join) {
	        						$join->on('nonmon.report_id', '=', 'reports.id');
	        					})
	        					->leftJoin('political_subjects', 'political_subjects.id', '=', 'reports.political_subject_id')
	        					->leftJoin('reports_elections', 'reports.id', '=', 'reports_elections.report_id')
	        					->leftJoin('elections', 'elections.id', '=', 'reports_elections.election_id')
	        					->leftJoin('elections_levels', 'elections_levels.id', '=', 'elections.election_level_id')
	        					->leftJoin('elections_types', 'elections_types.id', '=', 'elections.election_type_id')
	        					->selectRaw('persons.first_name, persons.last_name, cities.name as city, mon.amount as monetary, nonmon.amount as nonmonetary, YEAR(reports.date) as report_year, political_subjects.name as political_subject, elections.title as election, YEAR(elections.date_of_calling) as election_year, elections_levels.level as election_level, elections_types.type as election_type')
	        					->whereNull('mon.report_id')
	        					->unionAll($monetary)
	        					->orderBy('first_name')
	        					->orderBy('last_name');

    }
	
	/*=====  End of Method Prepares Data For DataTables Donators  ======*/
	
}
