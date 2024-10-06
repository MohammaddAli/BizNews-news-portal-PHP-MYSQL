<?php
require_once "./lib/users.php";
// use MyProject\User;

class validation
{

    public $errors = [];
    public $password = "";


    // public function name($inputName)
    // {
    //     $name = trim($_POST[$inputName]);
    //     if (empty($name) || !isset($name)) {
    //         $this->errors['name'] = "name is requred";
    //     }
    //     return $name;
    // }
    public function name($inputName)
    {
        if (!isset($_POST[$inputName])) {
            $this->errors['name'] = "Name input is missing.";
            return null;
        }
        if (empty($_POST[$inputName])) {
            $this->errors['name'] = "Name is required.";
            return null;
        }

        // if (gettype($_POST[$inputName]) !== "string") {
        //     $this->errors['name'] = "Name must be only letters.";
        //     return null;
        // }
        // if (!ctype_alpha($_POST[$inputName])) {
        //     $this->errors['name'] = "Name must contain only letters.";
        //     return null;
        // }
        $name = trim($_POST[$inputName]);

        $sanitizedName = htmlspecialchars($name);
        return $sanitizedName;
    }
    public function message($inputMessage)
    {
        if (!isset($_POST[$inputMessage])) {
            $this->errors['name'] = "Message input is missing.";
            return null;
        }
        $message = trim($_POST[$inputMessage]);
        if (empty($message)) {
            $this->errors['message'] = "Message is required.";
            return null;
        }
        $sanitizedMessage = htmlspecialchars($message);
        return $sanitizedMessage;
    }
    public function subject($inputSubject)
    {
        if (!isset($_POST[$inputSubject])) {
            $this->errors['subject'] = "subject input is missing.";
            return null;
        }
        $subject = trim($_POST[$inputSubject]);
        if (empty($subject)) {
            $this->errors['subject'] = "subject is required.";
            return null;
        }
        $sanitizedSubject = htmlspecialchars($subject);
        return $sanitizedSubject;
    }

    public function email($inpuEmail)
    {
        $email = trim($_POST[$inpuEmail]);
        $user = new user();
        if (empty($email) || !isset($email)) {
            $this->errors['email'] = "email is requred";
        } else if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            $this->errors['email'] = "not valid email";
        } else if ($user->isUserExists($email) && $_SERVER["REQUEST_URI"] === "register.php") {
            $this->errors['email'] = "this email is already exist please enter another email";
        }
        return $email;
    }
    public function password($inputPassword)
    {
        $this->password = trim($_POST[$inputPassword]);
        if (empty($this->password) || !isset($this->password)) {
            $this->errors['password'] = "password is requred";
        } else if (strlen($this->password) > 20 || strlen($this->password) < 5) {
            $this->errors['password'] = "password length not valid";
        }
        return $this->password;
    }
    public function repassword($inputRepassword)
    {
        $rePassword = trim($_POST[$inputRepassword]);
        if (empty($rePassword) || !isset($rePassword)) {
            $this->errors['repassword'] = "repassword is required";
        } else if (strcmp($this->password, $rePassword) !== 0) {
            $this->errors['repassword'] = "the two passwords are not the same";
        }
    }

    public function imageFile($fileInputName)
    {
        if (isset($_FILES[$fileInputName])) {

            if ($_FILES[$fileInputName]['error'] != 0) {
                $this->errors[$fileInputName] = "the image not uploaded probably";
            }

            $fileName = $_FILES[$fileInputName]['name'];
            $avatarTemp = $_FILES[$fileInputName]['tmp_name'];
            $avatarExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $allowedExt = ["jpg", "jpeg", "png", "webp"];

            if (!in_array($avatarExtension, $allowedExt)) {
                $this->errors[$fileInputName] = "not allowed file extension";
            }

            return $fileName;
        } else {
            $this->errors[$fileInputName] = "please set a profile image";
        }
    }
}
