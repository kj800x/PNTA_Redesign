<?php

function unzip($file){ 
    $zip = zip_open($file); 
    if(is_resource($zip)){ 
        $tree = ""; 
        while(($zip_entry = zip_read($zip)) !== false){ 
            echo "Unpacking ".zip_entry_name($zip_entry)."\n"; 
            if(strpos(zip_entry_name($zip_entry), DIRECTORY_SEPARATOR) !== false){ 
                $last = strrpos(zip_entry_name($zip_entry), DIRECTORY_SEPARATOR); 
                $dir = substr(zip_entry_name($zip_entry), 0, $last); 
                $file = substr(zip_entry_name($zip_entry), strrpos(zip_entry_name($zip_entry), DIRECTORY_SEPARATOR)+1); 
                if(!is_dir($dir)){ 
                    @mkdir($dir, 0755, true) or die("Unable to create $dir\n"); 
                } 
                if(strlen(trim($file)) > 0){ 
                    $return = @file_put_contents($dir."/".$file, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry))); 
                    if($return === false){ 
                        die("Unable to write file $dir/$file\n"); 
                    } 
                } 
            }else{ 
                file_put_contents($file, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry))); 
            } 
        } 
    }else{ 
        echo "Unable to open zip file\n"; 
    } 
} 

function MySqlQueryToArray($sqlquery)
    {
        $Outarray = array();
        while($row = mysql_fetch_array($sqlquery))
        {
            $TempArray = array();
            foreach ($row as $key => $value){
                $TempArray[$key] = stripslashes($value);
            }
            $Outarray[] = $TempArray;
        }
        return $Outarray;
    }
function ArraytoMYSQL($statementtype, $withwhat, $changearray="", $wherearray="")
    {
        $outstring = "";
        if ($statementtype == 'INSERT')
            {
                $arraycount = count($changearray);
                $i = 0;
                $outstring .= "INSERT INTO $withwhat (";                
                foreach ($changearray as $key => $value)
                    {
                        $outstring .= $key;
                        if(++$i != $arraycount) {
                            $outstring .= ", ";
                        }
                    }
                $i = 0;
                $outstring .= ') VALUES (';
                foreach ($changearray as $key => $value)
                    {
                        $outstring .= $value;
                        if(++$i != $arraycount) {
                            $outstring .= ", ";
                        }
                    }
                $outstring .= ');';
                #| (author, dateposted, content, title) VALUES ('".mysql_escape_string($author)."', CURDATE(), '".mysql_escape_string(trim($content))."', '".mysql_escape_string($title)."')|
            }
        else if ($statementtype == 'UPDATE')
            {
                $changearraycount = count($changearray);
                $i = 0;
                $outstring .= "UPDATE $withwhat SET ";               
                foreach ($changearray as $key => $value)
                    {
                        $outstring .= "`$key` = $value";
                        if(++$i != $changearraycount) {
                            $outstring .= ", ";
                        }
                    }
                $outstring .= " WHERE ";
                
                $wherearraycount = count($wherearray);
                $i = 0;
                
                foreach ($wherearray as $key => $value)
                    {
                        $outstring .= "`$key` = $value";
                        if(++$i != $wherearraycount) {
                            $outstring .= " AND ";
                        }
                    }
                #"UPDATE contact SET name = '".mysql_escape_string($name)."', role = '".mysql_escape_string($role)."', email = '".mysql_escape_string($email)."' WHERE id = ".mysql_escape_string($contactid)."";
            }
        else if ($statementtype == 'DELETE')
            {
                $outstring .= "DELETE FROM $withwhat";    
                $outstring .= " WHERE ";
                $wherearraycount = count($wherearray);
                $i = 0;
                
                foreach ($wherearray as $key => $value)
                    {
                        $outstring .= "`$key` = $value";
                        if(++$i != $wherearraycount) {
                            $outstring .= " AND ";
                        }
                    }
                #DELETE FROM news WHERE id = ".mysql_escape_string($newsid)
            }
        return $outstring;
    }
    
function Getmysqlcon()
    {
    $host = "localhost";
    $user = "pnta";
    $password = "Raez7cdG*";
    $database = "pnta_1";
    $tempconn =  mysql_connect($host, $user, $password);
    mysql_select_db($database);
    return $tempconn;
    }  
  
