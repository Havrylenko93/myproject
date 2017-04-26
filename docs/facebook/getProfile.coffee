###
@apiVersion 1.0.0
@api {post} /getProfile getProfile
@apiName getProfile
@apiDescription api create or update user data using auth_token
@apiPermission user_friends,user_likes,user_location,user_photos,user_posts,user_videos,read_custom_friendlists
@apiGroup facebook
@apiError badToken "malformed token" expiresed or incorrect

@apiParam {string} token fb auth token

@apiSuccess {String} name user name from FB (name and lastname)
@apiSuccess {Integer} locationId city id from FB
@apiSuccess {String} locationName city name, country name
@apiSuccess {Integer} id facebook user id
@apiSuccess {String} avatar_url avatar_url
@apiSuccess {Integer} photo_likes photo_likes
@apiSuccess {Integer} video_likes video_likes
@apiSuccess {Integer} wall_likes wall_likes
@apiSuccess {Integer} total_likes total_likes
@apiParamExample {json} Request-Example:
{
	"token" : "SAACEdEose0cBAEHLJ2ZCuP8iNPcwtZAGyB9yMIoIbKGlR0vS1OBQq4JkVYEZA2whamRlZCla8eVYEEQPfa2WfNRyuAeqqqiYVLk3rhNXQr61lA7FWyfDPv9ZAOJtmSH2lF4SuzjQKlQuGSpIfC7hHFpaDAm0dQjbpX1HYw7AmIGNbXWAViKeU2iKNkEeijN8ZD",
}
@apiSuccessExample {json} Response-Example:
{
    "data": {
        "name": "Sergei Gavrilenko",
        "location": {
            "id": "111649395528170",
            "name": "Kharkov, Ukraine"
        },
        "id": "411214595914433",
        "avatar_url": "https://graph.facebook.com/v2.8/411214595914433/picture",
        "posts_count": 3,
        "photo_count": 6,
        "video_count": 1,
        "likes": {
            "photo_likes": 2,
            "video_likes": 1,
            "wall_likes": 3,
            "total_likes": 6
        }
    },
    "errors": []
}
###
