###
@apiVersion 1.0.0
@api {post} vk/getUsers/:all/:city/:friends getUsers
@apiName getUsers
@apiDescription get users by city, friends, all
@apiPermission friends,photos,video,wall
@apiGroup vk

@apiParam {String} token vk token
@apiParam {Integer} offset offset
@apiParam {Integer} limit limit

@apiSuccess {Integer} vk_id vk user id
@apiSuccess {String} name user name from vk (name and lastname)
@apiSuccess {Integer} city city id from vk
@apiSuccess {String} avatar_url avatar_url
@apiSuccess {Integer} all_wall_count all_wall_count
@apiSuccess {Integer} total_wall_likes total_wall_likes
@apiSuccess {Integer} all_photos_count all_photos_count
@apiSuccess {Integer} total_photo_likes total_photo_likes
@apiSuccess {Integer} all_video_count all_video_count
@apiSuccess {Integer} total_video_likes total_video_likes
@apiSuccess {Integer} total_user_likes total_user_likes
@apiParamExample {json} Request-Example:
{
	"offset" : "0",
  "limit" : "10"
}
@apiSuccessExample {json} Response-Example:
{
  "data":
  {
      "vk_id":73517365,
      "name":"Василий Василиевич",
      "city":280,
      "avatar_url":"https:\/\/pp.userapi.com\/c628126\/v628126365\/3203b\/zFjtizZ0fZc.jpg",
      "wall":
            {
                "all_wall_count":17,
                "total_wall_likes":47
            },
      "photos":
            {
                "all_photos_count":425,
                "total_photo_likes":1715
            },
      "videos":
            {
                "all_video_count":842,
                "total_video_likes":138
            },
      "total_user_likes":1900
  },
  "errors":[]
}
###