// News Entries
// news:
//  id         = int(11) AUTOINCREMENT;
//  author     = varchar(32);
//  dateposted = date;
//  content    = longtext;
//  title      = varchar(100);

function PostNews($author, $content, $title)
  {
  $con = Getmysqlcon();
  $valuesarray = array(
    "author" => "'".mysql_escape_string($author)."'",
    "dateposted" => "CURDATE()",
    "content" => "'".mysql_escape_string(trim($content))."'",
    "title" => "'".mysql_escape_string($title)."'",
  );
  $textquery = ArraytoMYSQL('INSERT', 'news', $valuesarray);
  $query = mysql_query($textquery);
  }
function EditNews($newsid, $author, $content, $title)
  {
  $con = Getmysqlcon();
  $wherearray = array(
    "id" => mysql_escape_string($newsid),
  );
  $valuesarray = array(
    "author" => "'".mysql_escape_string($author)."'",
    "content" => "'".mysql_escape_string(trim($content))."'",
    "title" => "'".mysql_escape_string($title)."'",
  );
  $textquery = ArraytoMYSQL('UPDATE', 'news', $valuesarray, $wherearray);
  $query = mysql_query($textquery);
  }
function DeleteNews($newsid)
  {
  $con = Getmysqlcon();
  $wherearray = array(
    "id" => mysql_escape_string($newsid),
  );
  $textquery = ArraytoMYSQL('DELETE', 'news', '', $wherearray);
  $query = mysql_query($textquery);
  }
function GetNews($limit)
  {
  $con = Getmysqlcon();
  $textquery = "SELECT * FROM news ORDER BY dateposted DESC";
  if ($limit != 0){
    $textquery .= " LIMIT ". mysql_escape_string($limit) ."";
  }
  return mysql_query($textquery);
  }
function GetNewsByID($id)
  {
  $con = Getmysqlcon();
  $textquery = "SELECT * FROM news WHERE id = ".mysql_escape_string($id);
  return mysql_query($textquery);
  }

  
// Contact Information
// contact:
//  id    = tinyint(10) AUTOINCREMENT;
//  name  = varchar(20);
//  role  = varchar(40);
//  email = varchar(40);

  
function PostContact($name, $role, $email)
  {
  $con = Getmysqlcon();
  $valuesarray = array(
    "name" => "'".mysql_escape_string($name)."'",
    "role" => "'".mysql_escape_string($role)."'",
    "email" => "'".mysql_escape_string($email)."'",
  );
  $textquery = ArraytoMYSQL('INSERT', 'contact', $valuesarray);
  $query = mysql_query($textquery);
  }
function EditContact($contactid, $name, $role, $email)
  {
  $con = Getmysqlcon();
  $wherearray = array(
    "id" => mysql_escape_string($contactid),
  );
  $valuesarray = array(
    "name" => "'".mysql_escape_string($name)."'",
    "role" => "'".mysql_escape_string($role)."'",
    "email" => "'".mysql_escape_string($email)."'",
  );
  $textquery = ArraytoMYSQL('UPDATE', 'contact', $valuesarray, $wherearray);
  $query = mysql_query($textquery);
  }
function DeleteContact($contactid)
  {
  $con = Getmysqlcon();
  $wherearray = array(
    "id" => mysql_escape_string($contactid),
  );
  $textquery = ArraytoMYSQL('DELETE', 'contact', '', $wherearray);
  $query = mysql_query($textquery);
  }
function GetContacts()
  {
  $con = Getmysqlcon();
  $textquery = "SELECT * FROM contact ORDER BY name ASC";
	return mysql_query($textquery);
  }
function GetContactByID($id)
  {
  $con = Getmysqlcon();
  $textquery = "SELECT * FROM contact WHERE id = " . mysql_escape_string($id);
	return mysql_query($textquery);
  }


// Member Information
// members:
//  id            = int(10) AUTOINCREMENT;
//  verified      = tinyint(1) DEFAULT 1;
//  name          = varchar(100);
//  homephone     = varchar(10);
//  houseaddress  = text();
//  yog           = year(4);
//  email         = varchar(100);
//  type          = enum('Student', 'Teacher', 'Parent', 'Other', 'Alumni') DEFAULT 'Student';
//  cellphone = varchar(10);

#TODO FIX ALL FUNCTIONS TO USE THE NEW ARGUMENTS, AND NEW HELPER FUNCTION

