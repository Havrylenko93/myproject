###
@apiVersion 1.0.0
@api {post} /getUsers/:all/:city/:friends getUsers
@apiName getUsers
@apiDescription get users by city, friends, all
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
      "id": 18,
      "facebook_id": 411214595914433,
      "city_id": 111649395528170,
      "avatar_url": "https://graph.facebook.com/v2.8/411214595914433/picture",
      "name": "Sergei Gavrilenko",
      "photo_like_count": 4,
      "video_like_count": 1,
      "wall_like_count": 6,
      "total_like_count": 11,
      "created_at": "2017-04-13 11:57:17",
      "updated_at": "2017-04-13 12:16:23"
    }
  ],
  "errors": []
}
###