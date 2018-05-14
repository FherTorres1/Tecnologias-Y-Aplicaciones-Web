<?php
	class Usuario
	{
		public $name = "", $email = "", $gender = "", $comment = "", $website = "";
		public $nameErr="",$emailErr="",$genderErr="",$webSiteErr="";

		function __construct($name,$email,$gender,$comment,$website)
		{
		    $this->name = $name;
			$this->email = $email;
			$this->gender = $gender;
			$this->comment = $comment;
			$this->website = $website;
		}
		public function validate()
		{
			$this->checkName();
			$this->checkEmail();
			$this->checkWebsite();
			$this->checkComment();
			$this->checkGender();
			
		}
		
		function test_input($data) {
    		$data = trim($data);
    		$data = stripslashes($data);
    		$data = htmlspecialchars($data);
    		return $data;
		}
		

		public function checkName()
		{
			if (empty($this->name)) 
			{
        		$this->nameErr="Name is required";
    		} 
    		else 
    		{
        		$this->name = $this->test_input($this->name);
        		if (!preg_match("/^[a-zA-Z ]*$/",$this->name))
        		{
            		$this->nameErr="Only letters and white space allowed";
            		$this->name = "";
        		}
        		
    		}
    		return $this->name;
		}

		public function checkEmail()
		{
			if (empty($this->email)) 
			{
        		$this->emailErr="Email is required";
    		} 
    		else 
    		{
        		$this->email = $this->test_input($this->email);
        		// check if e-mail address is well-formed
        		if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        		{
            		$this->emailErr="Invalid email format";
            		$this->email = "";
            	}

    		}
    		return $this->email;
		}

		public function checkWebsite()
		{
			if (empty($this->website)) 
			{
        		$this->website = "";
    		} 
    		else 
    		{
        		$this->website = $this->test_input($this->website);
        		// check if URL address syntax is valid (this regular expression also allows dashes in the URL)
        		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$this->website)) 
        		{
            		$this->webSiteErr="Invalid URL";
            		$this->website = "";
        		}

    		}
		}

		public function checkComment()
		{
			if (empty($this->comment)) 
			{
       			$this->comment = "";
    		}
    		else 
    		{
        		$this->omment = $this->test_input($_POST["comment"]);
    		}
		}

		public function checkGender()
		{
			if (empty($this->gender)) {
        		$this->genderErr="Gender is required";
    		} else {
        		$this->gender = $this->test_input($this->gender);
    		}

    		return $this->gender;
		}
		
		

		public function showValues()
		{
			echo "<h2>Your Input:</h2>";
			echo $this->name;
			echo "<br>";
			echo $this->email;
			echo "<br>";
			echo $this->website;
			echo "<br>";
			echo $this->comment;
			echo "<br>";
			echo $this->gender;
		}
	}
?>