<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonatorsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW donators AS SELECT p.first_name, p.last_name, c.name AS city, mon.amount AS monetary, nonmon.amount AS nonmonetary, ps.name AS political_subject, e.title AS election, et.type AS election_type, el.level AS election_level FROM persons AS p 
                    LEFT JOIN cities AS c 
                    ON c.id = p.residence_city_id 
                    LEFT JOIN personal_donations AS mon 
                    ON mon.person_id = p.id AND mon.donation_type_id = 1 
                    LEFT JOIN personal_donations AS nonmon 
                    ON nonmon.person_id = p.id AND nonmon.donation_type_id = 2 
                    LEFT JOIN reports AS r 
                    ON r.id = mon.report_id OR r.id = nonmon.report_id 
                    LEFT JOIN political_subjects AS ps 
                    ON ps.id = r.political_subject_id
                    LEFT JOIN reports_elections AS re 
                    ON re.report_id = r.id 
                    LEFT JOIN elections AS e 
                    ON e.id = re.election_id 
                    LEFT JOIN elections_types AS et 
                    ON et.id = e.election_type_id 
                    LEFT JOIN elections_levels AS el 
                    ON el.id = e.election_level_id"
                );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW donators");
    }
}
