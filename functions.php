<?php
function isFull(array $board): bool{
    foreach ($board as $row){
        foreach ($row as $entry){
            if(is_null($entry)){
                return false;
            }
        }
    }
    return true;
}
function validateRow(array $board): array
{
    $coordinatesErrorsRow = [];
    $count = 0;
    foreach ($board as $key => $row) {
        $coordinatesErrorsRow = array_merge($coordinatesErrorsRow, validateLine($row, $count, false));
        $count++;
    }
    return $coordinatesErrorsRow;
}

function validateColumn(array $board): array
{
    $coordinatesErrorsColumn = [];
    $sizeBoard = count($board[0]);
    for ($i = 0; $i < $sizeBoard; $i++) {
        $column = array_column($board, $i);
        $coordinatesErrorsColumn = array_merge($coordinatesErrorsColumn, validateLine($column, $i, true));
    }
    return $coordinatesErrorsColumn;
}

function validateCell(array $board): array
{
    $entryOfValue = [];
    $m = count($board);
    $n = count($board[0]);
    for ($i = 0; $i < $m; $i += 3) {
        for ($j = 0; $j < $n; $j += 3) {
            $row = [];
            //$i=3;$j=0;
            for ($r = $j; $r < $j + 3; $r++) {
                for ($c = $i; $c < $i + 3; $c++) {
                    $row[] = $board[$r][$c];
                }
            }
            $entryOfValue = array_merge($entryOfValue, validateLineFromCell($row, $i, $j));
            //return $entryOfValue;

        }
    }
    return $entryOfValue;
}

function validateLineFromCell(array $row, int $i, int $j): array
{
    $temporalCoordinatesErrors = [];
    $analyzedNumbers = [];
    foreach ($row as $entryRow) {
        if (isset($entryRow)) {
            $entryOfValue = array_keys($row, $entryRow);
            if (count($entryOfValue) >= 2 && !in_array($entryRow, $analyzedNumbers)) {
                $analyzedNumbers[] = $entryRow;
                //echo json_encode($entryOfValue,JSON_PRETTY_PRINT),PHP_EOL,json_encode($row,JSON_PRETTY_PRINT);
                foreach ($entryOfValue as $coordinate) {
                    $factor = $coordinate / 3;
                    //echo "coordenada es $coordinate y el factor es $factor",PHP_EOL;
                    //echo $coordinate + $i - 3 * floor($factor);
                    $temporalCoordinatesErrors[] = ['x' =>  $j + floor($factor), 'y' => $coordinate + $i - 3 * floor($factor)];
                }
            }
        }
    }
    return $temporalCoordinatesErrors;
}

function validateLine(array $row, int $k, bool $isColumn): array
{
    $temporalCoordinatesErrors = [];
    $analyzedNumbers = [];
    foreach ($row as $entryRow) {
        if (isset($entryRow)) {
            $entryOfValue = array_keys($row, $entryRow);
            if (count($entryOfValue) >= 2 && !in_array($entryRow, $analyzedNumbers)) {
                $analyzedNumbers[] = $entryRow;
                if ($isColumn) {
                    foreach ($entryOfValue as $coordinate) {
                        $temporalCoordinatesErrors[] = array('x' => $coordinate, 'y' => $k);
                    }
                } else {
                    foreach ($entryOfValue as $coordinate) {
                        $temporalCoordinatesErrors[] = array('x' => $k, 'y' => $coordinate);
                    }
                }
            }
        }
    }
    return $temporalCoordinatesErrors;

}

