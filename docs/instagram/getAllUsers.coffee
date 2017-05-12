###
@apiVersion 1.0.0
@api {post} instagram/getAllUsers getAllUsers
@apiName getUsers
@apiDescription get all users and position current user
@apiGroup instagram
@apiParam {Integer} instagramId instagramId
@apiParam {Integer} offset offset
@apiParam {Integer} limit limit
@apiParam {String} ids list ids like "75896521,48759635,14785458"

@apiSuccess {integer} position position current user in array
@apiSuccess {Integer} id  user id in api database
@apiSuccess {Integer} instagram_id instagram user id
@apiSuccess {String}  avatar_url avatar_url
@apiSuccess {String}  name nickname from instagram
@apiSuccess {Integer} photo_like_count photo_like_count
@apiSuccess {Integer} video_like_count video_like_count
@apiSuccess {Integer} total_like_count total_like_count

@apiParamExample {json} Request-Example:
{
  "offset" : "0",
  "limit" : "100"
}
@apiSuccessExample {json} Response-Example:
{
    "data": [
        {
            "id":2,
            "instagram_id":777,
            "avatar_url":"url",
            "name":"John",
            "photo_like_count":1,
            "video_like_count":3,
            "total_like_count":4,
            "created_at":"2017-05-11 15:10:25",
            "updated_at":"2017-05-11 15:10:51"
        },
        {
            "id":1,
            "instagram_id":1,
            "avatar_url":"avatarurl",
            "name":"my name is",
            "photo_like_count":1,
            "video_like_count":2,
            "total_like_count":3,
            "created_at":null,
            "updated_at":null
        }
        ],
        "errors":[]
}
###