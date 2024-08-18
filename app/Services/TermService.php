<?php

namespace App\Services;

use App\Models\Term;

class TermService
{
    public function getAllTerms()
    {
        return Term::all();
    }

    public function createTerm($data)
    {
        return Term::create($data);
    }

    public function getTermById($id)
    {
        return Term::findOrFail($id);
    }

    public function updateTerm($id, $data)
    {
        $term = Term::findOrFail($id);
        $term->update($data);
        return $term;
    }

    public function deleteTerm($id)
    {
        $term = Term::findOrFail($id);
        $term->delete();
    }
}

