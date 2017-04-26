###
@apiVersion 1.0.0
@api {post} /getUsers/:all/:city/:friends getUsers
@apiName getUsers
@apiDescription get users by city, friends, all
@apiPermission user_friends,user_likes,user_location,user_photos,user_posts,user_videos,read_custom_friendlists
@apiGroup facebook

@apiParam {String} token fb token
@apiParam {Integer} offset offset
@apiParam {Integer} limit limit

@apiSuccess {Integer} id internal id from db
@apiSuccess {Integer} facebook_id fb user id
@apiSuccess {Integer} city_id fb city id
@apiSuccess {String} avatar_url avatar url
@apiSuccess {String} name name (first name, last name)
@apiSuccess {Integer} photo_likes photo_likes
@apiSuccess {Integer} video_likes video_likes
@apiSuccess {Integer} wall_likes wall_likes
@apiSuccess {Integer} total_likes total_likes
@apiSuccess {DateTime} created_ad created_ad
@apiSuccess {DateTime} updated_at updated_at
@apiParamExample {json} Request-Example:
{
	"offset" : "0",
  "limit" : "10"
}
@apiSuccessExample {json} Response-Example:
{
    "data": [
        {
            "id": 1,
            "facebook_id": 1515154,
            "city_id": 1558,
            "avatar_url": "https://graph.facebook.com/v2.8/411214595914433/picture",
            "name": "Ivanov Ivan",
            "last_calculating": "2017-04-19 13:14:04",
            "photo_like_count": 45,
            "video_like_count": 47,
            "wall_like_count": 15,
            "total_like_count": 58,
            "created_at": null,
            "updated_at": null
        },
        {
            "id": 3,
            "facebook_id": 411214595914433,
            "city_id": 211649395528170,
            "avatar_url": "https://graph.facebook.com/v2.8/411214595914433/picture",
            "name": "Sergei Gavrilenko",
            "last_calculating": "2017-04-24 16:20:36",
            "photo_like_count": 2,
            "video_like_count": 1,
            "wall_like_count": 3,
            "total_like_count": 6,
            "created_at": "2017-04-19 14:22:29",
            "updated_at": "2017-04-24 16:20:36"
        }
    ],
    "errors": []
}
###
