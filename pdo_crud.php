<?php
class Database {
	
	private static $servername = "localhost";
	private static $username = "root";
	private static $password = "123456";
	private static $dbname = "mydb";
	
	public static function connected()
	{
		try {
			$conn = new PDO("mysql:host=".self::$servername.";dbname=".self::$dbname , self::$username, self::$password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		}
		catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
			return null;
		}
	}
	
	public static function selectAll()
	{
		$conn = self::connected();
		$sql = "SELECT * FROM posts";
		$sth = $conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public static function selectSingle($id)
	{
		$conn = self::connected();
		$sql = "SELECT * FROM posts WHERE id = :id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':id',$id);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public static function insertContent($title, $content)
	{
		$conn = self::connected();
		$sql = "INSERT INTO posts (title, content) VALUES (:title, :content)";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':title',$title);
		$sth->bindParam(':content',$content);
		$sth->execute();
		echo "created successfully";
	}
	
	public static function updateContent($id, $title, $content)
	{
		$conn = self::connected();
		$sql = "UPDATE posts SET title=:title, content=:content WHERE id=:id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':id',$id);
		$sth->bindParam(':title',$title);
		$sth->bindParam(':content',$content);
		$sth->execute();
		echo "update successfully";
	}
	
	public static function deleteContent($id)
	{
		$conn = self::connected();
		$sql = "DELETE FROM posts WHERE id = :id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':id',$id);
		$sth->execute();
		echo "delete successfully";
	}
	
}

/*
$s = Database::selectAll();
foreach ($s as $v){
	echo $v['title'];
	echo "<br>";
	echo $v['content'];
}
*/
/*
$s = Database::selectSingle(4);
foreach ($s as $v){
	echo $v['title'];
	echo "<br>";
	echo $v['content'];
}
*/

//Database::insertContent('zxc','asdasdasd');
//Database::updateContent(4,'456456','123456456');
//Database::deleteContent(4);




























