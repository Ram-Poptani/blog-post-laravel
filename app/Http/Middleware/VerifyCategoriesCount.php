<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class VerifyCategoriesCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if ( Category::all()->count() === 0 ) {
            /**
             * Category::all()->count() : uses the method of collection  [brings all data from db server and counts at backend server]
             * Category::count() : uses the query to get the count   [counts on the db server using query]
             */
            if ( Category::count() === 0 ) {
            session()->flash('error', 'Minimum one category must exist to create a post');
            return redirect(route('categories.create'));
        }
        return $next($request);
    }
}