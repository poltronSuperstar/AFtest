<?php

namespace WeatherProductRecommender\Domain\Port;

use WeatherProductRecommender\Domain\ValueObject\WeatherCondition;

interface WeatherFetcherPort
{
    public function fetchWeatherCondition(string $city, string $date): WeatherCondition; // FIXME date shouldn't be a string
}
