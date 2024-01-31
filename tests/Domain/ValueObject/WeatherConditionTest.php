<?php

namespace WeatherProductRecommender\Tests\Domain\ValueObject;

use WeatherProductRecommender\Domain\ValueObject;
use PHPUnit\Framework\TestCase;

class WeatherConditionTest extends TestCase
{
    public function testWeatherConditionAttributes()
    {
        $city = 'Paris';
        $temperature = 5.5;
        $weatherType = 'hot';

        // WeatherCondition being a value Object, mapping temperatur => cold|mild|hot correctly is not its responsibility
        // Therefore it should comply with that

        $weatherCondition = new WeatherCondition($city, $temperature, $weatherType); 

        $this->assertEquals($city, $weatherCondition->city);
        $this->assertEquals($temperature, $weatherCondition->temperature);
        $this->assertEquals($temperature, $weatherCondition->weatherType, $weatherType);

    }
}
