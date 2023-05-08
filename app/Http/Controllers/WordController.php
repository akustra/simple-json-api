<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function index()
    {
        $words = Word::select('id', 'pl', 'en', 'it')->get();

        $data = [
            "data" => $words,
            "meta" => [
                "count" => count($words)
            ]
        ];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $request->only('pl', 'en', 'it');

        // don't add existing word
        $exists = Word::where('pl', $data['pl'])->first();
        if ($exists != null) {
            return response()->json([
                "errors" => [
                    [
                        "code" => 406,
                        "message" => "Record exists"
                    ]
                ]
            ], 406);
        }

        Word::create($data);

        $meta = [
            "meta" => [
                "message" => "Record created"
            ]
        ];

        $isEnProvided = array_key_exists('en', $data);
        $isItProvided = array_key_exists('it', $data);

        if (!$isEnProvided) {
            $meta['meta']['tip'][] = 'English translation not provided';
        }
        if (!$isItProvided) {
            $meta['meta']['tip'][] = 'Italian translation not provided';
        }

        return response()->json($meta, 201);
    }

    public function show(Request $request, int $id)
    {
        $word = Word::select('id', 'pl', 'en', 'it')->find($id);

        if ($word == null) {
            return response()->json([
                "errors" => [
                    [
                        "code" => 404,
                        "message" => "Record doesn't exist"
                    ]
                ]
            ], 404);
        }

        return response()->json([
            "data" => [
                $word
            ],
            "meta" => [
                "count" => 1
            ]
        ]);
    }

    public function translate(Request $request)
    {
        $data = $request->only('pl', 'en', 'it');

        $word = null;
        
        if(array_key_exists('pl', $data)) {
            $word = Word::select('id', 'en', 'it')->where('pl', $data['pl'])->first();
        }

        if(array_key_exists('en', $data)) {
            $word = Word::select('id', 'pl', 'it')->where('en', $data['en'])->first();
        }

        if(array_key_exists('it', $data)) {
            $word = Word::select('id', 'en', 'pl')->where('it', $data['it'])->first();
        }

        if ($word == null) {
            return response()->json([
                "errors" => [
                    [
                        "code" => 404,
                        "message" => "No translation"
                    ]
                ]
            ], 404);
        }

        return response()->json([
            "data" => [
                $word
            ],
            "meta" => [
                "count" => 1
            ]
        ]);


        
    }
}
