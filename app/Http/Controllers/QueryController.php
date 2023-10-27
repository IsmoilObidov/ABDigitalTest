<?php

namespace App\Http\Controllers;

use App\Models\Post;

class QueryController extends Controller
{
    public function slowQuery()
    {
        $startDate = '2023-01-01';
        $endDate = '2024-12-31';

        // Record the start time
        $startTime = microtime(true);

        // Slow query without optimization
        $posts = Post::where('published_at', '>=', $startDate)
            ->where('published_at', '<=', $endDate)
            ->get();

        // Record the end time
        $endTime = microtime(true);

        // Calculate the execution time
        $executionTime = ($endTime - $startTime) * 1000; // in milliseconds

        return response()->json(['data' => $posts, 'execution_time' => $executionTime]);
    }




    /*
        
        Метод chunk в Laravel обеспечивает более быстрый ответ, чем обычные запросы,
        потому что он позволяет обрабатывать данные пакетами (чанками),
        вместо того чтобы загружать все данные сразу.
    
    */

    /*
        
        json_encode(...) может предоставлять оптимизированный вывод JSON без лишних полей или оберток. 
        С другой стороны, response()->json(...) может включать дополнительные метаданные, которые могут увеличить размер ответа.    
    
    */

    /*
    
      !!  все, что указал, по моему мнению и отметил исходя из своего опыта !!
    
    */
    
    public function optimizedQuery()
    {
        $startDate = '2023-01-01';
        $endDate = '2024-12-31';

        $posts =  Post::whereBetween('published_at', [$startDate, $endDate])
            ->chunk(100, function ($posts) use (&$filteredPosts) {
                foreach ($posts as $post) {
                    $filteredPosts[] = $post;
                }
            });

        return json_encode($filteredPosts);
    }
}
