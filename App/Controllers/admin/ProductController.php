<?php

use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    public function getAllUsers()
    {
        // Your code to fetch all user data from the database
    }
    // Function to show user data from the database
    public function show($userId)
    {
        // Your code to fetch user data from the database based on the $userId
    }

    // Function to create a new user in the database
    public function create($userData)
    {
        // Your code to insert $userData into the database
    }

    // Function to edit an existing user in the database
    public function edit($userId, $newUserData)
    {
        // Your code to update the user data in the database based on $userId with $newUserData
    }
    public function delete($userId)
    {
        // Your code to delete the user from the database based on $userId
    }
}

?>
// Function to delete a user from the database


// Function to retrieve all users from the database