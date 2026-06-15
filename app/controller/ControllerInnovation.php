<?php

class ControllerInnovation extends Controller
{
    public static function data(): void
    {
        self::render('innovation/viewData', [
            'stats' => ModelStatistique::dashboard(),
        ], 'Innovation data');
    }

    public static function mvc(): void
    {
        self::render('innovation/viewMvc', [], 'Innovation MVC');
    }
}
