define({ "api": [
  {
    "version": "1.0.0",
    "type": "post",
    "url": "facebook/deleteUser",
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
    "filename": "./facebook/deleteUser.coffee",
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
    "url": "facebook/getProfile",
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
    "filename": "./facebook/getProfile.coffee",
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
    "url": "facebook/getUsers/:all/:city/:friends",
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
    "filename": "./facebook/getUsers.coffee",
    "groupTitle": "facebook",
    "sampleRequest": [
      {
        "url": "http://ec2-54-229-150-116.eu-west-1.compute.amazonaws.com/api/v1/facebook/getUsers/:all/:city/:friends"
      }
    ]
  },
  {
    "version": "1.0.0",
    "type": "post",
    "url": "vk/deleteUser",
    "title": "deleteUser",
    "name": "deleteUser",
    "description": "<p>api deleting user by token</p>",
    "group": "vk",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>vk token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n\"token\" : \"4cc7312070e302e62734c6092ebe440e45b54184195d0e386eca305e6095801416c015107243e9bc36d9c\",\n}",
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
    "filename": "./vk/deleteUser.coffee",
    "groupTitle": "vk",
    "sampleRequest": [
      {
        "url": "http://ec2-54-229-150-116.eu-west-1.compute.amazonaws.com/api/v1/vk/deleteUser"
      }
    ]
  },
  {
    "version": "1.0.0",
    "type": "post",
    "url": "vk/getProfile",
    "title": "getProfile",
    "name": "getProfile",
    "description": "<p>api create or update user data using auth_token</p>",
    "permission": [
      {
        "name": "friends,photos,video,wall"
      }
    ],
    "group": "vk",
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
            "description": "<p>vk token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n\"token\" : \"4cc7312070e302e62734c6092ebe440e45b54184195d0e386eca305e6095801416c015107243e9bc36d9c\",\n}",
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
            "field": "vk_id",
            "description": "<p>vk user id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>user name from vk (name and lastname)</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "city",
            "description": "<p>city id from vk</p>"
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
            "field": "all_wall_count",
            "description": "<p>all_wall_count</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "total_wall_likes",
            "description": "<p>total_wall_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "all_photos_count",
            "description": "<p>all_photos_count</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "total_photo_likes",
            "description": "<p>total_photo_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "all_video_count",
            "description": "<p>all_video_count</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "total_video_likes",
            "description": "<p>total_video_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "total_user_likes",
            "description": "<p>total_user_likes</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Response-Example:",
          "content": "{\n  \"data\":\n  {\n      \"vk_id\":73517365,\n      \"name\":\"Василий Василиевич\",\n      \"city\":280,\n      \"avatar_url\":\"https:\\/\\/pp.userapi.com\\/c628126\\/v628126365\\/3203b\\/zFjtizZ0fZc.jpg\",\n      \"wall\":\n            {\n                \"all_wall_count\":17,\n                \"total_wall_likes\":47\n            },\n      \"photos\":\n            {\n                \"all_photos_count\":425,\n                \"total_photo_likes\":1715\n            },\n      \"videos\":\n            {\n                \"all_video_count\":842,\n                \"total_video_likes\":138\n            },\n      \"total_user_likes\":1900\n  },\n  \"errors\":[]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./vk/getProfile.coffee",
    "groupTitle": "vk",
    "sampleRequest": [
      {
        "url": "http://ec2-54-229-150-116.eu-west-1.compute.amazonaws.com/api/v1/vk/getProfile"
      }
    ]
  },
  {
    "version": "1.0.0",
    "type": "post",
    "url": "vk/getUsers/:all/:city/:friends",
    "title": "getUsers",
    "name": "getUsers",
    "description": "<p>get users by city, friends, all</p>",
    "permission": [
      {
        "name": "friends,photos,video,wall"
      }
    ],
    "group": "vk",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>vk token</p>"
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
            "field": "vk_id",
            "description": "<p>vk user id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>user name from vk (name and lastname)</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "city",
            "description": "<p>city id from vk</p>"
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
            "field": "all_wall_count",
            "description": "<p>all_wall_count</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "total_wall_likes",
            "description": "<p>total_wall_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "all_photos_count",
            "description": "<p>all_photos_count</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "total_photo_likes",
            "description": "<p>total_photo_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "all_video_count",
            "description": "<p>all_video_count</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "total_video_likes",
            "description": "<p>total_video_likes</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "total_user_likes",
            "description": "<p>total_user_likes</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Response-Example:",
          "content": "{\n  \"data\":\n  {\n      \"vk_id\":73517365,\n      \"name\":\"Василий Василиевич\",\n      \"city\":280,\n      \"avatar_url\":\"https:\\/\\/pp.userapi.com\\/c628126\\/v628126365\\/3203b\\/zFjtizZ0fZc.jpg\",\n      \"wall\":\n            {\n                \"all_wall_count\":17,\n                \"total_wall_likes\":47\n            },\n      \"photos\":\n            {\n                \"all_photos_count\":425,\n                \"total_photo_likes\":1715\n            },\n      \"videos\":\n            {\n                \"all_video_count\":842,\n                \"total_video_likes\":138\n            },\n      \"total_user_likes\":1900\n  },\n  \"errors\":[]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./vk/getUsers.coffee",
    "groupTitle": "vk",
    "sampleRequest": [
      {
        "url": "http://ec2-54-229-150-116.eu-west-1.compute.amazonaws.com/api/v1/vk/getUsers/:all/:city/:friends"
      }
    ]
  }
] });
