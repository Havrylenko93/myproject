define({ "api": [
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./doc/main.js",
    "group": "_var_www_html_likulator_docs_facebook_doc_main_js",
    "groupTitle": "_var_www_html_likulator_docs_facebook_doc_main_js",
    "name": ""
  },
  {
    "version": "1.0.0",
    "type": "post",
    "url": "/deleteUser",
    "title": "deleteUser",
    "name": "deleteUser",
    "description": "<p>api deleting user by token</p>",
    "permission": [
      {
        "name": "user_friends,user_likes,user_location,user_photos,user_posts,user_videos,read_custom_friendlists"
      }
    ],
    "group": "facebook",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>fb token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n\"token\" : \"EAACEdEose0cBAEHLJ2ZCuP8iNPcwtZAGyB9yMIoIbKGlR0vS1OBQq4JkVYEZA2whamRlZCla8eVYEEQPfa2WfNRyuAeqqqiYVLk3rhNXQr61lA7FWyfDPv9ZAOJtmSH2lF4SuzjQKlQuGSpIfC7hHFpaDAm0dQjbpX1HYw7AmIGNbXWAViKeU2iKNkEeijN8ZD\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "msg",
            "description": "<p>user was deleted</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Response-Example:",
          "content": "{\n  \"data\": \"user was deleted\",\n  \"errors\": []\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./deleteUser.coffee",
    "groupTitle": "facebook",
    "sampleRequest": [
      {
        "url": "http://ec2-54-229-150-116.eu-west-1.compute.amazonaws.com/api/v1/facebook/deleteUser"
      }
    ]
  },
  {
    "version": "1.0.0",
    "type": "post",
    "url": "/getProfile",
    "title": "getProfile",
    "name": "getProfile",
    "description": "<p>api create or update user data using auth_token</p>",
    "permission": [
      {
        "name": "user_friends,user_likes,user_location,user_photos,user_posts,user_videos,read_custom_friendlists"
      }
    ],
    "group": "facebook",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "badToken",
            "description": "<p>&quot;malformed token&quot; expiresed or incorrect</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>fb auth token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n\"token\" : \"SAACEdEose0cBAEHLJ2ZCuP8iNPcwtZAGyB9yMIoIbKGlR0vS1OBQq4JkVYEZA2whamRlZCla8eVYEEQPfa2WfNRyuAeqqqiYVLk3rhNXQr61lA7FWyfDPv9ZAOJtmSH2lF4SuzjQKlQuGSpIfC7hHFpaDAm0dQjbpX1HYw7AmIGNbXWAViKeU2iKNkEeijN8ZD\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>user name from FB (name and lastname)</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "locationId",
            "description": "<p>city id from FB</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "locationName",
            "description": "<p>city name, country name</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>facebook user id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "avatar_url",
            "description": "<p>avatar_url</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "photo_likes",
            "description": "<p>photo_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "video_likes",
            "description": "<p>video_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "wall_likes",
            "description": "<p>wall_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "total_likes",
            "description": "<p>total_likes</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Response-Example:",
          "content": "{\n    \"data\": {\n        \"name\": \"Sergei Gavrilenko\",\n        \"location\": {\n            \"id\": \"111649395528170\",\n            \"name\": \"Kharkov, Ukraine\"\n        },\n        \"id\": \"411214595914433\",\n        \"avatar_url\": \"https://graph.facebook.com/v2.8/411214595914433/picture\",\n        \"posts_count\": 3,\n        \"photo_count\": 6,\n        \"video_count\": 1,\n        \"likes\": {\n            \"photo_likes\": 2,\n            \"video_likes\": 1,\n            \"wall_likes\": 3,\n            \"total_likes\": 6\n        }\n    },\n    \"errors\": []\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./getProfile.coffee",
    "groupTitle": "facebook",
    "sampleRequest": [
      {
        "url": "http://ec2-54-229-150-116.eu-west-1.compute.amazonaws.com/api/v1/facebook/getProfile"
      }
    ]
  },
  {
    "version": "1.0.0",
    "type": "post",
    "url": "/getUsers/:all/:city/:friends",
    "title": "getUsers",
    "name": "getUsers",
    "description": "<p>get users by city, friends, all</p>",
    "permission": [
      {
        "name": "user_friends,user_likes,user_location,user_photos,user_posts,user_videos,read_custom_friendlists"
      }
    ],
    "group": "facebook",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>fb token</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "offset",
            "description": "<p>offset</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "limit",
            "description": "<p>limit</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n\"offset\" : \"0\",\n  \"limit\" : \"10\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>internal id from db</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "facebook_id",
            "description": "<p>fb user id</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "city_id",
            "description": "<p>fb city id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "avatar_url",
            "description": "<p>avatar url</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>name (first name, last name)</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "photo_likes",
            "description": "<p>photo_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "video_likes",
            "description": "<p>video_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "wall_likes",
            "description": "<p>wall_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "total_likes",
            "description": "<p>total_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "created_ad",
            "description": "<p>created_ad</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "updated_at",
            "description": "<p>updated_at</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Response-Example:",
          "content": "{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"facebook_id\": 1515154,\n            \"city_id\": 1558,\n            \"avatar_url\": \"https://graph.facebook.com/v2.8/411214595914433/picture\",\n            \"name\": \"Ivanov Ivan\",\n            \"last_calculating\": \"2017-04-19 13:14:04\",\n            \"photo_like_count\": 45,\n            \"video_like_count\": 47,\n            \"wall_like_count\": 15,\n            \"total_like_count\": 58,\n            \"created_at\": null,\n            \"updated_at\": null\n        },\n        {\n            \"id\": 3,\n            \"facebook_id\": 411214595914433,\n            \"city_id\": 211649395528170,\n            \"avatar_url\": \"https://graph.facebook.com/v2.8/411214595914433/picture\",\n            \"name\": \"Sergei Gavrilenko\",\n            \"last_calculating\": \"2017-04-24 16:20:36\",\n            \"photo_like_count\": 2,\n            \"video_like_count\": 1,\n            \"wall_like_count\": 3,\n            \"total_like_count\": 6,\n            \"created_at\": \"2017-04-19 14:22:29\",\n            \"updated_at\": \"2017-04-24 16:20:36\"\n        }\n    ],\n    \"errors\": []\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./getUsers.coffee",
    "groupTitle": "facebook",
    "sampleRequest": [
      {
        "url": "http://ec2-54-229-150-116.eu-west-1.compute.amazonaws.com/api/v1/facebook/getUsers/:all/:city/:friends"
      }
    ]
  }
] });
