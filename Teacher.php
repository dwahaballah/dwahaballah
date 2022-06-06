<?php
	session_start();
	include "../Frontend/TopNav.html";
	require_once "User.php";
	require "UserInfo.php";
	require "Courses.php";
    require "CourseInterface.php";
	require "Schedule.php";
	class Teacher extends UserInfo implements User , CourseInterface{
	    private $phone;
	    private $address;
	    use Courses{
			Courses::__construct as crs;
		}
		use Schedule{
			Schedule::__construct as sch;
		}
		public function setcrs($id,$name)
		{
			$this->crs($id,$name);

		}
		public function __construct($ID, $fn, $ln, $em, $pass, $ph, $add)
	    {
			parent::__construct($ID, $fn, $ln, $em, $pass);
	        $this->phone=$ph;
	        $this->address=$add;
	    }
		public function SetCourse($CID,$CN)
        {
            $this->crs($CID,$CN);
        }
		public function SetSchedule($STT,$ET){
			$this->sch($STT,$ET);
		}
        public function getph(){
        	return $this->phone;
        }
        public function getadd(){
            return $this->address;
        }
		function __destruct(){
		}
	    public function ShowProfile()
	    {
	        echo $this->getID();
            echo "<hr>";
            echo $this->getfName();
            echo "<hr>";
            echo $this->getlName();
            echo "<hr>";
            echo $this->getem();
            echo "<hr>";
            echo $this->getph();
            echo "<hr>";
            echo $this->getadd();
	    }
		public function ShowCRS()
		{
			echo $this->getCID();
			echo"<hr>";
			echo $this->getCN();
			echo "<hr>";
		}
		public function ShowSCH()
		{
			echo $this->getSTT();
			echo"<hr>";
			echo $this->getET();
			echo "<hr>";
		}
	}
?>
