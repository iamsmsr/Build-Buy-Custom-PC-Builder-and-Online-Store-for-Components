<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Review;
use App\Models\Poll;

class Ecommerce2Controller extends Controller
{
    public function showDetails($id)
    {
// For now, just return a view with the component ID
        return view('ecommerce.component-details', ['componentId' => $id]);
    }

    public function getComponentById($id)
    {
        $component = Component::find($id);

        if (!$component) {
            return redirect()->back()->with('error', 'Component not found!');
        }

        // Determine availability status
        $component->status = $component->quantity > 0 ? 'Available' : 'Out of Stock';

        // Fetch reviews where type is 'comment' and product_id matches
        $reviews = Review::where('product_id', $id)
            ->where('review_type', 'comment')
            ->select('comment', 'user_id', 'star') // Keep selecting the necessary fields
            ->get();

        // For each review, get the user name
        foreach ($reviews as $review) {
            $review->user_name = User::find($review->user_id)->name; // Fetch the user's name using user_id
        }

        // Pass the component and reviews to the view
        return view('ecommerce.component-details', compact('component', 'reviews'));
    }



    public function addReview(Request $request, $id)
    {
        // Check if the user is logged in (not 'Annonymous')
        $userName = session('user_name', 'Annonymous');
        if ($userName === 'Annonymous') {
            return redirect()->back()->with('error', 'You need to sign in or sign up to submit a review.');
        }

        // Validate the input
        $validated = $request->validate([
            'comment' => 'required|string|max:1000', // Validation for the comment
            'type' => 'required|in:comment,complaint,request', // Validation for review type
            'stars' => 'required|integer|min:1|max:5', // Stars field now required
        ]);

        // Find the user ID using the username in the session
        $userId = User::where('name', $userName)->value('id');

        // Save the review to the database
        Review::create([
            'user_id' => $userId,               // User ID from session
            'product_id' => $id,                 // Product ID passed from the route
            'comment' => $validated['comment'],  // The actual comment entered by the user
            'review_type' => $validated['type'],// The type of review (comment, complaint, or request)
            'star' => $validated['stars'],     // Rating stars (1-5)
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your feedback has been submitted.');
    }


    public function showPolls()
    {
        // Fetch active polls from the database
        $polls = Poll::getActivePolls();

        // Pass the polls to the view
        return view('ecommerce.ecommerce', compact('polls'));
    }

    public function vote(Request $request, $poll_id)
    {
        // Check if the user is logged in
        if (session('user_name', 'Annonymous') === 'Annonymous') {
            return redirect()->back()->with('error', 'You need to log in to vote.');
        }

        // Validate the request
        $validated = $request->validate([
            'poll_option' => 'required|in:1,2,3,4',
        ]);

        // Find the poll and update the vote count
        $poll = Poll::findOrFail($poll_id);

        // Increment the selected option's vote count
        $option = 'vote_count' . $validated['poll_option'];
        $poll->$option += 1;
        $poll->save();

        return redirect()->back()->with('success', 'Thank you for voting!');
    }










}
