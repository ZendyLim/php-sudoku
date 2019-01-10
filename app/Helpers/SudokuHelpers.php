<?php
/**
 * Created by IntelliJ IDEA.
 * User: zendy
 * Date: 1/10/2019
 * Time: 00:18
 */

namespace App\Helpers;


class SudokuHelpers
{
  private static function isValidNumber($number, $allow_null)
  {
    $is_null = is_null($number);

    if ($allow_null) {
      return $number <= 9 && $number > 0;
    }
    return !$is_null && $number <= 9 && $number > 0;
  }

  public static function getSolvedPuzzle($board)
  {
    return $board;
  }

  public static function isValidInSection($board, $row_index, $column_index, $number)
  {
    $rowStart = $row_index - ($row_index % 3);
    $columnStart = $column_index - ($column_index % 3);

    for ($i = $rowStart; $i < $rowStart + 3; $i++) {
      for ($j = $columnStart; $j < $columnStart + 3; $j++) {
        if ($i === $row_index && $j === $column_index) {
          continue;
        }
        if ($board[$i][$j] == $number) {
          return false;
        }
      }
    }

    return true;
  }

  public static function isValidInRow($board, $row_index, $column_index, $number)
  {
    for ($i = 0; $i < 9; $i++) {
      if ($i === $column_index) {
        continue;
      }
      if ($board[$row_index][$i] === $number) {
        return false;
      }
    }

    return true;
  }

  public static function isValidInColumn($board, $row_index, $column_index, $number)
  {
    for ($i = 0; $i < 9; $i++) {
      if ($i === $row_index) {
        continue;
      }
      if ($board[$i][$column_index] === $number) {
        return false;
      }
    }

    return true;
  }

  public static function isValid($board, $row_index, $column_index, $number, $allow_null)
  {
    if (
      !self::isValidNumber($number, $allow_null) ||
      !self::isValidInSection($board, $row_index, $column_index, $number) ||
      !self::isValidInRow($board, $row_index, $column_index, $number) ||
      !self::isValidInColumn($board, $row_index, $column_index, $number)
    ) {
      return false;
    }

    return true;
  }

  public static function isSolved($board)
  {
    $errors = [];

    for ($i = 0; $i < 9; $i++) {
      for ($j = 0; $j < 9; $j++) {
        if (!self::isValid($board, $i, $j, $board[$i][$j], false)) {
          array_push($errors, [$i, $j]);
        }
      }
    }

    return $errors;
  }

  public static function isSolvable($board)
  {
    $errors = [];

    for ($i = 0; $i < 9; $i++) {
      for ($j = 0; $j < 9; $j++) {
        if (is_null($board[$i][$j])) {
          continue;
        }
        if (!self::isValid($board, $i, $j, $board[$i][$j], true)) {
          array_push($errors, [$i, $j]);
        }
      }
    }

    return $errors;
  }
}
