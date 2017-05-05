###
@apiVersion 1.0.0
@api {post} vk/getUsers/:all/:city/:friends getUsers
@apiName getUsers
@apiDescription get users by city, friends, all
@apiGroup vk
@apiParam {Integer} vkId vkId
@apiParam {Integer} cityId cityId
@apiParam {Integer} offset offset
@apiParam {Integer} limit limit
@apiParam {String} friendsId 16463873,73517365,56371537

@apiSuccess {Integer} id  user id in api database
@apiSuccess {Integer} vk_id vk user id
@apiSuccess {String} name user name from vk (name and lastname)
@apiSuccess {Integer} city city id from vk
@apiSuccess {String} avatar_url avatar_url
@apiSuccess {Integer} total_wall_likes total_wall_likes
@apiSuccess {Integer} total_photo_likes total_photo_likes
@apiSuccess {Integer} total_video_likes total_video_likes
@apiSuccess {Integer} total_user_likes total_user_likes
@apiParamExample {json} Request-Example:
{
  "vkId" : 73517365
	"offset" : "0",
  "limit" : "1000"
  "friendIds" : 16463873,56371537
}
@apiSuccessExample {json} Response-Example:
{
  "position":1,
  "data": [
    {
      "id":8,
      "vk_id":73517365,
      "city_id":280,
      "avatar_url":"https:\/\/pp.userapi.com\/c628126\/v628126365\/3203b\/zFjtizZ0fZc.jpg",
      "name":"Сергей Гавриленко",
      "photo_like_count":1715,
      "video_like_count":138,
      "wall_like_count":49,
      "total_like_count":200,
      "created_at":"2017-04-25 12:39:32",
      "updated_at":"2017-04-26 17:45:17"
    },
    {
      "id":3,
      "vk_id":7777777,
      "city_id":280,
      "avatar_url":"https:\/\/pp.userapi.com\/c628126\/v628126365\/3203b\/zFjtizZ0fZc.jpg",
      "name":"Ivan Noize",
      "photo_like_count":1,
      "video_like_count":2,
      "wall_like_count":3,
      "total_like_count":6,
      "created_at":null,
      "updated_at":null
    }
  ],

  "errors":[]
  }
###