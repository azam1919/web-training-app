<?php

use App\Models\PaperTitle;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

function employee_today_quiz()
{
    $current_date = date("Y-m-d");
    $e_id = Session::get('e_id');
    $papers = PaperTitle::whereHas('paper_participants', function ($query) use ($e_id) {
        $query->where('e_id', '=', $e_id);
    })->with('paper_participants')->get();
    $today_papers = PaperTitle::whereHas('paper_participants', function ($query) use ($e_id) {
        $query->where('e_id', '=', $e_id);
        $query->where('status_end', '=', '');
    })->with('paper_participants')->whereRaw('? between current_date AND target_date', $current_date)->get();
    $today_papers_count = $today_papers->count();
    $papers_count = $papers->count();
    View::share(['papers' => $papers, 'papers_count' => $papers_count, 'today_papers_count' => $today_papers_count, 'today_papers' => $today_papers]);
}
