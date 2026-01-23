<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;   // Required to create login accounts
use App\Models\Author; // Required to create Author profiles
use Illuminate\Support\Facades\Hash; // Required to secure passwords

class TP6Controller extends Controller
{
    // Task 3.1: Create author and user account
    public function createAuthor(Request $request)
    {
        // 1. Create the User (The login account)
        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->user_name . '@example.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Create the Author (The profile linked to the user)
        $author = Author::create([
            'name' => $request->author_name,
            'user_id' => $user->id
        ]);

        return response()->json([
            'message' => 'Author and User created successfully',
            'author' => $author
        ], 201);
    }
// Task 3.2: Create article for specific author
    public function createArticle(Request $request)
    {
        $article = \App\Models\Article::create([
            'name' => $request->article_name, // e.g., "Laravel Basics"
            'author_id' => $request->author_id // The ID of Sok, Sao, or Dara
        ]);

        return response()->json(['message' => 'Article created successfully', 'data' => $article], 201);
    }
// Task 3.3: Create multiple audiences
    public function createAudience(Request $request)
    {
        // 1. Create a User for this audience member
        $user = \App\Models\User::create([
            'name' => $request->user_name,
            'email' => $request->user_name . '@reader.com',
            'password' => \Illuminate\Support\Facades\Hash::make('reader123'),
        ]);

        // 2. Link this user to an Article as an Audience member
        $audience = \App\Models\Audience::create([
            'name' => $request->audience_display_name, // e.g., "Fan Number 1"
            'user_id' => $user->id,
            'article_id' => $request->article_id
        ]);

        return response()->json(['message' => 'Audience created', 'data' => $audience], 201);
    }
// Task 5: Add a polymorphic comment to an Article or Audience
    public function addComment(Request $request)
    {
        $comment = \App\Models\Comment::create([
            'body' => $request->body,
            'commentable_id' => $request->id,
            // 'type' should be 'App\Models\Article' or 'App\Models\Audience'
            'commentable_type' => $request->type, 
        ]);

        return response()->json([
            'message' => 'Comment added successfully',
            'data' => $comment
        ], 201);
    }

}
