<?php

namespace App\Controllers;

use App\Models\{Job,Project};

class IndexController extends BaseController {
    public function indexAction() {
        $jobs = Job::all();

        $projects = Project::all() ;

        $name = 'Hector Benitez';
            // $limitMonths = 2000;
            // $totalMonths = 0;
            // function printElement( $job) {
            //     // if($job->visible == false) {
            //     //   return;
            //     // }
            //     echo '<li class="work-position">';
            //     echo '<h5>' . $job->title . '</h5>';
            //     echo '<p>' . $job->description . '</p>';
            //     echo '<p>' . $job->getDurationAsString() . '</p>';
            //     echo '<strong>Achievements:</strong>';
            //     echo '<ul>';
            //     echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
            //     echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
            //     echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
            //     echo '</ul>';
            //     echo '</li>';
            // }
            // for($idx = 0;$idx < count($jobs); $idx++) {
            //     $totalMonths += $jobs[$idx]->months;
            //     if($totalMonths > $limitMonths) {
            //         break;
            //     }

            //     printElement($jobs[$idx]);
            // }

        return $this->renderHTML('index.twig', [
            'name' => $name,
            'jobs' => $jobs,
            'projects' => $projects,
        ]);

    }
}