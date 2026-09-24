<?php

namespace App\Http\Controllers\Staff;

use App\Models\RatingUlasan;
use Illuminate\View\View;

class ReviewController extends StaffController
{
    public function index(): View
    {
        return $this->staffView('staff.reviews.index', [
            'reviews' => RatingUlasan::with(['user', 'transaction.layanan'])
                ->latest('created_at')
                ->latest('id')
                ->paginate(12),
            'averageRating' => (float) RatingUlasan::avg('bintang'),
            'totalReviews' => RatingUlasan::count(),
        ]);
    }
}
