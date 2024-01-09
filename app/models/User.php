<?php
class User {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Register user
    public function register($data){
        $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');
        // Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute
        return $this->db->execute();
    }

    // Login user
    public function login($email, $password){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row) {
            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                return $row;
            }
        }

        return false;
    }

    // Find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        // Bind value
        $this->db->bind(':email', $email);

        // Get a single row
        $row = $this->db->single();

        // Check if a user was found
        return ($row) ? true : false;
    }
}
