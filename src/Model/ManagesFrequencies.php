<?php

namespace Dbh\Symfony\ScheduleBundle\Model;

trait ManagesFrequencies {

    /**
     * The Cron expression representing the event"s frequency.
     *
     * @param  string $expression
     * @return $this
     */
    public function cron($expression) {
        $this->cronExpression = $expression;

        return $this;
    }

    /**
     * Schedule the event to run every minute.
     *
     * @return $this
     */
    public function everyMinute() {
        return $this->spliceIntoPosition(1, "*");
    }

    /**
     * Schedule the event to run every five minutes.
     *
     * @return $this
     */
    public function everyFiveMinutes() {
        return $this->spliceIntoPosition(1, "*/5");
    }

    /**
     * Schedule the event to run every ten minutes.
     *
     * @return $this
     */
    public function everyTenMinutes() {
        return $this->spliceIntoPosition(1, "*/10");
    }

    /**
     * Schedule the event to run every fifteen minutes.
     *
     * @return $this
     */
    public function everyFifteenMinutes() {
        return $this->spliceIntoPosition(1, "*/15");
    }

    /**
     * Schedule the event to run every thirty minutes.
     *
     * @return $this
     */
    public function everyThirtyMinutes() {
        return $this->spliceIntoPosition(1, "0,30");
    }

    /**
     * Schedule the event to run hourly.
     *
     * @return $this
     */
    public function hourly() {
        return $this->spliceIntoPosition(1, 0);
    }

    /**
     * Schedule the event to run hourly at a given offset in the hour.
     *
     * @param  int $offset
     * @return $this
     */
    public function hourlyAt(int $offset) {
        return $this->spliceIntoPosition(1, $offset);
    }

    /**
     * Schedule the event to run daily.
     *
     * @return $this
     */
    public function daily() {
        return $this->spliceIntoPosition(1, 0)
            ->spliceIntoPosition(2, 0);
    }

    /**
     * Schedule the command at a given time.
     *
     * @param  string $time
     * @return $this
     */
    public function at(string $time) {
        return $this->dailyAt($time);
    }

    /**
     * Schedule the event to run daily at a given time (10:00, 19:30, etc).
     *
     * @param  string $time
     * @return $this
     */
    public function dailyAt(string $time) {
        $segments = explode(":", $time);

        return $this->spliceIntoPosition(2, (int)$segments[0])
            ->spliceIntoPosition(1, count($segments) == 2 ? (int)$segments[1] : "0");
    }

    /**
     * Schedule the event to run twice daily.
     *
     * @param  int $first
     * @param  int $second
     * @return $this
     */
    public function twiceDaily(int $first = 1, int $second = 13) {
        $hours = $first . "," . $second;

        return $this->spliceIntoPosition(1, 0)
            ->spliceIntoPosition(2, $hours);
    }

    /**
     * Schedule the event to run only on weekdays.
     *
     * @return $this
     */
    public function weekdays() {
        return $this->spliceIntoPosition(5, "1-5");
    }

    /**
     * Schedule the event to run only on weekends.
     *
     * @return $this
     */
    public function weekends() {
        return $this->spliceIntoPosition(5, "0,6");
    }

    /**
     * Schedule the event to run only on Mondays.
     *
     * @return $this
     */
    public function mondays() {
        return $this->days(1);
    }

    /**
     * Schedule the event to run only on Tuesdays.
     *
     * @return $this
     */
    public function tuesdays() {
        return $this->days(2);
    }

    /**
     * Schedule the event to run only on Wednesdays.
     *
     * @return $this
     */
    public function wednesdays() {
        return $this->days(3);
    }

    /**
     * Schedule the event to run only on Thursdays.
     *
     * @return $this
     */
    public function thursdays() {
        return $this->days(4);
    }

    /**
     * Schedule the event to run only on Fridays.
     *
     * @return $this
     */
    public function fridays() {
        return $this->days(5);
    }

    /**
     * Schedule the event to run only on Saturdays.
     *
     * @return $this
     */
    public function saturdays() {
        return $this->days(6);
    }

    /**
     * Schedule the event to run only on Sundays.
     *
     * @return $this
     */
    public function sundays() {
        return $this->days(0);
    }

    /**
     * Schedule the event to run weekly.
     *
     * @return $this
     */
    public function weekly() {
        return $this->spliceIntoPosition(1, 0)
            ->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(5, 0);
    }

    /**
     * Schedule the event to run weekly on a given day and time.
     *
     * @param  int    $day
     * @param  string $time
     * @return $this
     */
    public function weeklyOn(int $day, string $time = "0:0") {
        $this->dailyAt($time);

        return $this->spliceIntoPosition(5, $day);
    }

    /**
     * Schedule the event to run monthly.
     *
     * @return $this
     */
    public function monthly() {
        return $this->spliceIntoPosition(1, 0)
            ->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 1);
    }

    /**
     * Schedule the event to run monthly on a given day and time.
     *
     * @param  int    $day
     * @param  string $time
     * @return $this
     */
    public function monthlyOn(int $day = 1, string $time = "0:0") {
        $this->dailyAt($time);

        return $this->spliceIntoPosition(3, $day);
    }

    /**
     * Schedule the event to run twice monthly.
     *
     * @param  int $first
     * @param  int $second
     * @return $this
     */
    public function twiceMonthly(int $first = 1, int $second = 16) {
        $days = $first . "," . $second;

        return $this->spliceIntoPosition(1, 0)
            ->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, $days);
    }

    /**
     * Schedule the event to run quarterly.
     *
     * @return $this
     */
    public function quarterly() {
        return $this->spliceIntoPosition(1, 0)
            ->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 1)
            ->spliceIntoPosition(4, "1-12/3");
    }

    /**
     * Schedule the event to run yearly.
     *
     * @return $this
     */
    public function yearly() {
        return $this->spliceIntoPosition(1, 0)
            ->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 1)
            ->spliceIntoPosition(4, 1);
    }

    /**
     * Set the days of the week the command should run on.
     *
     * @param  array|mixed $days
     * @return $this
     */
    public function days($days) {
        $days = is_array($days) ? $days : func_get_args();

        return $this->spliceIntoPosition(5, implode(",", $days));
    }

    /**
     * Splice the given value into the given position of the expression.
     *
     * @param  int    $position
     * @param  string $value
     * @return $this
     */
    protected function spliceIntoPosition(int $position, string $value) {
        $segments = explode(" ", $this->cronExpression);
        $segments[$position - 1] = $value;

        return $this->cron(implode(" ", $segments));
    }
}
