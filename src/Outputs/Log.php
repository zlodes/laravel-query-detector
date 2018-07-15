<?php

namespace BeyondCode\QueryDetector\Outputs;

use Log as LaravelLog;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class Log implements Output
{
    public function output(Collection $detectedQueries, Response $response)
    {
        LaravelLog::info('Detected N+1 Query');
        foreach ($detectedQueries as $detectedQuery) {
            LaravelLog::info('Model: '.$detectedQuery['model']);
            LaravelLog::info('Relation: '.$detectedQuery['relation']);
            LaravelLog::info('Num-Called: '.$detectedQuery['count']);

            LaravelLog::info('Call-Stack:');

            foreach ($detectedQuery['sources'] as $source) {
                LaravelLog::info('#'.$source->index.' '.$source->name.':'.$source->line);
            }
        }
    }
}