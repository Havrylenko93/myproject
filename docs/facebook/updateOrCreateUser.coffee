###
@apiVersion 1.0.0
@api {post} facebook/updateOrCreateUser updateOrCreateUser
@apiName updateOrCreateUser
@apiDescription api create or update user data used post parameters
@apiPermission none
@apiGroup facebook
@apiError fbId not found "fbId not found"

@apiParam {integer} fbId facebook user id
@apiParam {integer} cityId cityId
@apiParam {string} avatarUrl avatarUrl
@apiParam {string} name name
@apiParam {integer} photoLikes photo likes count
@apiParam {integer} videoLikes video likes count
@apiParam {integer} wallLikes wall likes count

@apiSuccess {String} data data
@apiParamExample {json} Request-Example:
{
	"fbId" : "411214595914433",
  "cityId" : "111649395528170",
  "avatarUrl" : "https://graph.facebook.com/v2.8/411214595914433/picture",
  "name" : "Boris Britva",
  "photoLikes" : "12",
  "videoLikes" : "3",
  "wallLikes" : "2",
}
@apiSuccessExample {json} Response-Example:
{
  "data":200,
  "errors":[]
}
###
