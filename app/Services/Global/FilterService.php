<?php


namespace App\Services\Global;


class FilterService
{

    public function filterAdmins($query, $request)
    {

        $query->when($request->has('word') && !empty($request->word), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->word . '%');
        });
    }

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

        $query->when($request->has('word'), function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->word . '%');
        })
            ->when($request->has('country_id'), function ($q) use ($request) {
                $q->where('country_id', $request->country_id);
            });
    }


    public function filterStages($request, $query)
    {

        $query->when($request->has('word'), function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->word . '%');
        })
            ->when($request->has('curriculum_id'), function ($q) use ($request) {
                $q->where('curriculum_id', $request->curriculum_id);
            });
    }

    public function filterMainSession($request, $query)
    {

        $query->when($request->has('word'), function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->word . '%');
        })
            ->when($request->has('stage_id'), function ($q) use ($request) {
                $q->where('stage_id', $request->stage_id);
            });
    }
    public function filterGroup($request, $query)
    {
        //THIS'S FOR SEARCH IF NEED FILTER USE OR WHERE
        $query->when($request->has('word'), function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->word . '%');
        })
            ->when($request->has('course_id'), function ($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
    }

    public function filterSessionType($request, $query)
    {

        $query->when($request->has('word'), function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->word . '%');
        });
    }

    public function filterYear($request, $query)
    {

        $query->when($request->has('word'), function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->word . '%');
        })
            ->when($request->has('country_id'), function ($q) use ($request) {
                $q->where('country_id', $request->country_id);
            });
    }

    public function filterSeason($request, $query)
    {

        $query->when($request->has('word'), function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->word . '%');
        })
            ->when($request->has('country_id'), function ($q) use ($request) {
                $q->where('country_id', $request->country_id);
            });
    }


    public function filterCourse($request, $query)
    {
        // Filter by word
        $query->when($request->has('word'), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->word . '%');
        });

        // Filter by year_ids
        $query->when($request->has('year_ids'), function ($q) use ($request) {
            $q->whereIn('year_id', $request->year_ids);
        });

        // Filter by cirruculum_ids
        $query->when($request->has('cirruculum_ids'), function ($q) use ($request) {
            $q->whereIn('curriculum_id', $request->cirruculum_ids);
        });
    }

    public function filterDay($request, $query)
    {

        $query->when($request->has('word'), function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->word . '%');
        });
    }

    public function filterStage($request, $query)
    {
        $query->when($request->has('word'), function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->word . '%');
        })
            ->when($request->has('course_id'), function ($q) use ($request) {
                $q->whereHas('courses', function ($q) use ($request) {
                    $q->where('courses.id', $request->course_id);
                });
            })
            ->when($request->has('word'), function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->word . '%')
                    ->whereHas('courses', function ($q) use ($request) {
                        $q->where('courses.id', $request->course_id);
                    });
            })
            ->when($request->has('group_id'), function ($q) use ($request) {
                $q->whereHas('groups', function ($q) use ($request) {
                    $q->where('groups.id', $request->course_id);
                });
            })
            ->when($request->has('group_id'), function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->word . '%')
                    ->whereHas('groups', function ($q) use ($request) {
                        $q->where('groups.id', $request->group_id);
                    });
            })
        ;
    }

    public function filterSessions($request, $query)
    {
        // DRY
        $query
            ->when($request->has('word') && !empty($request->word), function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->word . '%');
            })

            ->when($request->has('course_id') && !empty($request->course_id), function ($q) use ($request) {
                $q->whereHas('courses', function ($q) use ($request) {
                    $q->where('courses.id', $request->course_id);
                });
            })

            ->when($request->has('group_id') && !empty($request->group_id), function ($q) use ($request) {
                $q->whereHas('groups', function ($q) use ($request) {
                    $q->where('groups.id', $request->group_id);
                });
            })
            ->when($request->has('stage_id') && !empty($request->stage_id), function ($q) use ($request) {
                $q->where('stage_id', $request->stage_id);
            })
            ->when($request->has('with_subscription') && !empty($request->with_subscription) && $request->with_subscription == 1, function ($group_q) use ($request) {
                // dd(auth()->user()->id);
                return $group_q->whereHas('groups', function ($subscripe_users_q) use ($request) {
                    $subscripe_users_q->whereHas('subscripe_users', function ($user_q) use ($request) {
                        return $user_q->where('user_id', auth()->user()->id);
                        // dd(auth()->user()->id);
                    });
                });
            })

        ;
    }
}
