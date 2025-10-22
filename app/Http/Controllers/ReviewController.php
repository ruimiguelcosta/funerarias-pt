<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\FuneralHome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'funeral_home_id' => 'required|exists:funeral_homes,id',
            'rating' => 'required|integer|min:1|max:5',
            'author_name' => 'required|string|max:255',
            'comment' => 'required|string|max:1000',
        ]);

        DB::transaction(function () use ($request) {
            // Create the review
            $review = Review::create([
                'funeral_home_id' => $request->funeral_home_id,
                'rating' => $request->rating,
                'author_name' => $request->author_name,
                'text' => $request->comment,
                'published_at' => now(),
            ]);

            // Update funeral home statistics
            $funeralHome = FuneralHome::find($request->funeral_home_id);
            $reviews = Review::where('funeral_home_id', $request->funeral_home_id)->get();
            
            $funeralHome->update([
                'reviews_count' => $reviews->count(),
                'total_score' => $reviews->avg('rating'),
            ]);
        });

        return redirect()->back()->with('success', 'A sua avaliação foi enviada com sucesso! Obrigado pelo seu feedback.');
    }
}
