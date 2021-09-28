<?php

namespace Dbh\Symfony\ScheduleBundle\Model;

interface ManagerInterface {

    public function schedule(Schedule $schedule);
}
