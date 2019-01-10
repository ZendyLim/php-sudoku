<?php

namespace App\Http\Controllers;

use App\Helpers\SudokuHelpers;
use App\Puzzle;
use Illuminate\Http\Request;

class PuzzleController extends Controller
{
  public function checkSolvableAndSave(Request $request)
  {
    $board = json_decode($request->get('board'));

    $errors = SudokuHelpers::isSolvable($board);

    if (sizeof($errors) < 1) {
      $puzzle = Puzzle::create([
        'puzzle' => $request->get('board')
      ]);

      return response()->json([
        'success' => true,
        'id' => $puzzle->id
      ]);
    }

    return response()->json([
      'success' => false,
      'errors' => $errors
    ]);
  }

  public function getPuzzles()
  {
    $puzzles = Puzzle::all();

    return response()->json($puzzles);
  }

  public function getPuzzle($id)
  {
    $puzzle = Puzzle::findOrFail($id);

    return response()->json($puzzle);
  }

  public function checkSolved(Request $request)
  {
    $board = json_decode($request->get('board'));

    $errors = SudokuHelpers::isSolved($board);

    if (sizeof($errors) < 1) {
      $puzzle = Puzzle::create([
        'puzzle' => $request->get('board')
      ]);

      return response()->json([
        'success' => true,
        'id' => $puzzle->id
      ]);
    }

    return response()->json([
      'success' => false,
      'errors' => $errors
    ]);
  }

  public function solvePuzzle(Request $request)
  {
    $board = json_decode($request->get('board'));

    SudokuHelpers::solve($board);

    return response()->json($board);
  }
}
