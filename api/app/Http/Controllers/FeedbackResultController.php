<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackResultsRequests\StoreFeedbackResultRequest;
use App\Http\Requests\FeedbackResultsRequests\UpdateFeedBackResultRequest;
use App\Models\DishChoice;
use App\Models\FeedbackResult;
use Illuminate\Http\Request;

class FeedbackResultController extends Controller
{
    public function index()
    {
        return FeedbackResult::all()->toResourceCollection();
    }

    public function show(FeedbackResult $feedbackResult)
    {
        return $feedbackResult->toResource();
    }

    public function store(StoreFeedbackResultRequest $request, DishChoice $dishChoice)
    {
        FeedbackResult::create([
            'comment' => $request->comment,
            'rating' => $request->rating,
            'dish_choice_id' => $dishChoice,
        ]);

        return response()->noContent();
    }

    public function update(UpdateFeedBackResultRequest  $request, FeedbackResult $feedbackResult)
    {
        $feedbackResult->update($request->only(['comment', 'rating']));

        return response()->noContent();
    }

    public function destroy(FeedbackResult $feedbackResult)
    {
        $feedbackResult->delete();

        return response()->noContent();
    }
}
