Zoop maggott-module
===================

[![Build Status](https://secure.travis-ci.org/zoopcommerce/maggott-module.png)](http://travis-ci.org/zoopcommerce/maggott-module)

A simple zend framework 2 module to return exceptions as json in accordance with the <a href="http://tools.ietf.org/html/draft-nottingham-http-problem-02">application/api-problem+json</a> standard.

Install
-------

Add the following to your composer root:

    "require": {
        "zoopcommerce/maggott-module" : "~1.1"
    }

Add the module to your application config:

    'modules' => [
        'Zoop\MaggottModule'
    ],

Configuration
-------------

Any exceptions that you want returned as json need to be configured in the `exception_map` config key.

Eg:

    'zoop' => [
        'maggott' => [
            'exception_map' => [
                'Zoop\ShardModule\Exception\AccessControlException' => [
                    'described_by' => 'access-control-exception',
                    'title' => 'Access denied',
                    'status_code' => 403,
                    'extra_fields' => ['action'],
                    'restricted_extra_fields' => ['documentClass']
                ]
            ]
        ],
    ]

The `exception_map` is an array of configured exceptions. The key for each item in the array must be the FQCN of the exception. All fields to configure an exception are optional. They are:

described_by
------------
If this field is supplied, the returned exception will have a `described_by` field which points to a resource where more information about the exception can be found in human readable format.

If using the `described_by` field, you should also create a view model template called `zoop/maggott/<described_by>` that hold the extra human readable inforamtion.

title
-----
The title of the exception

status_code
-----------
The http status code should the json response be set to. Defaults to 500, but also observes the status code in the response.

extra_fields
----------------
Other properties of the exception that should always be included in the json response.

restricted_extra_fields
---------------------------
Other properties of the exception that should only be included in the json response if `displayExceptions` is set to `true`.
