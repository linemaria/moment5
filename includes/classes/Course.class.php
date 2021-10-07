 <?php

class Course {
    private $db;
    private $code;
    private $courseName;
    private $progression;
    private $syllabus;
    private $term;
    private $id;


    //Constructor
    public function __construct() {
        //Database connection
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        //check connection
        if($this->db->connect_error) {
            die("Fel vid anslutning: " . $this -> db -> connect_error);
        }
    }

    /**
     * @param string $code
     * @param string $courseName
     * @param string $progression
     * @param string $syllabus
     * @param string $term
     * @return boolean 
     */
    
    //Getters 

    //lägg till ny kurs                                                                                   //int för term
    public function addCourse( string $code, string $courseName, string $progression, string $syllabus, string $term ) : bool {
    $this->code = $code;
    $this->courseName = $courseName;
    $this->progression = $progression;
    $this->syllabus = $syllabus;
    $this->term = $term;

    $stmt = $this->db->prepare("INSERT INTO courses (code, courseName, progression, syllabus, term) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $this->code, $this->courseName, $this->progression, $this->syllabus, $this->term);
                          //sista i istället för s
    if ($stmt->execute()) {
        return true;
    } else {
    return false;
    }

    $stmt->close();

}
/**
 * get all courses
 * @return array
 */

public function getCourses() : array {
    $sql= "SELECT * FROM courses ORDER BY id;";
    $result = $this->db->query($sql);

    return $result->fetch_all(MYSQLI_ASSOC);
}
/**
 * ta bort kurs
 * @param string $code
 * @return boolean
 */
public function deleteCourse(int $id) : bool{
$id= intval($id);

$sql = "DELETE FROM courses WHERE id=$id;";
$result = $this->db->query($sql);

return $result;

}

/**
 * hämta specifik kurs
 * @param int $id
 * @return array
 */

public function getCourseById(int $id) : array {
    $id = intval($id);

    $sql = "SELECT * FROM courses WHERE id=$id;";
    $result = $this->db->query($sql);
 
    return $result->fetch_all(MYSQLI_ASSOC);

 }

 /**
     * @param string $code
     * @param string $courseName
     * @param string $progression
     * @param string $syllabus
     * @param string $term
     * @return boolean 
  */
public function updateCourse(int $id, string $code, string $courseName, string $progression, string $syllabus, string $term ) : bool {
    $this->code = $code;
    $this->courseName = $courseName;
    $this->progression = $progression;
    $this->syllabus = $syllabus;
    $this->term = $term;
    $id = intval($id);

    //prepare statement
    $stmt = $this->db->prepare("UPDATE courses SET code=?, courseName=?, progression=?, syllabus=?, term=? WHERE id=$id;");
    $stmt->bind_param("sssss", $this->code, $this->courseName, $this->progression, $this->syllabus, $this->term);
    if ($stmt->execute()) {
        return true;
    } else {
    return false;
    }

    $stmt->close();
}

} 

