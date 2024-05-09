@extends('layouts.frontend')

@section('title')
    Package Plan
@endsection

@section('content')
    <div class="container">
        <div class="pricing-section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="sec-title text-center">
                        <h2>Package Plan</h2>
                        <h6 class="text-muted">({{ $geolocationData['country_name'] }})</h6>
                    </div>
                </div>
            </div>

            <div class="outer-box">
                <div class="row">
                    @foreach ($packagePlan as $data)
                        @php
                            $packageInfo = getPackageInfo($data, $geolocationData);
                            $currency_symbol = $packageInfo['currency_symbol'];
                        @endphp

                        <div class="pricing-block col-lg-4 col-md-4 col-sm-12 wow fadeInUp">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <div class="icon-outer"><i class="{{ $data->icon }}"></i></div>
                                </div>
                                <div class="price-box">
                                    <h4 class="price">{{ $data->package_name }}</h4>
                                </div>

                                <div class="package-price">
                                    <p><i class='fas fa-dot-circle'></i>
                                        {{ $packageInfo['cover_info'] }}
                                        <span>{{ $currency_symbol . $packageInfo['adult_cover'] }}</span>
                                    </p>
                                    @if ($data->package_name !== 'On-Demand')
                                        <p><i class='fas fa-dot-circle'></i> Kid Cover (0-16Y) = <span>{{ $currency_symbol . $packageInfo['kid_cover'] }}</span></p>
                                        <p><i class='fas fa-dot-circle'></i> Family Cover (2Adult+2kids) = <span>{{ $currency_symbol . $packageInfo['family_cover'] }}</span></p>
                                    @endif
                                </div>

                                <ul class="features">
                                    @foreach ($packageFacility as $item)
                                        @php
                                            $status = ($data->{'facility_'.$item->id} == 'active') ? 'true' : 'false';
                                        @endphp
                                        <li class="{{ $status }}">{{ $item->title }}</li>
                                    @endforeach
                                </ul>
                                <div class="btn-box m-4">
                                    <a href="{{ route('buy_selected_package', ['packageId'=> $data->id]) }}" class="theme-btn">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@php
    function getPackageInfo($data, $geolocationData) {
        $info = [];
        if ($geolocationData['country_name'] === 'Australia') {
            if ($data->package_name === 'Basic') {
                $info = ['adult_cover' => 80, 'kid_cover' => 80, 'family_cover' => 200, 'currency_symbol' => 'A$', 'cover_info' => 'Adult Cover (Over 16Y)'];
            } elseif ($data->package_name === 'Premier') {
                $info = ['adult_cover' => 100, 'kid_cover' => 100, 'family_cover' => 250, 'currency_symbol' => 'A$', 'cover_info' => 'Adult Cover (Over 16Y)'];
            } else {
                $info = ['adult_cover' => 65, 'currency_symbol' => 'A$', 'cover_info' => 'Single Appointment'];
            }
        } elseif ($geolocationData['country_name'] === 'United Kingdom') {
            if ($data->package_name === 'Basic') {
                $info = ['adult_cover' => 80, 'kid_cover' => 80, 'family_cover' => 200, 'currency_symbol' => '£', 'cover_info' => 'Adult Cover (Over 16Y)'];
            } elseif ($data->package_name === 'Premier') {
                $info = ['adult_cover' => 100, 'kid_cover' => 100, 'family_cover' => 250, 'currency_symbol' => '£', 'cover_info' => 'Adult Cover (Over 16Y)'];
            } else {
                $info = ['adult_cover' => 35, 'currency_symbol' => '£', 'cover_info' => 'Single Appointment'];
            }
        } else {
            if ($data->package_name === 'Basic') {
                $info = ['adult_cover' => 80, 'kid_cover' => 80, 'family_cover' => 200, 'currency_symbol' => '$', 'cover_info' => 'Adult Cover (Over 16Y)'];
            } elseif ($data->package_name === 'Premier') {
                $info = ['adult_cover' => 100, 'kid_cover' => 100, 'family_cover' => 250, 'currency_symbol' => '$', 'cover_info' => 'Adult Cover (Over 16Y)'];
            } else {
                $info = ['adult_cover' => 42, 'currency_symbol' => '$', 'cover_info' => 'Single Appointment'];
            }
        }
        return $info;
    }
@endphp


<?php

namespace App\Helpers;

class PackageHelper
{
    public static function getPackageInfo($data, $geolocationData)
    {
        $info = [];
        if ($geolocationData['country_name'] === 'Australia') {
            if ($data->package_name === 'Basic') {
                $info = ['adult_cover' => 80, 'kid_cover' => 80, 'family_cover' => 200, 'currency_symbol' => 'A$', 'cover_info' => 'Adult Cover (Over 16Y)'];
            } elseif ($data->package_name === 'Premier') {
                $info = ['adult_cover' => 100, 'kid_cover' => 100, 'family_cover' => 250, 'currency_symbol' => 'A$', 'cover_info' => 'Adult Cover (Over 16Y)'];
            } else {
                $info = ['adult_cover' => 65, 'currency_symbol' => 'A$', 'cover_info' => 'Single Appointment'];
            }
        } elseif ($geolocationData['country_name'] === 'United Kingdom') {
            if ($data->package_name === 'Basic') {
                $info = ['adult_cover' => 80, 'kid_cover' => 80, 'family_cover' => 200, 'currency_symbol' => '£', 'cover_info' => 'Adult Cover (Over 16Y)'];
            } elseif ($data->package_name === 'Premier') {
                $info = ['adult_cover' => 100, 'kid_cover' => 100, 'family_cover' => 250, 'currency_symbol' => '£', 'cover_info' => 'Adult Cover (Over 16Y)'];
            } else {
                $info = ['adult_cover' => 35, 'currency_symbol' => '£', 'cover_info' => 'Single Appointment'];
            }
        } else {
            if ($data->package_name === 'Basic') {
                $info = ['adult_cover' => 80, 'kid_cover' => 80, 'family_cover' => 200, 'currency_symbol' => '$', 'cover_info' => 'Adult Cover (Over 16Y)'];
            } elseif ($data->package_name === 'Premier') {
                $info = ['adult_cover' => 100, 'kid_cover' => 100, 'family_cover' => 250, 'currency_symbol' => '$', 'cover_info' => 'Adult Cover (Over 16Y)'];
            } else {
                $info = ['adult_cover' => 42, 'currency_symbol' => '$', 'cover_info' => 'Single Appointment'];
            }
        }
        return $info;
    }
}

$packageInfo = getPackageInfo($data, $geolocationData);