<?php

namespace WeatherProductRecommender\Domain\ValueObject;

class WeatherCondition
{
    public readonly string $city;
    private readonly float $temperature;
    public readonly string $weatherType;

    public function __construct(
        string $city,
        float $temperature,
        string $weatherType)
    {
        $this->city = $city;
        $this->temperature = $temperature;
        $this->weatherType = $weatherType;
    }
}