function PostMember($name, $verified, $homephone, $houseaddress, $yog, $email, $type, $cellphone)
  {
  $con = Getmysqlcon();
  $valuesarray = array(
    "name" => "'".mysql_escape_string($name)."'",
    "verified" => mysql_escape_string($verified),
    "homephone" => "'".mysql_escape_string($homephone)."'",
    "houseaddress" => "'".mysql_escape_string($houseaddress)."'",
    "yog" => "'".mysql_escape_string($yog)."'",
    "email" => "'".mysql_escape_string($email)."'",
    "type" => "'".mysql_escape_string($type)."'",
    "cellphone" => "'".mysql_escape_string($cellphone)."'",
  );
  $textquery = ArraytoMYSQL('INSERT', 'members', $valuesarray);
  $query = mysql_query($textquery);
  }
function EditMember($id, $name, $verified, $homephone, $houseaddress, $yog, $email, $type, $cellphone)
  {
  $con = Getmysqlcon();
  $wherearray = array(
    "id" => mysql_escape_string($id),
  );
  $valuesarray = array(
    "name" => "'".mysql_escape_string($name)."'",
    "verified" => mysql_escape_string($verified),
    "homephone" => "'".mysql_escape_string($homephone)."'",
    "houseaddress" => "'".mysql_escape_string($houseaddress)."'",
    "yog" => "'".mysql_escape_string($yog)."'",
    "email" => "'".mysql_escape_string($email)."'",
    "type" => "'".mysql_escape_string($type)."'",
    "cellphone" => "'".mysql_escape_string($cellphone)."'",
  );
  $textquery = ArraytoMYSQL('UPDATE', 'members', $valuesarray, $wherearray);
  $query = mysql_query($textquery);
  
  /*$con = Getmysqlcon();
  #Escape quotes and make it save-safe
  $textquery = "UPDATE members SET name = '".mysql_escape_string($name)."', primaryteam = '".mysql_escape_string($primaryteam)."', cellphone = '".mysql_escape_string($cellphone)."', yog = '".mysql_escape_string($yog)."', email = '".mysql_escape_string($email)."', type = '".mysql_escape_string($type)."' WHERE id = ".mysql_escape_string($id)."";
	$query = mysql_query($textquery);*/
  }
function VerifyMember($id)
  {
  $con = Getmysqlcon();
  $wherearray = array(
    "id" => mysql_escape_string($id),
  );
  $valuesarray = array(
    "verified" => "1",
  );
  $textquery = ArraytoMYSQL('UPDATE', 'members', $valuesarray, $wherearray);
  $query = mysql_query($textquery);
  
  /*$con = Getmysqlcon();
  #Escape quotes and make it save-safe
  $textquery = "UPDATE members SET name = '".mysql_escape_string($name)."', primaryteam = '".mysql_escape_string($primaryteam)."', cellphone = '".mysql_escape_string($cellphone)."', yog = '".mysql_escape_string($yog)."', email = '".mysql_escape_string($email)."', type = '".mysql_escape_string($type)."' WHERE id = ".mysql_escape_string($id)."";
	$query = mysql_query($textquery);*/
  }
function DeleteMember($id)
  {
  $con = Getmysqlcon();
  $wherearray = array(
    "id" => mysql_escape_string($id),
  );
  $textquery = ArraytoMYSQL('DELETE', 'members', '', $wherearray);
  $query = mysql_query($textquery);
  /*
  $con = Getmysqlcon();
  $textquery = "DELETE FROM members WHERE id = ".mysql_escape_string($id)."";
	$query = mysql_query($textquery);*/
  }
function GetMembers()
  {
  $con = Getmysqlcon();
  $textquery = "SELECT * FROM members ORDER BY name ASC";
	return mysql_query($textquery);
  }
function GetVerifiedMembers()
  {
  $con = Getmysqlcon();
  $textquery = "SELECT * FROM members WHERE `verified` = '1' ORDER BY name ASC";
	return mysql_query($textquery);
  }
function GetUnverifiedMembers()
  {
  $con = Getmysqlcon();
  $textquery = "SELECT * FROM members WHERE `verified` = '0' ORDER BY name ASC";
	return mysql_query($textquery);
  }
function GetMemberByID($id)
  {
  $con = Getmysqlcon();
  $textquery = "SELECT * FROM members WHERE id = ".mysql_escape_string($id);
	return mysql_query($textquery);
  }
  

