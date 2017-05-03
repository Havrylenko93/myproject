###
@apiVersion 1.0.0
@api {post} vk/updateOrCreateUser updateOrCreateUser
@apiName updateOrCreateUser
@apiDescription api create or update user data used post parameters
@apiPermission none
@apiGroup vk
@apiError vkId not found "vkId not found"

@apiParam {integer} vkId facebook user id
@apiParam {integer} cityId cityId
@apiParam {string} avatarUrl avatarUrl
@apiParam {string} name name
@apiParam {integer} photoLikes photo likes count
@apiParam {integer} videoLikes video likes count
@apiParam {integer} wallLikes wall likes count

@apiSuccess {String} data data
@apiParamExample {json} Request-Example:
{
	"vkId" : "4112145",
  "cityId" : "111",
  "avatarUrl" : "https://avatarurl",
  "name" : "leningrad shnurovich",
  "photoLikes" : "77",
  "videoLikes" : "77",
  "wallLikes" : "77",
}
@apiSuccessExample {json} Response-Example:
{
  "data":200,
  "errors":[]
}
###
