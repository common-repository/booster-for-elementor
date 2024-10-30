<?php 
//Booster Addons Extensions Bundle
if (!defined('ABSPATH')) exit; 

class ELB_Extensions_Bundle_Free{
    
    public static function get_all_extensions(){
        return [
            [
                'name' => 'Background Parallax',
                'id' => 'background',
                'type' => 'freemium',
            ],
            [
                'name' => 'Animated Gradient',
                'id' => 'animatedgradient',
                'type' => 'freemium',
            ],
            [
                'name' => 'Reading Progress',
                'id' => 'readingprogress',
                'type' => 'freemium',
            ],
            [
                'name' => 'Elements Parallax Scroll',
                'id' => 'elemparallaxscroll',
                'type' => 'premium',
            ],
            [
                'name' => 'Advanced Tooltip',
                'id' => 'advancedtooltip',
                'type' => 'premium',
            ],/*
            [
                'name' => 'Protected Area',
                'id' => 'protectedarea',
                'type' => 'premium',
            ],*/
            [
                'name' => 'Particle Effects',
                'id' => 'particleeffects',
                'type' => 'premium',
            ],
            [
                'name' => 'Advanced Backgrounds',
                'id' => 'advancedbackgrounds',
                'type' => 'premium',
            ],
            [
                'name' => 'Background Objects Decoration',
                'id' => 'backgroundobjectsdecoration',
                'type' => 'freemium',
            ],
            [
                'name' => 'Element CSS Transform',
                'id' => 'elementcsstransform',
                'type' => 'freemium',
            ],
            [
                'name' => 'Image Shape Mask',
                'id' => 'imageshapemask',
                'type' => 'freemium',
            ],
            [
                'name' => 'Cross Domain Copy Paste',
                'id' => 'crossdomaincopypaste',
                'type' => 'premium',
            ],
            [
                'name' => 'Element Reveal',
                'id' => 'elementreveal',
                'type' => 'freemium',
            ]

        ];
    }
}