// Resource Information
// resources:
//  id          = int(3) AUTOINCREMENT;
//  name        = varchar(50);
//  description = varchar(100);
//  url         = varchar(200);

function PostResource($name, $description, $url)
  {
  $con = Getmysqlcon();
  $valuesarray = array(
    "name" => "'".mysql_escape_string($name)."'",
    "description" => "'".mysql_escape_string($description)."'",
    "url" => "'".mysql_escape_string($url)."'",
  );
  $textquery = ArraytoMYSQL('INSERT', 'resources', $valuesarray);
  $query = mysql_query($textquery);
  }
function EditResource($id, $name, $description, $url)
  {
  $con = Getmysqlcon();
  $wherearray = array(
    "id" => mysql_escape_string($id),
  );
  $valuesarray = array(
    "name" => "'".mysql_escape_string($name)."'",
    "description" => "'".mysql_escape_string($description)."'",
    "url" => "'".mysql_escape_string($url)."'",
  );
  $textquery = ArraytoMYSQL('UPDATE', 'resources', $valuesarray, $wherearray);
  $query = mysql_query($textquery);
  }
function DeleteResource($id)
  {
  $con = Getmysqlcon();
  $wherearray = array(
    "id" => mysql_escape_string($id),
  );
  $textquery = ArraytoMYSQL('DELETE', 'resources', '', $wherearray);
  $query = mysql_query($textquery);
  }
function GetResources($limit)
  {
  $con = Getmysqlcon();
  $textquery = "SELECT * FROM resources ORDER BY name ASC";
  if ($limit != 0){
    $textquery .= " LIMIT ". mysql_escape_string($limit) ."";
  }
	return mysql_query($textquery);
  }
  
function GetResourceByID($id)
  {
  $con = Getmysqlcon();
  $textquery = "SELECT * FROM resources WHERE id = ".mysql_escape_string($id);
	return mysql_query($textquery);
  }
  
// Sponsors Information
// sponsors:
//  id          = int(11) AUTOINCREMENT;
//  name        = varchar(50);
//  url         = varchar(200);
//  description = varchar(200);
//  order_in_list      = float;

function PostSponsor($name, $description, $url, $order_in_list, $logo)
  {
  $con = Getmysqlcon();
  $valuesarray = array(
    "name" => "'".mysql_escape_string($name)."'",
    "description" => "'".mysql_escape_string($description)."'",
    "url" => "'".mysql_escape_string($url)."'",
    "order_in_list" => "'".mysql_escape_string($order_in_list)."'",
    "logo" => "'".mysql_escape_string($logo)."'",
  );
  $textquery = ArraytoMYSQL('INSERT', 'sponsors', $valuesarray);
  $query = mysql_query($textquery);
  }
function EditSponsor($id, $name, $description, $url, $order_in_list, $logo)
  {
  $con = Getmysqlcon();
  $wherearray = array(
    "id" => mysql_escape_string($id),
  );
  $valuesarray = array(
    "name" => "'".mysql_escape_string($name)."'",
    "description" => "'".mysql_escape_string($description)."'",
    "url" => "'".mysql_escape_string($url)."'",
    "order_in_list" => "'".mysql_escape_string($order_in_list)."'",
    "logo" => "'".mysql_escape_string($logo)."'",
  );
  $textquery = ArraytoMYSQL('UPDATE', 'sponsors', $valuesarray, $wherearray);
  $query = mysql_query($textquery);
  }
function DeleteSponsor($id)
  {
  $con = Getmysqlcon();
  $wherearray = array(
    "id" => mysql_escape_string($id),
  );
  $textquery = ArraytoMYSQL('DELETE', 'sponsors', '', $wherearray);
  $query = mysql_query($textquery);
  }
function GetSponsors($limit)
  {
  $con = Getmysqlcon();
  $textquery = "SELECT * FROM sponsors ORDER BY order_in_list DESC";
  if ($limit != 0){
    $textquery .= " LIMIT ". mysql_escape_string($limit) ."";
  }
	return mysql_query($textquery);
  }
function GetSponsorByID($id)
  {
  $con = Getmysqlcon();
  $textquery = "SELECT * FROM sponsors WHERE id = ".$id;
	return mysql_query($textquery);
  }

?>
