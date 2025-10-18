<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@hotwired/turbo' => [
        'version' => '7.3.0',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    '@floating-ui/dom' => [
        'version' => '1.7.4',
    ],
    'bootstrap' => [
        'version' => '5.3.8',
    ],
    'masonry-layout' => [
        'version' => '4.2.2',
    ],
    'outlayer' => [
        'version' => '2.1.1',
    ],
    'get-size' => [
        'version' => '2.0.3',
    ],
    'ev-emitter' => [
        'version' => '1.1.0',
    ],
    'fizzy-ui-utils' => [
        'version' => '2.0.5',
    ],
    'desandro-matches-selector' => [
        'version' => '2.0.2',
    ],
    '@floating-ui/core' => [
        'version' => '1.7.3',
    ],
    '@floating-ui/utils' => [
        'version' => '0.2.10',
    ],
    '@floating-ui/utils/dom' => [
        'version' => '0.2.10',
    ],
];
