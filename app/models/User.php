<?php
    class User {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        // Register User
        public function register($data)
        {
            $query = 'INSERT INTO users (name, email, password) VALUES(:name, :email, :password)';
            $this->db->query($query);
            // Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Login User
        public function login($email, $password)
        {
            $query = 'SELECT * FROM users WHERE email = :email';
            $this->db->query($query);
            // Bind values
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hased_password = $row->password;
            if (password_verify($password, $hased_password)) {
                return $row;
            } else {
                return false;
            }
        }

        // Forgot password
        public function forgot($email)
        {
            
        }

        // Find user by email
        public function findUserByEmail($email)
        {
            $query = 'SELECT * FROM users WHERE email = :email';
            $this->db->query($query);
            // Bind values
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // Check row
            if ($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        // Get User by ID
        public function getUserById($id)
        {
            $query = 'SELECT * FROM users WHERE id = :id';
            $this->db->query($query);
            // Bind values
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }
    }