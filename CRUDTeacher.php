<?php
    require "../Backend/Teacher.php";
    function readCID($CID){
        $filename='../Invoices/Courses.txt';
        $file=fopen($filename, 'a+') or die ('File Inaccesible');
        $seperator="|";
        while(!feof($file)){
            $line=fgets($file);
            $Arrline=explode($seperator,$line);
            if($Arrline[0]==$CID){
                return $Arrline[1];
                fclose($file);
            }
        }
        fclose($file);
    }
    
    function InsertGrade($SID,$CID,$GRD){
        $filename='../Invoices/StGrd.txt';
        $CID=trim($CID);
        $str=$SID."|".$CID."|".$GRD."\r\n";
        $file=fopen($filename, 'a+') or die ('File Inaccesible');
        fwrite($file, $str);
        fclose($file);
    }
    //Create Object
	$id_value= $_SESSION['ID'];
	$filename= '../Invoices/Teacher.txt';
	$file=fopen($filename, 'a+') or die('File Inaccesible');
	$seperator="|";
	while(!feof($file))
	{
	    $line=fgets($file);
	    $Arrline=explode($seperator, $line);
	    if($Arrline[0]==$id_value)
	    {
	        $tch=new Teacher($Arrline[0],$Arrline[1],$Arrline[2],$Arrline[3],$Arrline[4],$Arrline[5],$Arrline[6]);
	    }
    }
    fclose($file);

	echo "Profile:<br><br>";
	$tch->ShowProfile();

	echo"<br><br>";
	echo "Course:<br><br>";
    //Courses
	$filename='../Invoices/TchToCrsRelation.txt';
    $file=fopen($filename, 'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($file)){
        $line=fgets($file);
        $Arrline=explode($seperator,$line);
        if($tch->getID()==$Arrline[0]){
            $CID=$Arrline[1];
            $tch->SetCRS($Arrline[1],readCID($CID[1]));
            $tch->ShowCRS();
        }
    }
	fclose($file);
    //Grades
    /*
    $testSID="12";
    $testGRD="16%";
    $filename='../Invoices/StToCrsRelation.txt';
    $file=fopen($filename, 'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($file)){
        $line=fgets($file);
        $Arrline=explode($seperator,$line);
        if($testSID==$Arrline[0] && $tch->getCID()==$Arrline[1]){
            InsertGrade($testSID,$tch->getCID(),$testGRD);
            break;
        }
    }
	fclose($file);*/
    //Schedule
    echo"<br><br>";
	echo "Schedule:<br><br>";
    $tch->ShowCRS();
    $filename='../Invoices/TeacherSchedule.txt';
    $file=fopen($filename, 'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($file)){
        $line=fgets($file);
        $Arrline=explode($seperator,$line);
        if($tch->getID()===$Arrline[0]){
            $tch->SetSchedule($Arrline[1],$Arrline[2]);
            $tch->ShowSCH();
        }
    }
    fclose($file);
?>