<?php


namespace App\Services\Global;


class FilterService
{



    public function filterOrganizations($query, $request)
    {
        if ($request->filled('word') && !$request->filled('city_ids') && !$request->filled('country_ids')) {
            $query->where('name', 'like', '%' . $request->word . '%');
        }

        if ($request->filled('city_ids') && !$request->filled('word') && !$request->filled('country_ids')) {
            $query->orWhereIn('city_id', $request->city_ids);
        }

        if ($request->filled('country_ids') && !$request->filled('word') && !$request->filled('city_ids')) {
            $query->orWhereIn('country_id', $request->country_ids);
        }

        if ($request->filled(['city_ids', 'word']) && !$request->filled('country_ids')) {
            $query->orWhere(function ($q) use ($request) {
                $q->whereIn('city_id', $request->city_ids)
                    ->where('name', 'like', '%' . $request->word . '%');
            });
        }

        if ($request->filled(['country_ids', 'word']) && !$request->filled('city_ids')) {
            $query->orWhere(function ($q) use ($request) {
                $q->whereIn('country_id', $request->country_ids)
                    ->where('name', 'like', '%' . $request->word . '%');
            });
        }

        if ($request->filled(['country_ids', 'city_ids']) && !$request->filled('word')) {
            $query->orWhere(function ($q) use ($request) {
                $q->whereIn('country_id', $request->country_ids)
                    ->whereIn('city_id', $request->city_ids);
            });
        }

        if ($request->filled(['country_ids', 'city_ids', 'word'])) {
            $query->orWhere(function ($q) use ($request) {
                $q->whereIn('country_id', $request->country_ids)
                    ->whereIn('city_id', $request->city_ids)
                    ->where('name', 'like', '%' . $request->word . '%');
            });
        }
    }

    public function filterCities($request, $query)
    {

        $query->when($request->has('word') && !$request->has('country_id'), function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->word . '%');
        })
            ->when($request->has('country_id') && !$request->has('word'), function ($q) use ($request) {
                $q->where('country_id', $request->country_id);
            })
            ->when($request->has('word') && $request->has('country_id'), function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->word . '%')
                    ->where('country_id', $request->country_id);
            });
    }


    public function filterStages($request, $query)
    {
        
        $query->when($request->has('word') && !$request->has('curriculum_id'), function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->word . '%');
        })
            ->when($request->has('curriculum_id') && !$request->has('word'), function ($q) use ($request) {
                $q->where('curriculum_id', $request->curriculum_id);
            })
            ->when($request->has('word') && $request->has('curriculum_id'), function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->word . '%')
                    ->where('curriculum_id', $request->curriculum_id);
            });
    }
}
