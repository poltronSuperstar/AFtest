<?php

namespace WeatherProductRecommender\Tests\Domain\ValueObject;

use WeatherProductRecommender\Domain\ValueObject\WeatherCondition;
use PHPUnit\Framework\TestCase;

class WeatherConditionTest extends TestCase
{
    public function testWeatherConditionAttributes()
    {
        $city = 'Paris';
        $temperature = 15.5;

        $weatherCondition = new WeatherCondition($city, $temperature);

        $this->assertEquals($city, $weatherCondition->getCity());
        $this->assertEquals($temperature, $weatherCondition->getTemperature());
    }
}
