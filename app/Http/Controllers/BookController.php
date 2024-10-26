<?php

namespace App\Http\Controllers;

use App\Exceptions\Api\ApiException;
use App\Http\Resources\Api\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function index() {
        $books = Book::all();
        return response()->json($books)->setStatusCode(200);
    }

    public function show($id) {
        $book = Book::findOrFail($id);

        return response()->json(new BookResource($book))->setStatusCode(200);
    }
    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author_id' => 'required|exists:authors,id',
                'description' => 'required|string|max:255',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('images', 'public');
            }

            $book = Book::create([...$validated, 'photo' => $path]);
            return response()->json($book)->setStatusCode(201);
        } catch (ValidationException $validationException) {
            throw new ApiException('Ошибка валидации данных', 422, $validationException->errors());
        }
    }
    public function update(Request $request, $id) {
        try {
            $book = Book::findOrFail($id);

            $validated = $request->validate([
                'title' => 'nullable|string|max:255',
                'author_id' => 'nullable|exists:authors,id',
                'description' => 'nullable|string|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('photo')) {
                if ($book->photo) {
                    Storage::disk('public')->delete($book->photo);

                }
                $path = $request->file('photo')->store('images', 'public');
                $validated['photo'] = $path;
            }

            $book->update($validated);

            return response()->json($book)->setStatusCode(201);
        }
        catch (ValidationException $validationException) {
            throw new ApiException('Ошибка валидации данных', 422, $validationException->errors());
        }
    }

    public function destroy($id) {
        $book = Book::findOrFail($id);
        if ($book->photo) {
            Storage::disk('public')->delete($book->photo);
        }
        $book->delete();
        return response()->json(null, 204);
    }
}
