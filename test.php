<?php

include("includes/config.php");

$s = new Course();

$s->deleteCourse(12);

echo "<pre>";
var_dump($s->getCourses());
echo "</pre>";